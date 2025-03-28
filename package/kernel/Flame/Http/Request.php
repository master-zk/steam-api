<?php

declare(strict_types=1);

namespace Flame\Http;

use ArrayAccess;
use Flame\Support\Arr;
use Flame\Support\Str;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Traits\Macroable;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request extends SymfonyRequest implements Arrayable, ArrayAccess
{
    use Concerns\InteractsWithContentTypes,
        Concerns\InteractsWithInput,
        Concerns\InteractsWithRequestMethods,
        Macroable;

    /**
     * The decoded JSON content for the request.
     */
    protected ?InputBag $json;

    /**
     * All of the converted files for the request.
     */
    protected array $convertedFiles;

    /**
     * Create a new Illuminate HTTP request from server variables.
     */
    public static function capture(): static
    {
        static::enableHttpMethodParameterOverride();

        return static::createFromBase(SymfonyRequest::createFromGlobals());
    }

    /**
     * Return the Request instance.
     */
    public function instance(): static
    {
        return $this;
    }

    /**
     * Get the request method.
     */
    public function method(): string
    {
        return $this->getMethod();
    }

    /**
     * Get the root URL for the application.
     */
    public function root(): string
    {
        return rtrim($this->getSchemeAndHttpHost().$this->getBaseUrl(), '/');
    }

    /**
     * Get the URL (no query string) for the request.
     */
    public function url(): string
    {
        return rtrim(preg_replace('/\?.*/', '', $this->getUri()), '/');
    }

    /**
     * Get the full URL for the request.
     */
    public function fullUrl(): string
    {
        $query = $this->getQueryString();

        $question = $this->getBaseUrl().$this->getPathInfo() === '/' ? '/?' : '?';

        return $query ? $this->url().$question.$query : $this->url();
    }

    /**
     * Get the full URL for the request with the added query string parameters.
     */
    public function fullUrlWithQuery(array $query): string
    {
        $question = $this->getBaseUrl().$this->getPathInfo() === '/' ? '/?' : '?';

        return count($this->query()) > 0
            ? $this->url().$question.Arr::query(array_merge($this->query(), $query))
            : $this->fullUrl().$question.Arr::query($query);
    }

    /**
     * Get the full URL for the request without the given query string parameters.
     */
    public function fullUrlWithoutQuery(array|string $keys): string
    {
        $query = Arr::except($this->query(), $keys);

        $question = $this->getBaseUrl().$this->getPathInfo() === '/' ? '/?' : '?';

        return count($query) > 0
            ? $this->url().$question.Arr::query($query)
            : $this->url();
    }

    /**
     * Get the current path info for the request.
     */
    public function path(): string
    {
        $pattern = trim($this->getPathInfo(), '/');

        return $pattern === '' ? '/' : $pattern;
    }

    /**
     * Get the current decoded path info for the request.
     */
    public function decodedPath(): string
    {
        return rawurldecode($this->path());
    }

    /**
     * Get a segment from the URI (1 based index).
     */
    public function segment(int $index, ?string $default = null): ?string
    {
        return Arr::get($this->segments(), $index - 1, $default);
    }

    /**
     * Get all of the segments for the request path.
     */
    public function segments(): array
    {
        $segments = explode('/', $this->decodedPath());

        return array_values(array_filter($segments, function ($value) {
            return $value !== '';
        }));
    }

    /**
     * Determine if the current request URI matches a pattern.
     */
    public function is(mixed ...$patterns): bool
    {
        $path = $this->decodedPath();

        return collect($patterns)->contains(fn ($pattern) => Str::is($pattern, $path));
    }

    /**
     * Determine if the current request URL and query string match a pattern.
     */
    public function fullUrlIs(mixed ...$patterns): bool
    {
        $url = $this->fullUrl();

        return collect($patterns)->contains(fn ($pattern) => Str::is($pattern, $url));
    }

    /**
     * Get the host name.
     */
    public function host(): string
    {
        return $this->getHost();
    }

    /**
     * Get the HTTP host being requested.
     */
    public function httpHost(): string
    {
        return $this->getHttpHost();
    }

    /**
     * Get the scheme and HTTP host.
     */
    public function schemeAndHttpHost(): string
    {
        return $this->getSchemeAndHttpHost();
    }

    /**
     * Determine if the request is the result of an AJAX call.
     */
    public function ajax(): bool
    {
        return $this->isXmlHttpRequest();
    }

    /**
     * Determine if the request is the result of a PJAX call.
     */
    public function pjax(): bool
    {
        return $this->headers->get('X-PJAX') == true;
    }

    /**
     * Determine if the request is the result of a prefetch call.
     */
    public function prefetch(): bool
    {
        return strcasecmp($this->server->get('HTTP_X_MOZ') ?? '', 'prefetch') === 0 ||
            strcasecmp($this->headers->get('Purpose') ?? '', 'prefetch') === 0 ||
            strcasecmp($this->headers->get('Sec-Purpose') ?? '', 'prefetch') === 0;
    }

    /**
     * Determine if the request is over HTTPS.
     */
    public function secure(): bool
    {
        return $this->isSecure();
    }

    /**
     * Get the client IP address.
     */
    public function ip(): ?string
    {
        return $this->getClientIp();
    }

    /**
     * Get the client IP addresses.
     */
    public function ips(): array
    {
        return $this->getClientIps();
    }

    /**
     * Get the client user agent.
     */
    public function userAgent(): ?string
    {
        return $this->headers->get('User-Agent');
    }

    /**
     * Merge new input into the current request's input array.
     */
    public function merge(array $input): static
    {
        $this->getInputSource()->add($input);

        return $this;
    }

    /**
     * Replace the input for the current request.
     */
    public function replace(array $input): static
    {
        $this->getInputSource()->replace($input);

        return $this;
    }

    /**
     * This method belongs to Symfony HttpFoundation and is not usually needed when using Laravel.
     *
     * Instead, you may use the "input" method.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return parent::get($key, $default);
    }

    /**
     * Get the JSON payload for the request.
     *
     * @return InputBag|mixed
     */
    public function json(?string $key = null, mixed $default = null): ?InputBag
    {
        if (! isset($this->json)) {
            $this->json = new InputBag((array) json_decode($this->getContent(), true));
        }

        if (is_null($key)) {
            return $this->json;
        }

        return data_get($this->json->all(), $key, $default);
    }

    /**
     * Get the input source for the request.
     */
    protected function getInputSource(): ?InputBag
    {
        if ($this->isJson()) {
            return $this->json();
        }

        return in_array($this->getRealMethod(), ['GET', 'HEAD']) ? $this->query : $this->request;
    }

    /**
     * Create an Illuminate request from a Symfony instance.
     */
    public static function createFromBase(SymfonyRequest $request): static
    {
        $newRequest = new static(
            $request->query->all(), $request->request->all(), $request->attributes->all(),
            $request->cookies->all(), (new static)->filterFiles($request->files->all()) ?? [], $request->server->all()
        );

        if (function_exists('apache_request_headers') && $result = apache_request_headers()) {
            $headers = $result;
        } else {
            $headers = $request->headers->all();
        }

        $newRequest->headers->replace($headers);

        $newRequest->content = $request->content;

        if ($newRequest->isJson()) {
            $newRequest->request = $newRequest->json();
        }

        return $newRequest;
    }

    /**
     * {@inheritdoc}
     */
    public function duplicate(?array $query = null, ?array $request = null, ?array $attributes = null, ?array $cookies = null, ?array $files = null, ?array $server = null): static
    {
        return parent::duplicate($query, $request, $attributes, $cookies, $this->filterFiles($files), $server);
    }

    /**
     * Filter the given array of files, removing any empty values.
     *
     * @param  mixed  $files
     * @return mixed
     */
    protected function filterFiles(array $files)
    {
        if (! $files) {
            return [];
        }

        foreach ($files as $key => $file) {
            if (is_array($file)) {
                $files[$key] = $this->filterFiles($file);
            }

            if (empty($files[$key])) {
                unset($files[$key]);
            }
        }

        return $files;
    }

    /**
     * Set the JSON payload for the request.
     *
     * @param  InputBag  $json
     * @return $this
     */
    public function setJson($json)
    {
        $this->json = $json;

        return $this;
    }

    /**
     * Get all of the input and files for the request.
     */
    public function toArray(): array
    {
        return $this->all();
    }

    /**
     * Determine if the given offset exists.
     *
     * @param  string  $offset
     */
    public function offsetExists($offset): bool
    {
        return Arr::has(
            $this->all(),
            $offset
        );
    }

    /**
     * Get the value at the given offset.
     *
     * @param  string  $offset
     */
    public function offsetGet($offset): mixed
    {
        return $this->__get($offset);
    }

    /**
     * Set the value at the given offset.
     *
     * @param  string  $offset
     * @param  mixed  $value
     */
    public function offsetSet($offset, $value): void
    {
        $this->getInputSource()->set($offset, $value);
    }

    /**
     * Remove the value at the given offset.
     *
     * @param  string  $offset
     */
    public function offsetUnset($offset): void
    {
        $this->getInputSource()->remove($offset);
    }

    /**
     * Check if an input element is set on the request.
     *
     * @return bool
     */
    public function __isset(string $key)
    {
        return ! is_null($this->__get($key));
    }

    /**
     * Get an input element from the request.
     *
     * @return mixed
     */
    public function __get(string $key)
    {
        return Arr::get($this->all(), $key);
    }
}
