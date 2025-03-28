<?php

declare(strict_types=1);

namespace Flame\Session\Driver;

use Closure;
use Exception;
use FilesystemIterator;
use Flame\Session\Contracts\SessionHandlerInterface;
use Generator;
use SplFileInfo;

/**
 * Session 文件驱动
 */
class File implements SessionHandlerInterface
{
    protected array $config = [
        'path' => '',
        'expire' => 1440,
        'prefix' => '',
        'data_compress' => false,
        'gc_probability' => 1,
        'gc_divisor' => 100,
    ];

    /**
     * @throws Exception
     */
    public function __construct(array $config = [])
    {
        $this->config = array_merge($this->config, $config);

        if (empty($this->config['path'])) {
            $this->config['path'] = runtime_path('session/');
        } elseif (substr($this->config['path'], -1) != DIRECTORY_SEPARATOR) {
            $this->config['path'] .= DIRECTORY_SEPARATOR;
        }

        $this->init();
    }

    /**
     * 打开Session
     *
     * @throws Exception
     */
    protected function init(): void
    {
        try {
            ! is_dir($this->config['path']) && mkdir($this->config['path'], 0755, true);
        } catch (Exception $e) {
            // 写入失败
        }

        // 垃圾回收
        if ($this->config['gc_probability'] >= random_int(1, $this->config['gc_divisor'])) {
            $this->gc();
        }
    }

    /**
     * Session 垃圾回收
     */
    public function gc(): void
    {
        $lifetime = $this->config['expire'];
        $now = time();

        $files = $this->findFiles($this->config['path'], function (SplFileInfo $item) use ($lifetime, $now) {
            return $now - $lifetime > $item->getMTime();
        });

        foreach ($files as $file) {
            $this->unlink($file->getPathname());
        }
    }

    /**
     * 查找文件
     */
    protected function findFiles(string $root, Closure $filter): Generator
    {
        $items = new FilesystemIterator($root);

        /** @var SplFileInfo $item */
        foreach ($items as $item) {
            if ($item->isDir() && ! $item->isLink()) {
                yield from $this->findFiles($item->getPathname(), $filter);
            } else {
                if ($filter($item)) {
                    yield $item;
                }
            }
        }
    }

    /**
     * 取得变量的存储文件名
     */
    protected function getFileName(string $name, bool $auto = false): string
    {
        if ($this->config['prefix']) {
            // 使用子目录
            $name = $this->config['prefix'].DIRECTORY_SEPARATOR.'sess_'.$name;
        } else {
            $name = 'sess_'.$name;
        }

        $filename = $this->config['path'].$name;
        $dir = dirname($filename);

        if ($auto && ! is_dir($dir)) {
            try {
                mkdir($dir, 0755, true);
            } catch (Exception $e) {
                // 创建失败
            }
        }

        return $filename;
    }

    /**
     * 读取Session
     */
    public function read(string $sessionId): string
    {
        $filename = $this->getFileName($sessionId);

        if (is_file($filename) && filemtime($filename) >= time() - $this->config['expire']) {
            $content = $this->readFile($filename);

            if ($this->config['data_compress'] && function_exists('gzcompress')) {
                //启用数据压缩
                $content = (string) gzuncompress($content);
            }

            return $content;
        }

        return '';
    }

    /**
     * 写文件（加锁）
     */
    protected function writeFile($path, $content): bool
    {
        return (bool) file_put_contents($path, $content, LOCK_EX);
    }

    /**
     * 读取文件内容(加锁)
     */
    protected function readFile($path): string
    {
        $contents = '';

        $handle = fopen($path, 'rb');

        if ($handle) {
            try {
                if (flock($handle, LOCK_SH)) {
                    clearstatcache(true, $path);

                    $contents = fread($handle, filesize($path) ?: 1);

                    flock($handle, LOCK_UN);
                }
            } finally {
                fclose($handle);
            }
        }

        return $contents;
    }

    /**
     * 写入Session
     */
    public function write(string $sessionId, string $data): bool
    {
        $filename = $this->getFileName($sessionId, true);

        if ($this->config['data_compress'] && function_exists('gzcompress')) {
            //数据压缩
            $data = gzcompress($data, 3);
        }

        return $this->writeFile($filename, $data);
    }

    /**
     * 删除Session
     */
    public function delete(string $sessionId): bool
    {
        try {
            return $this->unlink($this->getFileName($sessionId));
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 判断文件是否存在后，删除
     */
    private function unlink(string $file): bool
    {
        return is_file($file) && unlink($file);
    }
}
