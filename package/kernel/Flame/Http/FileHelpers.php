<?php

declare(strict_types=1);

namespace Flame\Http;

use Flame\Support\Str;

trait FileHelpers
{
    /**
     * 文件哈希名称的缓存副本
     */
    protected ?string $hashName = null;

    /**
     * 获取文件的完全限定路径
     */
    public function path(): string
    {
        return $this->getRealPath();
    }

    /**
     * 获取文件的扩展名
     */
    public function extension(): string
    {
        return $this->guessExtension();
    }

    /**
     * 获取文件的文件名
     */
    public function hashName(?string $path = null): string
    {
        if ($path) {
            $path = rtrim($path, '/').'/';
        }

        $hash = $this->hashName ?: $this->hashName = Str::random(40);

        if ($extension = $this->guessExtension()) {
            $extension = '.'.$extension;
        }

        return $path.$hash.$extension;
    }

    /**
     * 获取图像的尺寸(如果适用)
     */
    public function dimensions(): ?array
    {
        return @getimagesize($this->getRealPath());
    }
}
