<?php

declare(strict_types=1);

namespace app\bundles\system\service;

use app\bundles\system\enums\SmsTemplateCodeEnum;
use app\entity\SmsSendBatchEntity;
use app\entity\SmsSendBatchMobileEntity;
use app\enums\common\StatusEnum;
use app\exception\CustomException;
use app\repository\SmsSendBatchMobileRepository;
use app\repository\SmsSendBatchRepository;
use app\repository\SmsTemplateRepository;
use Flame\Support\Facade\Log;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\GatewayErrorException;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class SmsService
{
    private static ?self $instance = null;

    private array $config;

    /**
     * 单例
     */
    public static function getInstance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function __construct()
    {
        $this->config = config('sms');
    }

    public function singleSendTemplate(int $tenantId, string $mobile, string $code, array $params = [], bool $throwException = false): bool
    {
        try {
            $sendType = $params['send_type'] ?? 1;
            $message = $this->generateTemplateMessage($code, $params, $throwException);
            if ($message === false) {
                throw new CustomException('短信发送失败');
            }
            $batchId = date('YmdHis').rand(100000, 999999);
            // 批次
            $batchInput = new SmsSendBatchEntity;
            $batchInput->setTenantId($tenantId);
            $batchInput->setBatchId($batchId);
            $batchInput->setSendType($sendType);
            $batchInput->setContent($message['content']);
            $batchInput->setTemplateCode($code);
            $batchLogId = SmsSendBatchRepository::getInstance()->createByInput($batchInput);
            // 号码
            $batchMobileInput = new SmsSendBatchMobileEntity;
            $batchMobileInput->setBatchId($batchId);
            $batchMobileInput->setMobile($mobile);
            SmsSendBatchMobileRepository::getInstance()->createByInput($batchMobileInput);
            // 发短信
            $easySms = new EasySms($this->config);
            $easySms->send($mobile, $message);
            SmsSendBatchRepository::getInstance()->updateById([
                'status' => StatusEnum::Enabled->value,
            ], $batchLogId);

            return true;
        } catch (\Throwable $e) {
            $errorDesc = '短信发送失败';
            if ($e instanceof NoGatewayAvailableException) {
                $lastException = $e->getLastException();
                if ($lastException instanceof GatewayErrorException) {
                    if (! empty($lastException->raw['Code']) && $lastException->raw['Code'] == 'isv.BUSINESS_LIMIT_CONTROL') {
                        $errorDesc = '短信发送太频繁，请稍后再试';
                    }
                }
            }
            isset($batchLogId) && SmsSendBatchRepository::getInstance()->updateById([
                'status' => StatusEnum::Disabled->value,
                'error_desc' => $errorDesc,
            ], $batchLogId);

            Log::error(json_encode($e));
            if ($throwException) {
                throw new CustomException($errorDesc);
            }

            return false;
        }
    }

    public function generateTemplateMessage(string $code, array $params = [], bool $throwException = false): bool|array
    {
        $entity = SmsTemplateRepository::getInstance()->findOneByWhereReturnSmsTemplateOutput([
            'code' => $code,
            'status' => StatusEnum::Enabled,
        ]);
        if (empty($entity)) {
            if ($throwException) {
                throw new CustomException('短信模版不可用');
            }
            Log::warning("短信模版不可用:code={$code}");

            return false;
        } else {
            $content = $entity->getContent();
            $message = [
                'content' => $content,
                'template' => $entity->getThirdId(),
                'data' => [],
            ];
            switch ($code) {
                case SmsTemplateCodeEnum::UserLoginCaptcha->value:
                    $message['data'] = [
                        'code' => (string) ($params['code'] ?? ''),
                    ];
                    $message['content'] = $this->contentParser($content, $message['data']);

                    break;
                default:
                    break;
            }

            return $message;
        }
    }

    /**
     * 短信内容模板解析
     */
    private function contentParser(string $content, array $data): string
    {
        // 替换消息变量
        preg_match_all('/\$\{(.+?)\}/', $content, $matches);
        foreach ($matches[1] as $vo) {
            $content = str_replace('${'.$vo.'}', $data[$vo], $content);
        }

        return $content;
    }
}
