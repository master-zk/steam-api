<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'RegistrationsEntity')]
class RegistrationsEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'reg_user', description: '', type: 'string')]
    private string $reg_user;

    #[OA\Property(property: 'realm', description: '', type: 'string')]
    private string $realm;

    #[OA\Property(property: 'token', description: '', type: 'string')]
    private string $token;

    #[OA\Property(property: 'url', description: '', type: 'string')]
    private string $url;

    #[OA\Property(property: 'expires', description: '', type: 'integer')]
    private int $expires;

    #[OA\Property(property: 'network_ip', description: '', type: 'string')]
    private string $network_ip;

    #[OA\Property(property: 'network_port', description: '', type: 'string')]
    private string $network_port;

    #[OA\Property(property: 'network_proto', description: '', type: 'string')]
    private string $network_proto;

    #[OA\Property(property: 'hostname', description: '', type: 'string')]
    private string $hostname;

    #[OA\Property(property: 'metadata', description: '', type: 'string')]
    private string $metadata;

    public function getRegUser(): string
    {
        return $this->reg_user;
    }

    public function setRegUser(string $reg_user): void
    {
        $this->reg_user = $reg_user;
    }

    public function getRealm(): string
    {
        return $this->realm;
    }

    public function setRealm(string $realm): void
    {
        $this->realm = $realm;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getExpires(): int
    {
        return $this->expires;
    }

    public function setExpires(int $expires): void
    {
        $this->expires = $expires;
    }

    public function getNetworkIp(): string
    {
        return $this->network_ip;
    }

    public function setNetworkIp(string $network_ip): void
    {
        $this->network_ip = $network_ip;
    }

    public function getNetworkPort(): string
    {
        return $this->network_port;
    }

    public function setNetworkPort(string $network_port): void
    {
        $this->network_port = $network_port;
    }

    public function getNetworkProto(): string
    {
        return $this->network_proto;
    }

    public function setNetworkProto(string $network_proto): void
    {
        $this->network_proto = $network_proto;
    }

    public function getHostname(): string
    {
        return $this->hostname;
    }

    public function setHostname(string $hostname): void
    {
        $this->hostname = $hostname;
    }

    public function getMetadata(): string
    {
        return $this->metadata;
    }

    public function setMetadata(string $metadata): void
    {
        $this->metadata = $metadata;
    }
}
