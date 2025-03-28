<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'CallIvrItemEntity')]
class CallIvrItemEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'ivr_id', description: 'IvrId', type: 'integer')]
    private int $ivr_id;

    #[OA\Property(property: 'pid', description: '父级ID', type: 'integer')]
    private int $pid;

    #[OA\Property(property: 'name', description: '导航名称', type: 'string')]
    private string $name;

    #[OA\Property(property: 'desc', description: '导航介绍', type: 'string')]
    private string $desc;

    #[OA\Property(property: 'key', description: '导航按键', type: 'string')]
    private string $key;

    #[OA\Property(property: 'action', description: '导航动作: 1=选择下一级导航 2=分配到组 3=返回上一级菜单 4=重听', type: 'integer')]
    private int $action;

    #[OA\Property(property: 'origin_txt_url', description: '导航文本地址', type: 'string')]
    private string $origin_txt_url;

    #[OA\Property(property: 'audio_type', description: '语音文件类型：1=文本转语音 2=直接上传 3=系统生成', type: 'integer')]
    private int $audio_type;

    #[OA\Property(property: 'audio_url', description: '导航语音地址', type: 'string')]
    private string $audio_url;

    #[OA\Property(property: 'group_id', description: '分配到的组ID', type: 'integer')]
    private int $group_id;

    #[OA\Property(property: 'level', description: '层级: 1,2,3...', type: 'integer')]
    private int $level;

    #[OA\Property(property: 'creator_id', description: '创建人ID', type: 'integer')]
    private int $creator_id;

    #[OA\Property(property: 'created_time', description: '创建时间', type: 'string')]
    private string $created_time;

    #[OA\Property(property: 'updated_time', description: '更新时间', type: 'string')]
    private string $updated_time;

    #[OA\Property(property: 'deleted_time', description: '删除时间', type: 'string')]
    private string $deleted_time;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getIvrId(): int
    {
        return $this->ivr_id;
    }

    public function setIvrId(int $ivr_id): void
    {
        $this->ivr_id = $ivr_id;
    }

    public function getPid(): int
    {
        return $this->pid;
    }

    public function setPid(int $pid): void
    {
        $this->pid = $pid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDesc(): string
    {
        return $this->desc;
    }

    public function setDesc(string $desc): void
    {
        $this->desc = $desc;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    public function getAction(): int
    {
        return $this->action;
    }

    public function setAction(int $action): void
    {
        $this->action = $action;
    }

    public function getOriginTxtUrl(): string
    {
        return $this->origin_txt_url;
    }

    public function setOriginTxtUrl(string $origin_txt_url): void
    {
        $this->origin_txt_url = $origin_txt_url;
    }

    public function getAudioType(): int
    {
        return $this->audio_type;
    }

    public function setAudioType(int $audio_type): void
    {
        $this->audio_type = $audio_type;
    }

    public function getAudioUrl(): string
    {
        return $this->audio_url;
    }

    public function setAudioUrl(string $audio_url): void
    {
        $this->audio_url = $audio_url;
    }

    public function getGroupId(): int
    {
        return $this->group_id;
    }

    public function setGroupId(int $group_id): void
    {
        $this->group_id = $group_id;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getCreatorId(): int
    {
        return $this->creator_id;
    }

    public function setCreatorId(int $creator_id): void
    {
        $this->creator_id = $creator_id;
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

    public function getDeletedTime(): string
    {
        return $this->deleted_time;
    }

    public function setDeletedTime(string $deleted_time): void
    {
        $this->deleted_time = $deleted_time;
    }
}
