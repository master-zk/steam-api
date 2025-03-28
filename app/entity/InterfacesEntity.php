<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'InterfacesEntity')]
class InterfacesEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'type', description: '', type: 'string')]
    private string $type;

    #[OA\Property(property: 'name', description: '', type: 'string')]
    private string $name;

    #[OA\Property(property: 'description', description: '', type: 'string')]
    private string $description;

    #[OA\Property(property: 'ikey', description: '', type: 'string')]
    private string $ikey;

    #[OA\Property(property: 'filename', description: '', type: 'string')]
    private string $filename;

    #[OA\Property(property: 'syntax', description: '', type: 'string')]
    private string $syntax;

    #[OA\Property(property: 'hostname', description: '', type: 'string')]
    private string $hostname;

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getIkey(): string
    {
        return $this->ikey;
    }

    public function setIkey(string $ikey): void
    {
        $this->ikey = $ikey;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }

    public function getSyntax(): string
    {
        return $this->syntax;
    }

    public function setSyntax(string $syntax): void
    {
        $this->syntax = $syntax;
    }

    public function getHostname(): string
    {
        return $this->hostname;
    }

    public function setHostname(string $hostname): void
    {
        $this->hostname = $hostname;
    }
}
