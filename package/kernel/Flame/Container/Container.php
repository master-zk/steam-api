<?php

declare(strict_types=1);

namespace Flame\Container;

use ArrayAccess;
use ArrayIterator;
use Closure;
use Countable;
use Flame\Container\Exception\ClassNotFoundException;
use Flame\Container\Exception\FuncNotFoundException;
use Flame\Support\Str;
use InvalidArgumentException;
use IteratorAggregate;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;
use ReflectionNamedType;
use Traversable;

class Container implements ArrayAccess, ContainerInterface, Countable, IteratorAggregate
{
    /**
     * 容器对象实例
     *
     * @var Container|Closure
     */
    protected static $instance;

    /**
     * 容器中的对象实例
     */
    protected array $instances = [];

    /**
     * 容器绑定标识
     */
    protected array $bind = [];

    /**
     * 容器回调
     */
    protected array $invokeCallback = [];

    /**
     * 获取当前容器的实例（单例）
     */
    public static function getInstance(): static
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        if (static::$instance instanceof Closure) {
            return (static::$instance)();
        }

        return static::$instance;
    }

    /**
     * 设置当前容器的实例
     */
    public static function setInstance($instance): void
    {
        static::$instance = $instance;
    }

    /**
     * 注册一个容器对象回调
     */
    public function resolving(string|Closure $abstract, ?Closure $callback = null): void
    {
        if ($abstract instanceof Closure) {
            $this->invokeCallback['*'][] = $abstract;

            return;
        }

        $abstract = $this->getAlias($abstract);

        $this->invokeCallback[$abstract][] = $callback;
    }

    /**
     * 获取容器中的对象实例 不存在则创建
     */
    public static function pull(string $abstract, array $vars = [], bool $newInstance = false)
    {
        return static::getInstance()->make($abstract, $vars, $newInstance);
    }

    /**
     * 获取容器中的对象实例
     */
    public function get(string $id)
    {
        if ($this->has($id)) {
            return $this->make($id);
        }

        throw new ClassNotFoundException('class not exists: '.$id, $id);
    }

    /**
     * 绑定一个类、闭包、实例、接口实现到容器
     */
    public function bind(string|array $abstract, $concrete = null): static
    {
        if (is_array($abstract)) {
            foreach ($abstract as $key => $val) {
                $this->bind($key, $val);
            }
        } elseif ($concrete instanceof Closure) {
            $this->bind[$abstract] = $concrete;
        } elseif (is_object($concrete)) {
            $this->instance($abstract, $concrete);
        } else {
            $abstract = $this->getAlias($abstract);
            if ($abstract != $concrete) {
                $this->bind[$abstract] = $concrete;
            }
        }

        return $this;
    }

    /**
     * 根据别名获取真实类名
     */
    public function getAlias(string $abstract): string
    {
        if (isset($this->bind[$abstract])) {
            $bind = $this->bind[$abstract];

            if (is_string($bind)) {
                return $this->getAlias($bind);
            }
        }

        return $abstract;
    }

    /**
     * 绑定一个类实例到容器
     */
    public function instance(string $abstract, $instance): static
    {
        $abstract = $this->getAlias($abstract);

        $this->instances[$abstract] = $instance;

        return $this;
    }

    /**
     * 判断容器中是否存在类及标识
     */
    public function bound(string $abstract): bool
    {
        return isset($this->bind[$abstract]) || isset($this->instances[$abstract]);
    }

    /**
     * 判断容器中是否存在类及标识
     */
    public function has(string $id): bool
    {
        return $this->bound($id);
    }

    /**
     * 判断容器中是否存在对象实例
     */
    public function exists(string $abstract): bool
    {
        $abstract = $this->getAlias($abstract);

        return isset($this->instances[$abstract]);
    }

    /**
     * 创建类的实例 已经存在则直接获取
     *
     * @throws ReflectionException
     */
    public function make(string $abstract, array $vars = [], bool $newInstance = false)
    {
        $abstract = $this->getAlias($abstract);

        if (isset($this->instances[$abstract]) && ! $newInstance) {
            return $this->instances[$abstract];
        }

        if (isset($this->bind[$abstract]) && $this->bind[$abstract] instanceof Closure) {
            $object = $this->invokeFunction($this->bind[$abstract], $vars);
        } else {
            $object = $this->invokeClass($abstract, $vars);
        }

        if (! $newInstance) {
            $this->instances[$abstract] = $object;
        }

        return $object;
    }

    /**
     * 删除容器中的对象实例
     */
    public function delete(string $name): void
    {
        $name = $this->getAlias($name);

        if (isset($this->instances[$name])) {
            unset($this->instances[$name]);
        }
    }

    /**
     * 执行函数或者闭包方法 支持参数调用
     */
    public function invokeFunction(string|Closure $function, array $vars = [])
    {
        try {
            $reflect = new ReflectionFunction($function);
        } catch (ReflectionException $e) {
            throw new FuncNotFoundException("function not exists: {$function}()", $function, $e);
        }

        $args = $this->bindParams($reflect, $vars);

        return $function(...$args);
    }

    /**
     * 调用反射执行类的方法 支持参数绑定
     *
     * @throws ReflectionException
     */
    public function invokeMethod($method, array $vars = [])
    {
        if (is_array($method)) {
            [$class, $method] = $method;

            $class = is_object($class) ? $class : $this->invokeClass($class);
        } else {
            // 静态方法
            [$class, $method] = explode('::', $method);
        }

        try {
            $reflect = new ReflectionMethod($class, $method);
        } catch (ReflectionException $e) {
            $class = is_object($class) ? $class::class : $class;
            throw new FuncNotFoundException('method not exists: '.$class.'::'.$method.'()', "{$class}::{$method}", $e);
        }

        $args = $this->bindParams($reflect, $vars);

        return $reflect->invokeArgs(is_object($class) ? $class : null, $args);
    }

    /**
     * 调用反射执行类的方法 支持参数绑定
     */
    public function invokeReflectMethod($instance, $reflect, array $vars = [])
    {
        $args = $this->bindParams($reflect, $vars);

        return $reflect->invokeArgs($instance, $args);
    }

    /**
     * 调用反射执行callable 支持参数绑定
     *
     * @throws ReflectionException
     */
    public function invoke($callable, array $vars = [])
    {
        if ($callable instanceof Closure) {
            return $this->invokeFunction($callable, $vars);
        } elseif (is_string($callable) && ! str_contains($callable, '::')) {
            return $this->invokeFunction($callable, $vars);
        } else {
            return $this->invokeMethod($callable, $vars);
        }
    }

    /**
     * 调用反射执行类的实例化 支持依赖注入
     *
     * @throws ReflectionException
     */
    public function invokeClass(string $class, array $vars = [])
    {
        try {
            $reflect = new ReflectionClass($class);
        } catch (ReflectionException $e) {
            throw new ClassNotFoundException('class not exists: '.$class, $class, $e);
        }

        if ($reflect->hasMethod('__make')) {
            $method = $reflect->getMethod('__make');
            if ($method->isPublic() && $method->isStatic()) {
                $args = $this->bindParams($method, $vars);
                $object = $method->invokeArgs(null, $args);
                $this->invokeAfter($class, $object);

                return $object;
            }
        }

        $constructor = $reflect->getConstructor();

        $args = $constructor ? $this->bindParams($constructor, $vars) : [];

        $object = $reflect->newInstanceArgs($args);

        $this->invokeAfter($class, $object);

        return $object;
    }

    /**
     * 执行invokeClass回调
     */
    protected function invokeAfter(string $class, $object): void
    {
        if (isset($this->invokeCallback['*'])) {
            foreach ($this->invokeCallback['*'] as $callback) {
                $callback($object, $this);
            }
        }

        if (isset($this->invokeCallback[$class])) {
            foreach ($this->invokeCallback[$class] as $callback) {
                $callback($object, $this);
            }
        }
    }

    /**
     * 绑定参数
     */
    protected function bindParams(ReflectionFunctionAbstract $reflect, array $vars = []): array
    {
        if ($reflect->getNumberOfParameters() == 0) {
            return [];
        }

        // 判断数组类型 数字数组时按顺序绑定参数
        reset($vars);
        $type = key($vars) === 0 ? 1 : 0;
        $params = $reflect->getParameters();
        $args = [];

        foreach ($params as $param) {
            $name = $param->getName();
            $lowerName = Str::snake($name);
            $reflectionType = $param->getType();

            if ($param->isVariadic()) {
                return array_merge($args, array_values($vars));
            } elseif ($reflectionType instanceof ReflectionNamedType && $reflectionType->isBuiltin() === false) {
                $args[] = $this->getObjectParam($reflectionType->getName(), $vars);
            } elseif ($type == 1 && ! empty($vars)) {
                $args[] = array_shift($vars);
            } elseif ($type == 0 && array_key_exists($name, $vars)) {
                $args[] = $vars[$name];
            } elseif ($type == 0 && array_key_exists($lowerName, $vars)) {
                $args[] = $vars[$lowerName];
            } elseif ($param->isDefaultValueAvailable()) {
                $args[] = $param->getDefaultValue();
            } else {
                throw new InvalidArgumentException('method param miss:'.$name);
            }
        }

        return $args;
    }

    /**
     * 创建工厂对象实例
     *
     * @throws ReflectionException
     */
    public static function factory(string $name, string $namespace = '', ...$args)
    {
        $class = str_contains($name, '\\') ? $name : $namespace.ucwords($name);

        return Container::getInstance()->invokeClass($class, $args);
    }

    /**
     * 获取对象类型的参数值
     *
     * @throws ReflectionException
     */
    protected function getObjectParam(string $className, array &$vars)
    {
        $array = $vars;
        $value = array_shift($array);

        if ($value instanceof $className) {
            $result = $value;
            array_shift($vars);
        } else {
            $result = $this->make($className);
        }

        return $result;
    }

    public function __set($name, $value)
    {
        $this->bind($name, $value);
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __isset($name): bool
    {
        return $this->exists($name);
    }

    public function __unset($name)
    {
        $this->delete($name);
    }

    public function offsetExists(mixed $key): bool
    {
        return $this->exists($key);
    }

    /**
     * @throws ReflectionException
     */
    public function offsetGet(mixed $key): mixed
    {
        return $this->make($key);
    }

    public function offsetSet(mixed $key, mixed $value): void
    {
        $this->bind($key, $value);
    }

    public function offsetUnset(mixed $key): void
    {
        $this->delete($key);
    }

    //Countable
    public function count(): int
    {
        return count($this->instances);
    }

    //IteratorAggregate
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->instances);
    }
}
