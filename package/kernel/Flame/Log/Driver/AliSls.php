<?php

declare(strict_types=1);

namespace Flame\Log\Driver;

use Aliyun_Log_Client;
use Aliyun_Log_Models_LogItem;
use Aliyun_Log_Models_PutLogsRequest;
use Exception;
use Flame\Log\Contract\LogHandlerInterface;

class AliSls implements LogHandlerInterface
{
    /**
     * 配置参数
     */
    protected array $config = [
        'endpoint' => 'https://cn-beijing.sls.aliyuncs.com/',
        'access_key_id' => '',
        'access_key_secret' => '',
        'project' => '',
        'logstore' => '',
        'source' => '',
        'topic' => 'default',
        'json' => false,
        'json_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
        'time_format' => 'c',
    ];

    public function __construct()
    {
        $config = config('log.channels.sls');

        if (is_array($config)) {
            $this->config = array_merge($this->config, $config);
        }
    }

    /**
     * 日志写入接口
     *
     * @throws Exception
     */
    public function save(array $log): bool
    {
        $info = [];

        // 日志信息封装
        foreach ($log as $type => $val) {
            $message = [];
            foreach ($val as $msg) {
                if (! is_string($msg)) {
                    $msg = var_export($msg, true);
                }

                $contents = $this->config['json'] ?
                    ['content' => json_encode(['type' => $type, 'msg' => $msg], $this->config['json_options'])] :
                    ['type' => $type, 'msg' => $msg];

                $logItem = new Aliyun_Log_Models_LogItem;
                $logItem->setTime(time());
                $logItem->setContents($contents);

                $message[] = $logItem;
            }

            $info = $message;
        }

        if ($info) {
            return $this->write($info);
        }

        return true;
    }

    /**
     * 日志写入
     */
    protected function write(array $message): bool
    {
        try {
            $req = new Aliyun_Log_Models_PutLogsRequest($this->config['project'], $this->config['logstore'], $this->config['topic'], $this->config['source'], $message);

            $slsClient = $this->slsClient();
            $slsClient->putLogs($req);

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    private function slsClient(): Aliyun_Log_Client
    {
        static $client = null;

        if (is_null($client)) {
            $client = new Aliyun_Log_Client($this->config['endpoint'], $this->config['access_key_id'], $this->config['access_key_secret']);
        }

        return $client;
    }
}
