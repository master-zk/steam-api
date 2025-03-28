<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'RegionEntity')]
class RegionEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'region_id', description: '行政代码', type: 'string')]
    private string $region_id;

    #[OA\Property(property: 'region_name', description: '名称', type: 'string')]
    private string $region_name;

    #[OA\Property(property: 'parent_id', description: '行政代码', type: 'string')]
    private string $parent_id;

    #[OA\Property(property: 'short_name', description: '', type: 'string')]
    private string $short_name;

    #[OA\Property(property: 'level', description: '层级', type: 'string')]
    private string $level;

    #[OA\Property(property: 'city_code', description: '区号', type: 'string')]
    private string $city_code;

    #[OA\Property(property: 'zip_code', description: '邮政编码', type: 'string')]
    private string $zip_code;

    #[OA\Property(property: 'merger_name', description: '', type: 'string')]
    private string $merger_name;

    #[OA\Property(property: 'lng', description: '经度', type: 'string')]
    private string $lng;

    #[OA\Property(property: 'lat', description: '纬度', type: 'string')]
    private string $lat;

    #[OA\Property(property: 'pinyin', description: '拼音', type: 'string')]
    private string $pinyin;

    public function getRegionId(): string
    {
        return $this->region_id;
    }

    public function setRegionId(string $region_id): void
    {
        $this->region_id = $region_id;
    }

    public function getRegionName(): string
    {
        return $this->region_name;
    }

    public function setRegionName(string $region_name): void
    {
        $this->region_name = $region_name;
    }

    public function getParentId(): string
    {
        return $this->parent_id;
    }

    public function setParentId(string $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    public function getShortName(): string
    {
        return $this->short_name;
    }

    public function setShortName(string $short_name): void
    {
        $this->short_name = $short_name;
    }

    public function getLevel(): string
    {
        return $this->level;
    }

    public function setLevel(string $level): void
    {
        $this->level = $level;
    }

    public function getCityCode(): string
    {
        return $this->city_code;
    }

    public function setCityCode(string $city_code): void
    {
        $this->city_code = $city_code;
    }

    public function getZipCode(): string
    {
        return $this->zip_code;
    }

    public function setZipCode(string $zip_code): void
    {
        $this->zip_code = $zip_code;
    }

    public function getMergerName(): string
    {
        return $this->merger_name;
    }

    public function setMergerName(string $merger_name): void
    {
        $this->merger_name = $merger_name;
    }

    public function getLng(): string
    {
        return $this->lng;
    }

    public function setLng(string $lng): void
    {
        $this->lng = $lng;
    }

    public function getLat(): string
    {
        return $this->lat;
    }

    public function setLat(string $lat): void
    {
        $this->lat = $lat;
    }

    public function getPinyin(): string
    {
        return $this->pinyin;
    }

    public function setPinyin(string $pinyin): void
    {
        $this->pinyin = $pinyin;
    }
}
