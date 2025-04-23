<?php

declare(strict_types=1);

namespace app\console\commands;

use app\api\visitor\enum\MediaTypeEnum;
use app\api\visitor\input\GameInput;
use app\api\visitor\services\CategoryService;
use app\api\visitor\services\CommonService;
use app\api\visitor\services\GameService;
use app\bundles\game\scheduler\GetSteamGameInfoTask;
use app\const\Table;
use Flame\Support\Facade\DB;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use think\db\Where;
use function MongoDB\BSON\fromJSON;

class HelloCommand extends Command
{
    public function __construct(?string $name = null)
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setName('hello')
            ->setDescription('The hello test.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        echo 'hello world' . PHP_EOL;
        $beginMic = microtime(true);
        //$maxProcesses = $maxProcesses ?? max(1, (int) shell_exec('nproc') ?? 4);
        $this->testGameList();


        //$this->testGameInfo();


        $endMic = microtime(true);
        dump($beginMic, $endMic, $endMic - $beginMic);

        return 0;
    }


    public function testGameList(): void
    {
        (new GetSteamGameInfoTask())->handle();
    }

    public function testGameInfo($platformId = 1): void
    {
        //$commonService = new CommonService();
        //$commonService->containsCnStr('误杀 2');
        $i = 0;
        while ($i <= 1000) {
            $i++;
            $rawId = DB::table(Table::GAME_RAW)
                ->where('platform_id', '=', $platformId)
                ->where('load_run_status', '=', 1)
                ->where('sync_run_status', '=', 2)
                ->order('id', 'asc')
                ->value('id');
            if ($rawId > 0) {
                dump("{$rawId}：开始执行");
                DB::startTrans();
                try {
                    $this->syncGameRaw($rawId, $platformId);
                    DB::commit();
                    DB::table(Table::GAME_RAW)->where('id', '=', $rawId)
                        ->update([
                            'sync_run_status' => 1,
                        ]);
                    dump("{$rawId}：执行成功");
                } catch (\Exception $e) {
                    DB::rollback();
                    dump("{$rawId}：执行失败");
                    dump($e);
                    DB::table(Table::GAME_RAW)->where('id', '=', $rawId)
                        ->inc('sync_error_count', 1)
                        ->update([
                            'sync_run_status' => 4,
                        ]);
                }
            }
        }
    }

