<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'PhoneLocationEntity')]
class PhoneLocationEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'pref', description: '号段前缀', type: 'string')]
    private string $pref;

    #[OA\Property(property: 'phone', description: '手机号', type: 'string')]
    private string $phone;

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

    #[OA\Property(property: 'area_code', description: '行政区划编码', type: 'string')]
    private string $area_code;

    #[OA\Property(property: 'create_time', description: '', type: 'string')]
    private string $create_time;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getPref(): string
    {
        return $this->pref;
    }

    public function setPref(string $pref): void
    {
        $this->pref = $pref;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
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

    public function getAreaCode(): string
    {
        return $this->area_code;
    }

    public function setAreaCode(string $area_code): void
    {
        $this->area_code = $area_code;
    }

    public function getCreateTime(): string
    {
        return $this->create_time;
    }

    public function setCreateTime(string $create_time): void
    {
        $this->create_time = $create_time;
    }
}
