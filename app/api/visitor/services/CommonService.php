<?php

namespace app\api\visitor\services;

use Flame\Support\Facade\Log;
use GuzzleHttp\Client;

class CommonService
{
    public function isCnStr($name): bool
    {
        if (empty($name)) {

            return false;
        }

        preg_match('/^[\x{4e00}-\x{9fa5}]+$/u', $name, $matches);

        return !empty($matches);
    }

    public function containsCnStr($name): bool
    {
        if (empty($name)) {

            return false;
        }

        preg_match('/[\x{4e00}-\x{9fa5}]+/u', $name, $matches);

        return !empty($matches);
    }

    public function transStr(array $keywords, $form = 'en', $to = 'zh-Hans'): array
    {
        $result = [
            'status' => false,
            'msg' => '',
            'data' => [],
        ];

        $client = new Client();
        $uri = "https://edge.microsoft.com/translate/translatetext?from={$form}&to={$to}";
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Connection' => 'keep-alive',
            ],
            'json' => $keywords,
            'timeout' => 10,
        ];
        try {
            $ret = $client->post($uri, $options);
        } catch (\Throwable $e) {
            Log::error($e->getMessage() . ':' . $e->getTraceAsString());
            dump($e);

            return $result;
        }

        if ($ret->getStatusCode() == 200) {
            $content = $ret->getBody()->getContents();
            $arr = json_decode($content, true) ?: [];
            if (!empty($arr)) {
                $result['status'] = true;
                $result['data'] = $arr;
            }
        }

        return $result;
    }

    public function transStrSingle($name, $form = 'en', $to = 'zh-Hans')
    {
        $ret = $this->transStr([$name], $form, $to);
        if ($ret['status'] && !empty($ret['data'])) {

            return $ret['data'][0]['translations'][0]['text'] ?: false;
        } else {

            return false;
        }
    }
}