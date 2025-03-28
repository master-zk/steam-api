<?php

declare(strict_types=1);

namespace Flame\Support\Facade;

use Flame\Http\Request as RequestFactory;
use Flame\Http\UploadedFile;
use Flame\Support\Carbon;
use Flame\Support\Stringable;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\InputBag;

/**
 * @method static RequestFactory capture()
 * @method static RequestFactory instance()
 * @method static string method()
 * @method static string root()
 * @method static string url()
 * @method static string fullUrl()
 * @method static string fullUrlWithQuery(array $query)
 * @method static string fullUrlWithoutQuery(array|string $keys)
 * @method static string path()
 * @method static string decodedPath()
 * @method static string|null segment(int $index, string|null $default = null)
 * @method static array segments()
 * @method static bool is(mixed ...$patterns)
 * @method static bool fullUrlIs(mixed ...$patterns)
 * @method static string host()
 * @method static string httpHost()
 * @method static string schemeAndHttpHost()
 * @method static bool ajax()
 * @method static bool pjax()
 * @method static bool prefetch()
 * @method static bool secure()
 * @method static string|null ip()
 * @method static array ips()
 * @method static string|null userAgent()
 * @method static RequestFactory merge(array $input)
 * @method static RequestFactory replace(array $input)
 * @method static mixed get(string $key, mixed $default = null)
 * @method static InputBag|mixed json(string|null $key = null, mixed $default = null)
 * @method static RequestFactory createFromBase(\Symfony\Component\HttpFoundation\Request $request)
 * @method static RequestFactory duplicate(array|null $query = null, array|null $request = null, array|null $attributes = null, array|null $cookies = null, array|null $files = null, array|null $server = null)
 * @method static RequestFactory setJson(InputBag $json)
 * @method static array toArray()
 * @method static void initialize(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], string|resource|null $content = null)
 * @method static RequestFactory createFromGlobals()
 * @method static RequestFactory create(string $uri, string $method = 'GET', array $parameters = [], array $cookies = [], array $files = [], array $server = [], string|resource|null $content = null)
 * @method static void setFactory(callable|null $callable)
 * @method static void overrideGlobals()
 * @method static void setTrustedProxies(array $proxies, int $trustedHeaderSet)
 * @method static string[] getTrustedProxies()
 * @method static int getTrustedHeaderSet()
 * @method static void setTrustedHosts(array $hostPatterns)
 * @method static string[] getTrustedHosts()
 * @method static string normalizeQueryString(string|null $qs)
 * @method static void enableHttpMethodParameterOverride()
 * @method static bool getHttpMethodParameterOverride()
 * @method static array getClientIps()
 * @method static string|null getClientIp()
 * @method static string getScriptName()
 * @method static string getPathInfo()
 * @method static string getBasePath()
 * @method static string getBaseUrl()
 * @method static string getScheme()
 * @method static int|string|null getPort()
 * @method static string|null getUser()
 * @method static string|null getPassword()
 * @method static string|null getUserInfo()
 * @method static string getHttpHost()
 * @method static string getRequestUri()
 * @method static string getSchemeAndHttpHost()
 * @method static string getUri()
 * @method static string getUriForPath(string $path)
 * @method static string getRelativeUriForPath(string $path)
 * @method static string|null getQueryString()
 * @method static bool isSecure()
 * @method static string getHost()
 * @method static void setMethod(string $method)
 * @method static string getMethod()
 * @method static string getRealMethod()
 * @method static string|null getMimeType(string $format)
 * @method static string[] getMimeTypes(string $format)
 * @method static string|null getFormat(string|null $mimeType)
 * @method static void setFormat(string|null $format, string|string[] $mimeTypes)
 * @method static string|null getRequestFormat(string|null $default = 'html')
 * @method static void setRequestFormat(string|null $format)
 * @method static string|null getContentTypeFormat()
 * @method static bool isMethod(string $method)
 * @method static bool isMethodSafe()
 * @method static bool isMethodIdempotent()
 * @method static bool isMethodCacheable()
 * @method static string|null getProtocolVersion()
 * @method static string|resource getContent(bool $asResource = false)
 * @method static InputBag getPayload()
 * @method static array getETags()
 * @method static bool isNoCache()
 * @method static string|null getPreferredFormat(string|null $default = 'html')
 * @method static string|null getPreferredLanguage(string[] $locales = null)
 * @method static string[] getLanguages()
 * @method static string[] getCharsets()
 * @method static string[] getEncodings()
 * @method static string[] getAcceptableContentTypes()
 * @method static bool isXmlHttpRequest()
 * @method static bool preferSafeContent()
 * @method static bool isFromTrustedProxy()
 * @method static array filterPrecognitiveRules(array $rules)
 * @method static bool isAttemptingPrecognition()
 * @method static bool isPrecognitive()
 * @method static bool isJson()
 * @method static bool expectsJson()
 * @method static bool wantsJson()
 * @method static bool accepts(string|array $contentTypes)
 * @method static string|null prefers(string|array $contentTypes)
 * @method static bool acceptsAnyContentType()
 * @method static bool acceptsJson()
 * @method static bool acceptsHtml()
 * @method static bool matchesType(string $actual, string $type)
 * @method static string format(string $default = 'html')
 * @method static void flash()
 * @method static void flashOnly(array|mixed $keys)
 * @method static void flashExcept(array|mixed $keys)
 * @method static void flush()
 * @method static string|array|null server(string|null $key = null, string|array|null $default = null)
 * @method static bool hasHeader(string $key)
 * @method static string|array|null header(string|null $key = null, string|array|null $default = null)
 * @method static string|null bearerToken()
 * @method static bool exists(string|array $key)
 * @method static bool has(string|array $key)
 * @method static bool hasAny(string|array $keys)
 * @method static RequestFactory|mixed whenHas(string $key, callable $callback, callable|null $default = null)
 * @method static bool filled(string|array $key)
 * @method static bool isNotFilled(string|array $key)
 * @method static bool anyFilled(string|array $keys)
 * @method static RequestFactory|mixed whenFilled(string $key, callable $callback, callable|null $default = null)
 * @method static bool missing(string|array $key)
 * @method static RequestFactory|mixed whenMissing(string $key, callable $callback, callable|null $default = null)
 * @method static array keys()
 * @method static array all(array|mixed|null $keys = null)
 * @method static mixed input(string|null $key = null, mixed $default = null)
 * @method static Stringable str(string $key, mixed $default = null)
 * @method static Stringable string(string $key, mixed $default = null)
 * @method static bool boolean(string|null $key = null, bool $default = false)
 * @method static int integer(string $key, int $default = 0)
 * @method static float float(string $key, float $default = 0)
 * @method static Carbon|null date(string $key, string|null $format = null, string|null $tz = null)
 * @method static object|null enum(string $key, string $enumClass)
 * @method static Collection collect(array|string|null $key = null)
 * @method static array only(array|mixed $keys)
 * @method static array except(array|mixed $keys)
 * @method static string|array|null query(string|null $key = null, string|array|null $default = null)
 * @method static string|array|null post(string|null $key = null, string|array|null $default = null)
 * @method static bool hasCookie(string $key)
 * @method static string|array|null cookie(string|null $key = null, string|array|null $default = null)
 * @method static array allFiles()
 * @method static bool hasFile(string $key)
 * @method static UploadedFile|UploadedFile[]|array|null file(string|null $key = null, mixed $default = null)
 * @method static void macro(string $name, object|callable $macro)
 * @method static void mixin(object $mixin, bool $replace = true)
 * @method static bool hasMacro(string $name)
 * @method static void flushMacros()
 * @method static array validate(array $rules, ...$params)
 * @method static array validateWithBag(string $errorBag, array $rules, ...$params)
 * @method static bool hasValidSignature(bool $absolute = true)
 *
 * @see RequestFactory
 */
class Request
{
    /**
     * @var RequestFactory
     */
    protected static $request;

    /**
     * Capture the current HTTP request.
     */
    public static function init(): void
    {
        self::$request = RequestFactory::capture();
    }

    /**
     * Dynamically handle static method calls to the object.
     */
    public static function __callStatic(string $method, array $args): mixed
    {
        return self::$request->$method(...$args);
    }
}
