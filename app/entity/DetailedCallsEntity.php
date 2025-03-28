<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'DetailedCallsEntity')]
class DetailedCallsEntity
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

    #[OA\Property(property: 'b_uuid', description: '', type: 'string')]
    private string $b_uuid;

    #[OA\Property(property: 'b_direction', description: '', type: 'string')]
    private string $b_direction;

    #[OA\Property(property: 'b_created', description: '', type: 'string')]
    private string $b_created;

    #[OA\Property(property: 'b_created_epoch', description: '', type: 'integer')]
    private int $b_created_epoch;

    #[OA\Property(property: 'b_name', description: '', type: 'string')]
    private string $b_name;

    #[OA\Property(property: 'b_state', description: '', type: 'string')]
    private string $b_state;

    #[OA\Property(property: 'b_cid_name', description: '', type: 'string')]
    private string $b_cid_name;

    #[OA\Property(property: 'b_cid_num', description: '', type: 'string')]
    private string $b_cid_num;

    #[OA\Property(property: 'b_ip_addr', description: '', type: 'string')]
    private string $b_ip_addr;

    #[OA\Property(property: 'b_dest', description: '', type: 'string')]
    private string $b_dest;

    #[OA\Property(property: 'b_application', description: '', type: 'string')]
    private string $b_application;

    #[OA\Property(property: 'b_application_data', description: '', type: 'string')]
    private string $b_application_data;

    #[OA\Property(property: 'b_dialplan', description: '', type: 'string')]
    private string $b_dialplan;

    #[OA\Property(property: 'b_context', description: '', type: 'string')]
    private string $b_context;

    #[OA\Property(property: 'b_read_codec', description: '', type: 'string')]
    private string $b_read_codec;

    #[OA\Property(property: 'b_read_rate', description: '', type: 'string')]
    private string $b_read_rate;

    #[OA\Property(property: 'b_read_bit_rate', description: '', type: 'string')]
    private string $b_read_bit_rate;

    #[OA\Property(property: 'b_write_codec', description: '', type: 'string')]
    private string $b_write_codec;

    #[OA\Property(property: 'b_write_rate', description: '', type: 'string')]
    private string $b_write_rate;

    #[OA\Property(property: 'b_write_bit_rate', description: '', type: 'string')]
    private string $b_write_bit_rate;

    #[OA\Property(property: 'b_secure', description: '', type: 'string')]
    private string $b_secure;

    #[OA\Property(property: 'b_hostname', description: '', type: 'string')]
    private string $b_hostname;

    #[OA\Property(property: 'b_presence_id', description: '', type: 'string')]
    private string $b_presence_id;

    #[OA\Property(property: 'b_presence_data', description: '', type: 'string')]
    private string $b_presence_data;

    #[OA\Property(property: 'b_accountcode', description: '', type: 'string')]
    private string $b_accountcode;

    #[OA\Property(property: 'b_callstate', description: '', type: 'string')]
    private string $b_callstate;

    #[OA\Property(property: 'b_callee_name', description: '', type: 'string')]
    private string $b_callee_name;

    #[OA\Property(property: 'b_callee_num', description: '', type: 'string')]
    private string $b_callee_num;

    #[OA\Property(property: 'b_callee_direction', description: '', type: 'string')]
    private string $b_callee_direction;

    #[OA\Property(property: 'b_call_uuid', description: '', type: 'string')]
    private string $b_call_uuid;

    #[OA\Property(property: 'b_sent_callee_name', description: '', type: 'string')]
    private string $b_sent_callee_name;

    #[OA\Property(property: 'b_sent_callee_num', description: '', type: 'string')]
    private string $b_sent_callee_num;

    #[OA\Property(property: 'call_created_epoch', description: '', type: 'integer')]
    private int $call_created_epoch;

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

    public function getBUuid(): string
    {
        return $this->b_uuid;
    }

    public function setBUuid(string $b_uuid): void
    {
        $this->b_uuid = $b_uuid;
    }

    public function getBDirection(): string
    {
        return $this->b_direction;
    }

    public function setBDirection(string $b_direction): void
    {
        $this->b_direction = $b_direction;
    }

    public function getBCreated(): string
    {
        return $this->b_created;
    }

    public function setBCreated(string $b_created): void
    {
        $this->b_created = $b_created;
    }

    public function getBCreatedEpoch(): int
    {
        return $this->b_created_epoch;
    }

    public function setBCreatedEpoch(int $b_created_epoch): void
    {
        $this->b_created_epoch = $b_created_epoch;
    }

    public function getBName(): string
    {
        return $this->b_name;
    }

    public function setBName(string $b_name): void
    {
        $this->b_name = $b_name;
    }

    public function getBState(): string
    {
        return $this->b_state;
    }

    public function setBState(string $b_state): void
    {
        $this->b_state = $b_state;
    }

    public function getBCidName(): string
    {
        return $this->b_cid_name;
    }

    public function setBCidName(string $b_cid_name): void
    {
        $this->b_cid_name = $b_cid_name;
    }

    public function getBCidNum(): string
    {
        return $this->b_cid_num;
    }

    public function setBCidNum(string $b_cid_num): void
    {
        $this->b_cid_num = $b_cid_num;
    }

    public function getBIpAddr(): string
    {
        return $this->b_ip_addr;
    }

    public function setBIpAddr(string $b_ip_addr): void
    {
        $this->b_ip_addr = $b_ip_addr;
    }

    public function getBDest(): string
    {
        return $this->b_dest;
    }

    public function setBDest(string $b_dest): void
    {
        $this->b_dest = $b_dest;
    }

    public function getBApplication(): string
    {
        return $this->b_application;
    }

    public function setBApplication(string $b_application): void
    {
        $this->b_application = $b_application;
    }

    public function getBApplicationData(): string
    {
        return $this->b_application_data;
    }

    public function setBApplicationData(string $b_application_data): void
    {
        $this->b_application_data = $b_application_data;
    }

    public function getBDialplan(): string
    {
        return $this->b_dialplan;
    }

    public function setBDialplan(string $b_dialplan): void
    {
        $this->b_dialplan = $b_dialplan;
    }

    public function getBContext(): string
    {
        return $this->b_context;
    }

    public function setBContext(string $b_context): void
    {
        $this->b_context = $b_context;
    }

    public function getBReadCodec(): string
    {
        return $this->b_read_codec;
    }

    public function setBReadCodec(string $b_read_codec): void
    {
        $this->b_read_codec = $b_read_codec;
    }

    public function getBReadRate(): string
    {
        return $this->b_read_rate;
    }

    public function setBReadRate(string $b_read_rate): void
    {
        $this->b_read_rate = $b_read_rate;
    }

    public function getBReadBitRate(): string
    {
        return $this->b_read_bit_rate;
    }

    public function setBReadBitRate(string $b_read_bit_rate): void
    {
        $this->b_read_bit_rate = $b_read_bit_rate;
    }

    public function getBWriteCodec(): string
    {
        return $this->b_write_codec;
    }

    public function setBWriteCodec(string $b_write_codec): void
    {
        $this->b_write_codec = $b_write_codec;
    }

    public function getBWriteRate(): string
    {
        return $this->b_write_rate;
    }

    public function setBWriteRate(string $b_write_rate): void
    {
        $this->b_write_rate = $b_write_rate;
    }

    public function getBWriteBitRate(): string
    {
        return $this->b_write_bit_rate;
    }

    public function setBWriteBitRate(string $b_write_bit_rate): void
    {
        $this->b_write_bit_rate = $b_write_bit_rate;
    }

    public function getBSecure(): string
    {
        return $this->b_secure;
    }

    public function setBSecure(string $b_secure): void
    {
        $this->b_secure = $b_secure;
    }

    public function getBHostname(): string
    {
        return $this->b_hostname;
    }

    public function setBHostname(string $b_hostname): void
    {
        $this->b_hostname = $b_hostname;
    }

    public function getBPresenceId(): string
    {
        return $this->b_presence_id;
    }

    public function setBPresenceId(string $b_presence_id): void
    {
        $this->b_presence_id = $b_presence_id;
    }

    public function getBPresenceData(): string
    {
        return $this->b_presence_data;
    }

    public function setBPresenceData(string $b_presence_data): void
    {
        $this->b_presence_data = $b_presence_data;
    }

    public function getBAccountcode(): string
    {
        return $this->b_accountcode;
    }

    public function setBAccountcode(string $b_accountcode): void
    {
        $this->b_accountcode = $b_accountcode;
    }

    public function getBCallstate(): string
    {
        return $this->b_callstate;
    }

    public function setBCallstate(string $b_callstate): void
    {
        $this->b_callstate = $b_callstate;
    }

    public function getBCalleeName(): string
    {
        return $this->b_callee_name;
    }

    public function setBCalleeName(string $b_callee_name): void
    {
        $this->b_callee_name = $b_callee_name;
    }

    public function getBCalleeNum(): string
    {
        return $this->b_callee_num;
    }

    public function setBCalleeNum(string $b_callee_num): void
    {
        $this->b_callee_num = $b_callee_num;
    }

    public function getBCalleeDirection(): string
    {
        return $this->b_callee_direction;
    }

    public function setBCalleeDirection(string $b_callee_direction): void
    {
        $this->b_callee_direction = $b_callee_direction;
    }

    public function getBCallUuid(): string
    {
        return $this->b_call_uuid;
    }

    public function setBCallUuid(string $b_call_uuid): void
    {
        $this->b_call_uuid = $b_call_uuid;
    }

    public function getBSentCalleeName(): string
    {
        return $this->b_sent_callee_name;
    }

    public function setBSentCalleeName(string $b_sent_callee_name): void
    {
        $this->b_sent_callee_name = $b_sent_callee_name;
    }

    public function getBSentCalleeNum(): string
    {
        return $this->b_sent_callee_num;
    }

    public function setBSentCalleeNum(string $b_sent_callee_num): void
    {
        $this->b_sent_callee_num = $b_sent_callee_num;
    }

    public function getCallCreatedEpoch(): int
    {
        return $this->call_created_epoch;
    }

    public function setCallCreatedEpoch(int $call_created_epoch): void
    {
        $this->call_created_epoch = $call_created_epoch;
    }
}
