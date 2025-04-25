<?php

namespace app\bundles\game\services;

use DOMElement;
use Flame\Support\Facade\Log;
use GuzzleHttp\Client;
use Ramsey\Uuid\Uuid;

class SteamGameService
{
    public int $platformId = 1;

    public function getClient($args = ['verify' => false]): Client
    {
        return new Client($args);
    }

    public function getGameDetail(string $appid, string $lang = 'cn', string $cc = "cn", bool $includeDlc = false, int $dlcLimit = 10): array
    {
        dump("getGameDetail : {$appid} : $cc - $lang)");
        $lang_arr = ['cn' => 'zh-cn;zh',];
        $params = [
            'query' => [
                'appids' => $appid,
                'cc' => $cc,
                'l' => $lang,
            ],
            'timeout' => 10,
            'headers' => $this->getCommonHeader(),
        ];
        if (array_key_exists($lang, $lang_arr)) {
            $params['headers']['Accept-Language'] = $lang_arr[$lang];
        }

        $data = [];
        $url = 'https://store.steampowered.com/api/appdetails';
        try {
            $response = $this->getClient()->get($url, $params);
            usleep(rand(300, 500)); // 简单等待

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody()->getContents(), true);
            }

            $success = $data[$appid]['success'] ?? false;
            if (!$success) {
                $data[$appid]['data'] = [];
            }
        } catch (\Throwable $e) {
            dump($e->getMessage());
            dump($e->getTraceAsString());
            $data = [];
        }

        if ($includeDlc && !empty($data[$appid]['data']) && $data[$appid]['data']['type'] == 'game' && !empty($data[$appid]['data']['dlc'])) {
            $i = 0;
            // 批量查DLC的内容
            foreach ($data[$appid]['data']['dlc'] as $dlcAppId) {
                $dlcData = $this->getGameDetail($dlcAppId, $lang, $cc, false);

                if (!empty($dlcData)) {
                    $data[$dlcAppId] = $dlcData[$dlcAppId];
                }

                if ($i >= $dlcLimit) {
                    break; // 抓dlc有上限.
                }

                $i++;
            }
        }

        return $data;
    }


    public function getGameAppIds(array $params): array
    {
        try {
            $retContent = $this->getGames($params);
            $appIds = $retContent ? $this->parseAppContent($retContent) : [];
        } catch (\Throwable $e) {
            $appIds = [];
        }
        $data = [];
        //dd($appIds);
        foreach ($appIds as $k => $v) {
            if (is_numeric($k)) {
                $data[] = $k;
            } else {
                if (is_string($k) && count(explode(',', $k)) > 1) {
                    $data[] = explode(',', $k)[0];
                }
            }
        }

        return $data;
    }

    public function getGames($params): string
    {
        $url = 'https://store.steampowered.com/search/results/?query&' . http_build_query($params);
        $options = [
            'timeout' => 20,
            'headers' => $this->getCommonHeader(),
        ];
        $response = $this->getClient()->get($url, $options);

        if ($response->getStatusCode() == 200) {
            $retContent = $response->getBody()->getContents();
        }

        return $retContent ?? '';
    }

    /**
     * 分析 appid接口返回的信息
     * 获取到 appid， 好评率，评论用户人数
     * @param $content
     * @return array
     */
    public function parseAppContent($content): array
    {
        $arr = json_decode($content, true);
        $uuid = date('Ymd_His_') . Uuid::uuid1();
        $filename = "steam/{$uuid}.html";
        $htmlFile = runtime_path($filename);
        $data = [];

        try {
            if (!empty($arr['results_html'])) {
                if (file_exists($htmlFile)) {
                    unlink($htmlFile);
                }
                file_put_contents($htmlFile, $arr['results_html']);
                libxml_use_internal_errors(true);
                $dom = new \DOMDocument();
                $dom->loadHTML($arr['results_html']);
                $domXpath = new \DOMXPath($dom);

                $q = $domXpath->query("//a");
                if (!empty($q)) {
                    $appid = '';
                    /** @var DOMElement $node */
                    foreach ($q as $node) {
                        foreach ($node->attributes as $attr) {
                            if ($attr->name == 'data-ds-appid') {
                                $appid = $attr->value;
                                $data[$appid] = [
                                    "appid" => $appid,
                                    "title" => '',
                                    "rate" => '',
                                    "users" => '',
                                ];
                                break;
                            }
                        }

                        foreach ($node->childNodes as $childNode) {
                            if ($childNode instanceof DOMElement && $childNode->getAttribute('class') == 'responsive_search_name_combined') {
                                foreach ($childNode->childNodes as $childNode1) {
                                    if ($childNode1 instanceof DOMElement && $childNode1->getAttribute('class') == 'col search_name ellipsis') {
                                        foreach ($childNode1->childNodes as $childNode2) {
                                            if ($childNode2 instanceof DOMElement && $childNode2->nodeName == 'span' && $childNode2->getAttribute('class') == 'title') {
                                                $data[$appid]['title'] = $childNode2->nodeValue;
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        $value = $this->findAttr($node->childNodes, "data-tooltip-html");

                        preg_match('/(\d{1,3})%/', $value, $matches);
                        if (count($matches) > 1) {
                            $data[$appid]['rate'] = $matches[1];
                        }
                        preg_match('/([\d,]{1,}) /', $value, $matches);
                        if (count($matches) > 1) {
                            $data[$appid]['users'] = $matches[1];
                        }
                    }
                }
            }
        } catch (\Throwable $e) {
            Log::error("parseAppContentThrowable : msg = {$e->getMessage()}, trace = {$e->getTraceAsString()}");
        } finally {
            if (file_exists($htmlFile)) {
                Log::info($htmlFile);
                dump($htmlFile);
                //unlink($htmlFile);
            }
        }

        return $data;
    }

    public function findAttr($nodes, $name)
    {
        if (empty($nodes)) {
            return null;
        }

        foreach ($nodes as $node) {
            if (empty($node->tagName)) {
                continue;
            }

            if (isset($node->attributes)) {
                foreach ($node->attributes as $attr) {
                    if ($attr->name === $name) {
                        return $attr->value;
                    }
                }
            }

            if (!empty($node->childNodes)) {
                $value = $this->findAttr($node->childNodes, $name);
                if ($value !== null) {
                    return $value;
                }
            }
        }

        return null;
    }

    // 热销商品,按发行日期排序
    public function getTopSellersParams($i, $pageSize): array
    {
        return [
            'start' => $i,
            'count' => $pageSize,
            'filter' => 'topsellers', // 热销商品
            'snr' => '1_7_7_7000_7',
            'sort_by' => '_ASC', // 排序：发行日期
            'infinite' => '1',
            'dynamic_data' => '',
            'category1' => '998', // 类型：游戏
            'supportedlang' => 'schinese,english,tchinese', // 语言
            'os' => '', // 支持的操作系统
        ];
    }

    // 评分排序,按评分排序
    public function getTopSellersReviewsParams($i, $pageSize): array
    {
        return [
            'start' => $i,
            'count' => $pageSize,
            'filter' => 'globaltopsellers', // 高评分排序
            'snr' => '1_7_7_globaltopsellers_7',
            'sort_by' => 'Reviews_DESC', // 排序：评分排序
            'infinite' => '1',
            'category1' => '998', // 类型：游戏
            'supportedlang' => 'schinese,tchinese', // 语言
            'os' => 'win', // 支持的操作系统
        ];
    }

    public function getCommonHeader(): array
    {
        return [
            'Accept' => '*/*',
//            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
            'Origin' => 'https://store.steampowered.com',
            'Content-Type' => 'application/json',
            'Cookie' => 'browserid=344068855326449478;',
        ];
    }

    public function getGameReview(string $appId, $dayRange = 30)
    {
        $params = [
            'query' => [
                'json' => 1,
                'filter' => 'recent',
                'day_range' => $dayRange,
            ],
            'timeout' => 5,
            'headers' => $this->getCommonHeader(),
        ];

        $ret = [];
        $url = "https://store.steampowered.com/appreviews/{$appId}";
        try {
            $response = $this->getClient()->get($url, $params);
            usleep(rand(300, 500)); // 简单等待

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody()->getContents(), true);
            }

            $success = $data['success'] ?? false;
            if ($success) {
                $ret = $data['query_summary'] ?? [];
            }
        } catch (\Throwable $e) {
            dump($e->getMessage());
        }

        return $ret;
    }
}