    public function syncGameRaw($rawId, $platformId): void
    {
        $ret = DB::table(Table::GAME_RAW)
            ->field([
                'id',
                'detail',
            ])
            ->where('platform_id', '=', $platformId)
            ->where('id', '=', $rawId)
            ->findOrEmpty();
        if (!empty($ret)) {
            $gameInfo = $ret['detail'] ? unserialize($ret['detail']) : [];
            if (empty($gameInfo)) {
                return;
            }
            if (empty($gameInfo['steam_appid'])) {
                return;
            }
            if (empty($gameInfo['type']) || $gameInfo['type'] != 'game') {
                return;
            }

            $gameService = new GameService();

            // 保存游戏数据
            $gameInput = new GameInput();
            $gameInput->platform_id = $platformId;
            $gameInput->external_id = $gameInfo['steam_appid'];
            $gameInput->title = $gameInfo['name'] ?? '';
            $gameInput->capsule_image = ($gameInfo['capsule_image']) ?? ($gameInfo['capsule_imagev5'] ?? '');
            $gameInput->description = $gameInfo['detailed_description'] ?? '';
            $gameInput->short_description = $gameInfo['short_description'] ?? '';
            $gameInput->website_url = $gameInfo['website'] ?? '';
            if (isset($gameInfo['release_date']['coming_soon'])) {
                if ($gameInfo['release_date']['coming_soon']) {
                    $gameInput->coming_soon = 2;
                } else {
                    $gameInput->coming_soon = 1;
                    $releaseDate = $gameInfo['release_date']['date'];
                    $gameInput->release_date = $gameService->transReleaseDate($releaseDate) ?: null;
                }
            }
            if (isset($gameInfo['is_free'])) {
                $gameInput->is_free = $gameInfo['is_free'] ? 1 : 2;
            }
            if (isset($gameInfo['required_age']) && intval($gameInfo['required_age']) > 0) {
                $gameInput->age_rating = intval($gameInfo['required_age']);
            } else {
                if (!empty($gameInfo['ratings'])) {
                    $indexRating = 0;
                    foreach ($gameInfo['ratings'] as $rating) {
                        if (isset($rating['rating']) && intval($rating['rating']) > 0) {
                            $indexRating = max(intval($rating['rating']), $indexRating);
                        }
                    }
                    $gameInput->age_rating = $indexRating;
                }
            }
            if (!empty($gameInfo['platforms'])) {
                if (isset($gameInfo['platforms']['windows'])) {
                    $gameInput->os_windows = $gameInfo['platforms']['windows'] ? 1 : 2;
                }
                if (isset($gameInfo['platforms']['mac'])) {
                    $gameInput->os_mac = $gameInfo['platforms']['mac'] ? 1 : 2;
                }
                if (isset($gameInfo['platforms']['linux'])) {
                    $gameInput->os_linux = $gameInfo['platforms']['linux'] ? 1 : 2;
                }
            }

            $gameId = 0;
            $gameId = $gameService->safeInsertGetId($gameInput);

            // 媒体资源
            $media = [];
            if (!empty($gameInfo['header_image'])) {
                $media[] = [
                    'game_id' => $gameId,
                    'media_type' => MediaTypeEnum::IMAGE->value,
                    'media_label' => 'header_image',
                    'media_uuid' => $gameService->parseImageMediaUuid($gameInfo['header_image']),
                    'media_thumbnail' => $gameInfo['header_image'],
                    'media_url' => $gameInfo['header_image'],
                    'description' => 'header_image',
                    'sort_order' => 0,
                ];
            }
            if (!empty($gameInfo['capsule_image'])) {
                $media[] = [
                    'game_id' => $gameId,
                    'media_type' => MediaTypeEnum::IMAGE->value,
                    'media_label' => 'capsule_image',
                    'media_uuid' => $gameService->parseImageMediaUuid($gameInfo['capsule_image']),
                    'media_thumbnail' => $gameInfo['capsule_imagev5'] ?? $gameInfo['capsule_image'],
                    'media_url' => $gameInfo['capsule_image'],
                    'description' => 'header_image',
                    'sort_order' => 0,
                ];
            }
            if (!empty($gameInfo['screenshots'])) {
                foreach ($gameInfo['screenshots'] as $k => $screenshot) {
                    if (!empty($screenshot['path_full'])) {
                        $media[] = [
                            'game_id' => $gameId,
                            'media_type' => MediaTypeEnum::IMAGE->value,
                            'media_label' => 'screenshots',
                            'media_uuid' => $gameService->parseImageMediaUuid($screenshot['path_full']),
                            'media_thumbnail' => $gameInfo['path_thumbnail'] ?? $screenshot['path_full'],
                            'media_url' => $screenshot['path_full'],
                            'description' => 'screenshots',
                            'sort_order' => $k,
                        ];
                    }
                }
            }
            if (!empty($gameInfo['movies'])) {
                foreach ($gameInfo['movies'] as $k => $movie) {
                    $movieId = (string)$movie['id'];
                    $movieUrl = $movie['webm'] ?? ($movie['mp4'] ?? []);
                    if (!empty($movieUrl) && (!empty($movieUrl['480']) || !empty($movieUrl['max']))) {
                        $movieUrlFinal = $movieUrl['max'] ?? $movieUrl['480'];
                        $media[] = [
                            'game_id' => $gameId,
                            'media_type' => MediaTypeEnum::VIDEO->value,
                            'media_label' => 'movies',
                            'media_uuid' => $movieId,
                            'media_thumbnail' => $movie['thumbnail'] ?? '',
                            'media_url' => $movieUrlFinal,
                            'description' => 'movies',
                            'sort_order' => $k,
                        ];
                    }
                }
            }
            foreach ($media as $v) {
                $gameService->safeInsertMediaGetId($v);
            }
            // 系统配置
            if ($gameInput->os_windows == 1 && !empty($gameInfo['pc_requirements'])) {
                if (!empty($gameInfo['pc_requirements']['minimum'])) {
                    $priceData = [
                        'game_id' => $gameId,
                        'os' => 'windows',
                        'requirement_type' => 'minimum',
                        'details' => $gameInfo['pc_requirements']['minimum'],
                    ];
                    $gameService->safeInsertOsRequirementGetId($priceData);
                }
                if (!empty($gameInfo['pc_requirements']['recommended'])) {
                    $priceData = [
                        'game_id' => $gameId,
                        'os' => 'windows',
                        'requirement_type' => 'recommended',
                        'details' => $gameInfo['pc_requirements']['recommended'],
                    ];
                    $gameService->safeInsertOsRequirementGetId($priceData);
                }
            }
            if ($gameInput->os_mac == 1 && !empty($gameInfo['mac_requirements'])) {
                if (!empty($gameInfo['mac_requirements']['minimum'])) {
                    $priceData = [
                        'game_id' => $gameId,
                        'os' => 'mac',
                        'requirement_type' => 'minimum',
                        'details' => $gameInfo['mac_requirements']['minimum'],
                    ];
                    $gameService->safeInsertOsRequirementGetId($priceData);
                }
                if (!empty($gameInfo['mac_requirements']['recommended'])) {
                    $priceData = [
                        'game_id' => $gameId,
                        'os' => 'mac',
                        'requirement_type' => 'recommended',
                        'details' => $gameInfo['mac_requirements']['recommended'],
                    ];
                    $gameService->safeInsertOsRequirementGetId($priceData);
                }
            }
            if ($gameInput->os_linux == 1 && !empty($gameInfo['linux_requirements'])) {
                if (!empty($gameInfo['linux_requirements']['minimum'])) {
                    $priceData = [
                        'game_id' => $gameId,
                        'os' => 'linux',
                        'requirement_type' => 'minimum',
                        'details' => $gameInfo['linux_requirements']['minimum'],
                    ];
                    $gameService->safeInsertOsRequirementGetId($priceData);
                }
                if (!empty($gameInfo['linux_requirements']['recommended'])) {
                    $priceData = [
                        'game_id' => $gameId,
                        'os' => 'linux',
                        'requirement_type' => 'recommended',
                        'details' => $gameInfo['linux_requirements']['recommended'],
                    ];
                    $gameService->safeInsertOsRequirementGetId($priceData);
                }
            }

            // 价格
            if (!empty($gameInfo['price_overview'])) {
                if (!empty($gameInfo['price_overview']['final']) && !empty($gameInfo['price_overview']['currency'])) {
                    $priceData = [
                        'game_id' => $gameId,
                        'price_currency' => $gameInfo['price_overview']['currency'],
                        'price_symbol' => $gameInfo['price_overview']['final_formatted'] ? explode(' ', $gameInfo['price_overview']['final_formatted'])[0] : '',
                        'price_initial' => $gameInfo['price_overview']['initial'],
                        'price_final' => $gameInfo['price_overview']['final'],
                        'discount' => $gameInfo['price_overview']['discount_percent'],
                        'valid_begin_time' => null,
                        'valid_end_time' => null,
                    ];
                    $gameService->safeInsertPriceGetId($priceData);
                }
            }
            // 分类
            $genres = $gameInfo['genres'] ?? [];
            if (!empty($genres)) {
                $cateService = new CategoryService();
                $cateIds = [];
                foreach ($genres as $genre) {
                    $genreId = $genre['id'];
                    $genreName = $genre['description'];
                    $cateIds[] = $cateService->safeInsertGetId($genreId, $genreName, $platformId);
                }
                foreach ($cateIds as $cateId) {
                    $cateService->bindGame($cateId, $gameId);
                }
            }

        }
    }
}
