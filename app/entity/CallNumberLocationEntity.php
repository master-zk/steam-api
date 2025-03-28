<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'CallNumberLocationEntity')]
class CallNumberLocationEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'number_type', description: '号码类型: 1=手机号 2=座机号', type: 'integer')]
    private int $number_type;

    #[OA\Property(property: 'pref', description: '号段前缀: 手机号前3位，座机号前1位', type: 'string')]
    private string $pref;

    #[OA\Property(property: 'number', description: '号码区段： 手机号前七位，座机号区号', type: 'string')]
    private string $number;

    #[OA\Property(property: 'province', description: '省份', type: 'string')]
    private string $province;

    #[OA\Property(property: 'city', description: '城市', type: 'string')]
    private string $city;

    #[OA\Property(property: 'isp', description: '运营商类型名称', type: 'string')]
    private string $isp;

    #[OA\Property(property: 'isp_type', description: '运营商类型 1：移动 2：联通 3：电信 4：广电 5：工信', type: 'integer')]
    private int $isp_type;

    #[OA\Property(property: 'post_code', description: '邮编', type: 'string')]
    private string $post_code;

    #[OA\Property(property: 'city_code', description: '区号', type: 'string')]
    private string $city_code;

    #[OA\Property(property: 'region_id', description: '行政区划编码', type: 'string')]
    private string $region_id;

    #[OA\Property(property: 'created_time', description: '创建时间', type: 'string')]
    private string $created_time;

    #[OA\Property(property: 'updated_time', description: '更新时间', type: 'string')]
    private string $updated_time;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNumberType(): int
    {
        return $this->number_type;
    }

    public function setNumberType(int $number_type): void
    {
        $this->number_type = $number_type;
    }

    public function getPref(): string
    {
        return $this->pref;
    }

    public function setPref(string $pref): void
    {
        $this->pref = $pref;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getProvince(): string
    {
        return $this->province;
    }

    public function setProvince(string $province): void
    {
        $this->province = $province;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getIsp(): string
    {
        return $this->isp;
    }

    public function setIsp(string $isp): void
    {
        $this->isp = $isp;
    }

    public function getIspType(): int
    {
        return $this->isp_type;
    }

    public function setIspType(int $isp_type): void
    {
        $this->isp_type = $isp_type;
    }

    public function getPostCode(): string
    {
        return $this->post_code;
    }

    public function setPostCode(string $post_code): void
    {
        $this->post_code = $post_code;
    }

    public function getCityCode(): string
    {
        return $this->city_code;
    }

    public function setCityCode(string $city_code): void
    {
        $this->city_code = $city_code;
    }

    public function getRegionId(): string
    {
        return $this->region_id;
    }

    public function setRegionId(string $region_id): void
    {
        $this->region_id = $region_id;
    }

    public function getCreatedTime(): string
    {
        return $this->created_time;
    }

    public function setCreatedTime(string $created_time): void
    {
        $this->created_time = $created_time;
    }

    public function getUpdatedTime(): string
    {
        return $this->updated_time;
    }

    public function setUpdatedTime(string $updated_time): void
    {
        $this->updated_time = $updated_time;
    }
}
