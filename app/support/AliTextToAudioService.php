<?php

namespace app\support;

class AliTextToAudioService
{
    public $appKey = 'meYrCTVpjw2oPdgz';

    public $token = 'dd3b4c10962a4ae59b607dc059bd561f';

    public function __construct($appKey = '', $token = '')
    {
        if (! empty($appKey)) {
            $this->appKey = $appKey;
        }
        if (! empty($token)) {
            $this->token = $token;
        }
    }

    public function processGETRequest($appKey, $token, $text, $audioSaveFile, $format, $sampleRate): void
    {
        $url = 'https://nls-gateway-cn-shanghai.aliyuncs.com/stream/v1/tts';
        $url = $url.'?appkey='.$appKey;
        $url = $url.'&token='.$token;
        $url = $url.'&text='.$text;
        $url = $url.'&format='.$format;
        $url = $url.'&sample_rate='.strval($sampleRate);
        // voice 发音人，可选，默认是xiaoyun。
        $url = $url.'&voice='.'aiyue';
        // volume 音量，范围是0~100，可选，默认50。
        $url = $url.'&volume='.strval(100);
        // speech_rate 语速，范围是-500~500，可选，默认是0。
        $url = $url.'&speech_rate='.strval(0);
        // pitch_rate 语调，范围是-500~500，可选，默认是0。
        // $url = $url . "&pitch_rate=" . strval(0);
        echo $url."\n";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        /**
         * 设置HTTPS GET URL。
         */
        curl_setopt($curl, CURLOPT_URL, $url);
        /**
         * 设置返回的响应包含HTTPS头部信息。
         */
        curl_setopt($curl, CURLOPT_HEADER, true);
        /**
         * 发送HTTPS GET请求。
         */
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($curl);
        if ($response == false) {
            echo "curl_exec failed!\n";
            curl_close($curl);

            return;
        }
        /**
         * 处理服务端返回的响应。
         */
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $headers = substr($response, 0, $headerSize);
        $bodyContent = substr($response, $headerSize);
        curl_close($curl);
        if (stripos($headers, 'Content-Type: audio/mpeg') != false || stripos($headers, 'Content-Type:audio/mpeg') != false) {
            file_put_contents($audioSaveFile, $bodyContent);
            echo "The GET request succeed!\n";
        } else {
            echo 'The GET request failed: '.$bodyContent."\n";
        }
    }

    public function processPOSTRequest($appkey, $token, $text, $audioSaveFile, $format, $sampleRate)
    {
        $url = 'https://nls-gateway-cn-shanghai.aliyuncs.com/stream/v1/tts';
        /**
         * 请求参数，以JSON格式字符串填入HTTPS POST请求的Body中。
         */
        $taskArr = [
            'appkey' => $appkey,
            'token' => $token,
            'text' => $text,
            'format' => $format,
            'sample_rate' => $sampleRate,
            // voice 发音人，可选，默认是xiaoyun。
            // "voice" => "xiaoyun",
            // volume 音量，范围是0~100，可选，默认50。
            // "volume" => 50,
            // speech_rate 语速，范围是-500~500，可选，默认是0。
            // "speech_rate" => 0,
            // pitch_rate 语调，范围是-500~500，可选，默认是0。
            // "pitch_rate" => 0
        ];
        $body = json_encode($taskArr);
        echo 'The POST request body content: '.$body."\n";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        /**
         * 设置HTTPS POST URL。
         */
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        /**
         * 设置HTTPS POST请求头部。
         * */
        $httpHeaders = [
            'Content-Type: application/json',
        ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $httpHeaders);
        /**
         * 设置HTTPS POST请求体。
         */
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        /**
         * 设置返回的响应包含HTTPS头部信息。
         */
        curl_setopt($curl, CURLOPT_HEADER, true);
        /**
         * 发送HTTPS POST请求。
         */
        $response = curl_exec($curl);
        if ($response == false) {
            echo "curl_exec failed!\n";
            curl_close($curl);

            return;
        }
        /**
         * 处理服务端返回的响应。
         */
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $headers = substr($response, 0, $headerSize);
        $bodyContent = substr($response, $headerSize);
        curl_close($curl);
        if (stripos($headers, 'Content-Type: audio/mpeg') != false || stripos($headers, 'Content-Type:audio/mpeg') != false) {
            file_put_contents($audioSaveFile, $bodyContent);
            echo "The POST request succeed!\n";
        } else {
            echo 'The POST request failed: '.$bodyContent."\n";
        }
    }

    public function handle(string $text, $filename = 'syAudio', $sampleRate = 16000, $format = 'mp3', $force = false): void
    {
        $textUrlEncode = urlencode($text);
        $textUrlEncode = preg_replace('/\+/', '%20', $textUrlEncode);
        $textUrlEncode = preg_replace('/\*/', '%2A', $textUrlEncode);
        $textUrlEncode = preg_replace('/%7E/', '~', $textUrlEncode);
        $audioDirPath = runtime_path('app/AliTextToAudio');
        if (! file_exists($audioDirPath)) {
            mkdir($audioDirPath, 0777, true);
        }
        $audioSaveFile = $audioDirPath."/{$filename}.{$format}";
        if (! file_exists($audioSaveFile) || $force) {
            $this->processGETRequest($this->appKey, $this->token, $textUrlEncode, $audioSaveFile, $format, $sampleRate);
        }
    }

    public function getTextArr(): array
    {
        return [
            [
                'title' => '等待1',
                'content' => '当前人工忙，请您耐心等待。',
            ],
            [
                'title' => '等待超时1',
                'content' => '当前线路较忙，请稍后再拨。',
            ],
            [
                'title' => 'A欢迎导航-break',
                'content' => '<speak><break time="1s"/>欢迎致电携华出行，这里是导航A，司机问题请按1，其他问题请按2，重听请按0。<break time="500ms"/></speak>',
            ],
            [
                'title' => 'A司机问题导航',
                'content' => '这里是A司机问题导航，投诉请按1，咨询请按2，按*号键返回上一级',
            ],
            [
                'title' => 'B欢迎导航-break',
                'content' => '<speak><break time="1s"/>欢迎致电携华出行，这里是导航B，司机问题请按1，其他问题请按2，重听请按0。<break time="500ms"/></speak>',
            ],
            [
                'title' => 'B司机问题导航',
                'content' => '这里是B司机问题导航，投诉请按1，咨询请按2，重听请按0，按*号键返回上一级',
            ],
            [
                'title' => '休息一下',
                'content' => '<speak>请闭上眼睛休息一下<break time="10s"/>睁开眼<break time="5s"/>再闭上眼睛<break time="10s"/>好了，请睁开眼睛。</speak>',
            ],
            [
                'title' => '输入错误',
                'content' => '您输入有误，请重新输入',
            ],
            [
                'title' => '输入有误-再见',
                'content' => '您输入有误，感谢来电，再见',
            ],
            [
                'title' => '再见',
                'content' => '<speak>再见<break time="1s"/></speak>',
            ],
        ];
    }
}
