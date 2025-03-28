<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'ChannelsEntity')]
class ChannelsEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'uuid', description: '', type: 'string')]
    private string $uuid;

    #[OA\Property(property: 'direction', description: '', type: 'string')]
    private string $direction;

    #[OA\Property(property: 'created', description: '', type: 'string')]
    private string $created;

    #[OA\Property(property: 'created_epoch', description: '', type: 'integer')]
    private int $created_epoch;

    #[OA\Property(property: 'name', description: '', type: 'string')]
    private string $name;

    #[OA\Property(property: 'state', description: '', type: 'string')]
    private string $state;

    #[OA\Property(property: 'cid_name', description: '', type: 'string')]
    private string $cid_name;

    #[OA\Property(property: 'cid_num', description: '', type: 'string')]
    private string $cid_num;

    #[OA\Property(property: 'ip_addr', description: '', type: 'string')]
    private string $ip_addr;

    #[OA\Property(property: 'dest', description: '', type: 'string')]
    private string $dest;

    #[OA\Property(property: 'application', description: '', type: 'string')]
    private string $application;

    #[OA\Property(property: 'application_data', description: '', type: 'string')]
    private string $application_data;

    #[OA\Property(property: 'dialplan', description: '', type: 'string')]
    private string $dialplan;

    #[OA\Property(property: 'context', description: '', type: 'string')]
    private string $context;

    #[OA\Property(property: 'read_codec', description: '', type: 'string')]
    private string $read_codec;

    #[OA\Property(property: 'read_rate', description: '', type: 'string')]
    private string $read_rate;

    #[OA\Property(property: 'read_bit_rate', description: '', type: 'string')]
    private string $read_bit_rate;

    #[OA\Property(property: 'write_codec', description: '', type: 'string')]
    private string $write_codec;

    #[OA\Property(property: 'write_rate', description: '', type: 'string')]
    private string $write_rate;

    #[OA\Property(property: 'write_bit_rate', description: '', type: 'string')]
    private string $write_bit_rate;

    #[OA\Property(property: 'secure', description: '', type: 'string')]
    private string $secure;

    #[OA\Property(property: 'hostname', description: '', type: 'string')]
    private string $hostname;

    #[OA\Property(property: 'presence_id', description: '', type: 'string')]
    private string $presence_id;

    #[OA\Property(property: 'presence_data', description: '', type: 'string')]
    private string $presence_data;

    #[OA\Property(property: 'accountcode', description: '', type: 'string')]
    private string $accountcode;

    #[OA\Property(property: 'callstate', description: '', type: 'string')]
    private string $callstate;

    #[OA\Property(property: 'callee_name', description: '', type: 'string')]
    private string $callee_name;

    #[OA\Property(property: 'callee_num', description: '', type: 'string')]
    private string $callee_num;

    #[OA\Property(property: 'callee_direction', description: '', type: 'string')]
    private string $callee_direction;

    #[OA\Property(property: 'call_uuid', description: '', type: 'string')]
    private string $call_uuid;

    #[OA\Property(property: 'sent_callee_name', description: '', type: 'string')]
    private string $sent_callee_name;

    #[OA\Property(property: 'sent_callee_num', description: '', type: 'string')]
    private string $sent_callee_num;

    #[OA\Property(property: 'initial_cid_name', description: '', type: 'string')]
    private string $initial_cid_name;

    #[OA\Property(property: 'initial_cid_num', description: '', type: 'string')]
    private string $initial_cid_num;

    #[OA\Property(property: 'initial_ip_addr', description: '', type: 'string')]
    private string $initial_ip_addr;

    #[OA\Property(property: 'initial_dest', description: '', type: 'string')]
    private string $initial_dest;

    #[OA\Property(property: 'initial_dialplan', description: '', type: 'string')]
    private string $initial_dialplan;

    #[OA\Property(property: 'initial_context', description: '', type: 'string')]
    private string $initial_context;

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }

    public function getCreated(): string
    {
        return $this->created;
    }

    public function setCreated(string $created): void
    {
        $this->created = $created;
    }

    public function getCreatedEpoch(): int
    {
        return $this->created_epoch;
    }

    public function setCreatedEpoch(int $created_epoch): void
    {
        $this->created_epoch = $created_epoch;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getCidName(): string
    {
        return $this->cid_name;
    }

    public function setCidName(string $cid_name): void
    {
        $this->cid_name = $cid_name;
    }

    public function getCidNum(): string
    {
        return $this->cid_num;
    }

    public function setCidNum(string $cid_num): void
    {
        $this->cid_num = $cid_num;
    }

    public function getIpAddr(): string
    {
        return $this->ip_addr;
    }

    public function setIpAddr(string $ip_addr): void
    {
        $this->ip_addr = $ip_addr;
    }

    public function getDest(): string
    {
        return $this->dest;
    }

    public function setDest(string $dest): void
    {
        $this->dest = $dest;
    }

    public function getApplication(): string
    {
        return $this->application;
    }

    public function setApplication(string $application): void
    {
        $this->application = $application;
    }

    public function getApplicationData(): string
    {
        return $this->application_data;
    }

    public function setApplicationData(string $application_data): void
    {
        $this->application_data = $application_data;
    }

    public function getDialplan(): string
    {
        return $this->dialplan;
    }

    public function setDialplan(string $dialplan): void
    {
        $this->dialplan = $dialplan;
    }

    public function getContext(): string
    {
        return $this->context;
    }

    public function setContext(string $context): void
    {
        $this->context = $context;
    }

    public function getReadCodec(): string
    {
        return $this->read_codec;
    }

    public function setReadCodec(string $read_codec): void
    {
        $this->read_codec = $read_codec;
    }

    public function getReadRate(): string
    {
        return $this->read_rate;
    }

    public function setReadRate(string $read_rate): void
    {
        $this->read_rate = $read_rate;
    }

    public function getReadBitRate(): string
    {
        return $this->read_bit_rate;
    }

    public function setReadBitRate(string $read_bit_rate): void
    {
        $this->read_bit_rate = $read_bit_rate;
    }

    public function getWriteCodec(): string
    {
        return $this->write_codec;
    }

    public function setWriteCodec(string $write_codec): void
    {
        $this->write_codec = $write_codec;
    }

    public function getWriteRate(): string
    {
        return $this->write_rate;
    }

    public function setWriteRate(string $write_rate): void
    {
        $this->write_rate = $write_rate;
    }

    public function getWriteBitRate(): string
    {
        return $this->write_bit_rate;
    }

    public function setWriteBitRate(string $write_bit_rate): void
    {
        $this->write_bit_rate = $write_bit_rate;
    }

    public function getSecure(): string
    {
        return $this->secure;
    }

    public function setSecure(string $secure): void
    {
        $this->secure = $secure;
    }

    public function getHostname(): string
    {
        return $this->hostname;
    }

    public function setHostname(string $hostname): void
    {
        $this->hostname = $hostname;
    }

    public function getPresenceId(): string
    {
        return $this->presence_id;
    }

    public function setPresenceId(string $presence_id): void
    {
        $this->presence_id = $presence_id;
    }

    public function getPresenceData(): string
    {
        return $this->presence_data;
    }

    public function setPresenceData(string $presence_data): void
    {
        $this->presence_data = $presence_data;
    }

    public function getAccountcode(): string
    {
        return $this->accountcode;
    }

    public function setAccountcode(string $accountcode): void
    {
        $this->accountcode = $accountcode;
    }

    public function getCallstate(): string
    {
        return $this->callstate;
    }

    public function setCallstate(string $callstate): void
    {
        $this->callstate = $callstate;
    }

    public function getCalleeName(): string
    {
        return $this->callee_name;
    }

    public function setCalleeName(string $callee_name): void
    {
        $this->callee_name = $callee_name;
    }

    public function getCalleeNum(): string
    {
        return $this->callee_num;
    }

    public function setCalleeNum(string $callee_num): void
    {
        $this->callee_num = $callee_num;
    }

    public function getCalleeDirection(): string
    {
        return $this->callee_direction;
    }

    public function setCalleeDirection(string $callee_direction): void
    {
        $this->callee_direction = $callee_direction;
    }

    public function getCallUuid(): string
    {
        return $this->call_uuid;
    }

    public function setCallUuid(string $call_uuid): void
    {
        $this->call_uuid = $call_uuid;
    }

    public function getSentCalleeName(): string
    {
        return $this->sent_callee_name;
    }

    public function setSentCalleeName(string $sent_callee_name): void
    {
        $this->sent_callee_name = $sent_callee_name;
    }

    public function getSentCalleeNum(): string
    {
        return $this->sent_callee_num;
    }

    public function setSentCalleeNum(string $sent_callee_num): void
    {
        $this->sent_callee_num = $sent_callee_num;
    }

    public function getInitialCidName(): string
    {
        return $this->initial_cid_name;
    }

    public function setInitialCidName(string $initial_cid_name): void
    {
        $this->initial_cid_name = $initial_cid_name;
    }

    public function getInitialCidNum(): string
    {
        return $this->initial_cid_num;
    }

    public function setInitialCidNum(string $initial_cid_num): void
    {
        $this->initial_cid_num = $initial_cid_num;
    }

    public function getInitialIpAddr(): string
    {
        return $this->initial_ip_addr;
    }

    public function setInitialIpAddr(string $initial_ip_addr): void
    {
        $this->initial_ip_addr = $initial_ip_addr;
    }

    public function getInitialDest(): string
    {
        return $this->initial_dest;
    }

    public function setInitialDest(string $initial_dest): void
    {
        $this->initial_dest = $initial_dest;
    }

    public function getInitialDialplan(): string
    {
        return $this->initial_dialplan;
    }

    public function setInitialDialplan(string $initial_dialplan): void
    {
        $this->initial_dialplan = $initial_dialplan;
    }

    public function getInitialContext(): string
    {
        return $this->initial_context;
    }

    public function setInitialContext(string $initial_context): void
    {
        $this->initial_context = $initial_context;
    }
}
