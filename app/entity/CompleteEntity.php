<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'CompleteEntity')]
class CompleteEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'sticky', description: '', type: 'integer')]
    private int $sticky;

    #[OA\Property(property: 'a1', description: '', type: 'string')]
    private string $a1;

    #[OA\Property(property: 'a2', description: '', type: 'string')]
    private string $a2;

    #[OA\Property(property: 'a3', description: '', type: 'string')]
    private string $a3;

    #[OA\Property(property: 'a4', description: '', type: 'string')]
    private string $a4;

    #[OA\Property(property: 'a5', description: '', type: 'string')]
    private string $a5;

    #[OA\Property(property: 'a6', description: '', type: 'string')]
    private string $a6;

    #[OA\Property(property: 'a7', description: '', type: 'string')]
    private string $a7;

    #[OA\Property(property: 'a8', description: '', type: 'string')]
    private string $a8;

    #[OA\Property(property: 'a9', description: '', type: 'string')]
    private string $a9;

    #[OA\Property(property: 'a10', description: '', type: 'string')]
    private string $a10;

    #[OA\Property(property: 'hostname', description: '', type: 'string')]
    private string $hostname;

    public function getSticky(): int
    {
        return $this->sticky;
    }

    public function setSticky(int $sticky): void
    {
        $this->sticky = $sticky;
    }

    public function getA1(): string
    {
        return $this->a1;
    }

    public function setA1(string $a1): void
    {
        $this->a1 = $a1;
    }

    public function getA2(): string
    {
        return $this->a2;
    }

    public function setA2(string $a2): void
    {
        $this->a2 = $a2;
    }

    public function getA3(): string
    {
        return $this->a3;
    }

    public function setA3(string $a3): void
    {
        $this->a3 = $a3;
    }

    public function getA4(): string
    {
        return $this->a4;
    }

    public function setA4(string $a4): void
    {
        $this->a4 = $a4;
    }

    public function getA5(): string
    {
        return $this->a5;
    }

    public function setA5(string $a5): void
    {
        $this->a5 = $a5;
    }

    public function getA6(): string
    {
        return $this->a6;
    }

    public function setA6(string $a6): void
    {
        $this->a6 = $a6;
    }

    public function getA7(): string
    {
        return $this->a7;
    }

    public function setA7(string $a7): void
    {
        $this->a7 = $a7;
    }

    public function getA8(): string
    {
        return $this->a8;
    }

    public function setA8(string $a8): void
    {
        $this->a8 = $a8;
    }

    public function getA9(): string
    {
        return $this->a9;
    }

    public function setA9(string $a9): void
    {
        $this->a9 = $a9;
    }

    public function getA10(): string
    {
        return $this->a10;
    }

    public function setA10(string $a10): void
    {
        $this->a10 = $a10;
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
