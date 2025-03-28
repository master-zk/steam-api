<?php

namespace app\bundles\system\service;

use _PHPStan_d5312c05b\React\Http\Message\ResponseException;
use app\exception\CustomException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class FileService
{
    public function getAudioUrl(string $txtFile): string
    {
        $errorMsg = '文本转语音失败';
        $url = config('bundle.system.call_center_py_host').'/txtToAudio';
        $client = new Client(['verify' => false]);
        try {
            $ret = $client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'file' => $txtFile,
                ],
                'timeout' => 290,
            ]);
        } catch (\Throwable $th) {
            if ($th instanceof GuzzleException) {
                if ($th instanceof RequestException) {
                    $errorMsg .= ":语音服务请求异常:{$th->getMessage()}";
                } elseif ($th instanceof ResponseException) {
                    $errorMsg .= ":语音服务响应异常:{$th->getMessage()}";
                } elseif ($th instanceof ConnectException) {
                    $errorMsg .= ":语音服务连接异常:{$th->getMessage()}";
                } else {
                    $errorMsg .= ":语音服务异常:{$th->getMessage()}";
                }
            } else {
                $errorMsg .= ":{$th->getMessage()}";
            }
            throw new CustomException($errorMsg);
        }

        if ($ret->getStatusCode() == 200) {
            $content = $ret->getBody()->getContents();
            $arr = json_decode($content, true) ?: [];
            if (isset($arr['code']) && $arr['code'] == '1') {
                if (! empty($arr['data'])) {
                    return $arr['data'];
                } elseif (! empty($arr['message'])) {
                    $errorMsg = $arr['message'];
                }
            }
        }

        throw new CustomException($errorMsg);
    }
}
