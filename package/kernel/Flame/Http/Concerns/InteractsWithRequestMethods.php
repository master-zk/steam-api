<?php

declare(strict_types=1);

namespace Flame\Http\Concerns;

trait InteractsWithRequestMethods
{
    public function isPost(): bool
    {
        if ($this->method() === 'POST') {
            return true;
        }

        return false;
    }

    public function isGet(): bool
    {
        if ($this->method() === 'GET') {
            return true;
        }

        return false;
    }

    public function isPut(): bool
    {
        if ($this->method() === 'PUT') {
            return true;
        }

        return false;
    }

    public function isDelete(): bool
    {
        if ($this->method() === 'DELETE') {
            return true;
        }

        return false;
    }

    public function isHead(): bool
    {
        if ($this->method() === 'HEAD') {
            return true;
        }

        return false;
    }

    public function isOptions(): bool
    {
        if ($this->method() === 'OPTIONS') {
            return true;
        }

        return false;
    }

    public function isAjax(): bool
    {
        return $this->ajax();
    }

    public function isFlashRequest(): bool
    {
        return $this->header('USER_AGENT') == 'Shockwave Flash';
    }

    public function isSpider($ua = null): bool
    {
        is_null($ua) && $ua = $_SERVER['HTTP_USER_AGENT'];
        $ua = strtolower($ua);
        $spiders = ['bot', 'crawl', 'spider', 'slurp', 'sohu-search', 'lycos', 'robozilla'];
        foreach ($spiders as $spider) {
            if (str_contains($ua, $spider)) {
                return true;
            }
        }

        return false;
    }
}
