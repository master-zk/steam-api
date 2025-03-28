<?php

declare(strict_types=1);

namespace Flame\Http\Concerns;

use Flame\Http\UploadedFile;
use Flame\Support\Arr;
use Flame\Support\Facade\Date;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\InputBag;

trait InteractsWithInput
{
    public function server($key = null, $default = null): string|array|null
    {
        return $this->retrieveItem('server', $key, $default);
    }

    public function hasHeader($key): bool
    {
        return ! is_null($this->header($key));
    }

    public function header($key = null, $default = null): string|array|null
    {
        return $this->retrieveItem('headers', $key, $default);
    }

    public function bearerToken(): ?string
    {
        $header = $this->header('Authorization');
        if (is_null($header)) {
            return null;
        }

        $position = strrpos($header, 'Bearer ');

        if ($position !== false) {
            $header = substr($header, $position + 7);

            return str_contains($header, ',') ? strstr($header, ',', true) : $header;
        }

        return null;
    }

    public function exists($key): bool
    {
        return $this->has($key);
    }

    public function has($key): bool
    {
        $keys = is_array($key) ? $key : func_get_args();

        $input = $this->all();

        foreach ($keys as $value) {
            if (! Arr::has($input, $value)) {
                return false;
            }
        }

        return true;
    }

    public function isNotFilled($key): bool
    {
        $keys = is_array($key) ? $key : func_get_args();

        foreach ($keys as $value) {
            if (! $this->isEmptyString($value)) {
                return false;
            }
        }

        return true;
    }

    protected function isEmptyString($key): bool
    {
        $value = $this->input($key);

        return ! is_bool($value) && ! is_array($value) && trim((string) $value) === '';
    }

    public function keys(): array
    {
        return array_merge(array_keys($this->input()), $this->files->keys());
    }

    public function all($keys = null): array
    {
        $input = array_replace_recursive($this->input(), $this->allFiles());

        if (! $keys) {
            return $input;
        }

        $results = [];

        foreach (is_array($keys) ? $keys : func_get_args() as $key) {
            Arr::set($results, $key, Arr::get($input, $key));
        }

        return $results;
    }

    public function input($key = null, $default = null)
    {
        return data_get(
            $this->getInputSource()->all() + $this->query->all(), $key, $default
        );
    }

    public function str($key, $default = null)
    {
        return $this->string($key, $default);
    }

    public function string($key, $default = null)
    {
        return str($this->input($key, $default));
    }

    public function boolean($key = null, $default = false): bool
    {
        return filter_var($this->input($key, $default), FILTER_VALIDATE_BOOLEAN);
    }

    public function integer($key, $default = 0): int
    {
        return intval($this->input($key, $default));
    }

    public function float($key, $default = 0.0): float
    {
        return floatval($this->input($key, $default));
    }

    public function date($key, $format = null, $tz = null)
    {
        if ($this->isNotFilled($key)) {
            return null;
        }

        if (is_null($format)) {
            return Date::parse($this->input($key), $tz);
        }

        return Date::createFromFormat($format, $this->input($key), $tz);
    }

    public function enum($key, $enumClass)
    {
        if ($this->isNotFilled($key) ||
            ! enum_exists($enumClass) ||
            ! method_exists($enumClass, 'tryFrom')) {
            return null;
        }

        return $enumClass::tryFrom($this->input($key));
    }

    public function collect($key = null): Collection
    {
        return collect(is_array($key) ? $this->only($key) : $this->input($key));
    }

    public function only($keys): array
    {
        $results = [];

        $input = $this->all();

        $placeholder = new \stdClass;

        foreach (is_array($keys) ? $keys : func_get_args() as $key) {
            $value = data_get($input, $key, $placeholder);

            if ($value !== $placeholder) {
                Arr::set($results, $key, $value);
            }
        }

        return $results;
    }

    public function except($keys): array
    {
        $keys = is_array($keys) ? $keys : func_get_args();

        $results = $this->all();

        Arr::forget($results, $keys);

        return $results;
    }

    public function query($key = null, $default = null): array|null|string
    {
        return $this->retrieveItem('query', $key, $default);
    }

    public function post($key = null, $default = null): array|null|string
    {
        return $this->retrieveItem('request', $key, $default);
    }

    public function hasCookie($key): bool
    {
        return ! is_null($this->cookie($key));
    }

    public function cookie($key = null, $default = null): array|null|string
    {
        return $this->retrieveItem('cookies', $key, $default);
    }

    public function allFiles(): array
    {
        $files = $this->files->all();

        return $this->convertedFiles = $this->convertedFiles ?? $this->convertUploadedFiles($files);
    }

    protected function convertUploadedFiles(array $files): array
    {
        return array_map(function ($file) {
            if (is_null($file) || (is_array($file) && empty(array_filter($file)))) {
                return $file;
            }

            return is_array($file)
                ? $this->convertUploadedFiles($file)
                : UploadedFile::createFromBase($file);
        }, $files);
    }

    public function hasFile($key): bool
    {
        if (! is_array($files = $this->file($key))) {
            $files = [$files];
        }

        foreach ($files as $file) {
            if ($this->isValidFile($file)) {
                return true;
            }
        }

        return false;
    }

    protected function isValidFile($file): bool
    {
        return $file instanceof \SplFileInfo && $file->getPath() !== '';
    }

    public function file($key = null, $default = null)
    {
        return data_get($this->allFiles(), $key, $default);
    }

    protected function retrieveItem($source, $key, $default): array|null|string
    {
        if (is_null($key)) {
            return $this->$source->all();
        }

        if ($this->$source instanceof InputBag) {
            return $this->$source->all()[$key] ?? $default;
        }

        return $this->$source->get($key, $default);
    }
}
