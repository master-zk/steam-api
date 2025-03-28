<?php

declare(strict_types=1);

namespace app\console\commands;

use app\bundles\manage\enums\CallLogStatRelationTypeEnum;
use app\bundles\manage\enums\CallLogStatTimeTypeEnum;
use app\bundles\manage\jobs\GenerateCallLogStatJob;
use app\bundles\manage\jobs\PreloadGroupJob;
use app\bundles\manage\jobs\RunExportTaskJob;
use app\bundles\manage\jobs\SyncCallInLogJob;
use app\bundles\manage\jobs\SyncCallOutLogJob;
use app\bundles\manage\service\employee\CallLogService;
use app\scheduler\GenerateCurrentCallLogStatTask;
use app\scheduler\GenerateHistoryCallLogStatTask;
use app\scheduler\GenerateUserStatusStatTask;
use app\support\AliTextToAudioService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
        echo 'hello world'.PHP_EOL;
        $beginMic = microtime(true);

        //$this->testSyncCallLog();
        //$this->testCallLogStat();
        $this->testCallLogCurrentStat();
        //$this->testExportTask();
        //$this->testGenerateUserStatusStat();
        //$this->testPreloadGroup();

        $endMic = microtime(true);
        dump($beginMic, $endMic, $endMic - $beginMic);

        return 0;
    }

    protected function generateAudio(): void
    {
        $service = new AliTextToAudioService;
        foreach ($service->getTextArr() as $item) {
            $service->handle($item['content'], $item['title']);
        }
    }

    public function testCallLogStat(): void
    {
        $times = [];
        $now = time();
        for ($i = 1; $i < 2; $i++) {
            $datetime = date('Y-m-d 00:00:00', $now + 86400 * $i);
            for ($j = 0; $j < 1; $j++) {
                $indexTime = strtotime($datetime) + ($j + 1) * 3600;
                $indexVal = [
                    'timestamp' => $indexTime,
                    'timeType' => [
                        //CallLogStatTimeTypeEnum::Hour->value,
                    ],
                ];
                if ($j == 0) {
                    $indexVal['timeType'][] = CallLogStatTimeTypeEnum::Day->value;
                }
                $times[] = $indexVal;
            }
        }

        $callLogService = new CallLogService;
        $rules = $callLogService->getCallLogStatRules();
        foreach ($times as $v) {
            $time = $v['timestamp'];
            $timeTypes = $v['timeType'];
            foreach ($rules as $timeType => $callTypes) {
                if (! in_array($timeType, $timeTypes)) {
                    continue;
                }
                foreach ($callTypes as $callType => $relationTypes) {
                    foreach ($relationTypes as $relationType) {
                        /*if (!in_array($relationType, [CallLogStatRelationTypeEnum::Ivr->value, CallLogStatRelationTypeEnum::IvrItem->value])) {
                            continue;
                        }*/
                        @[$beginTime, $endTime] = $callLogService->generateCallLogStatTimeRange($timeType, $time);
                        dump("GenerateCallLogStatJob $callType, $relationType, $timeType, $beginTime, $endTime");
                        $job = new GenerateCallLogStatJob($callType, $timeType, $beginTime, $endTime, $relationType);
                        $job->handle();
                        unset($job);
                    }
                }
            }
        }
    }

    public function testCallLogCurrentStat(): void
    {
        (new GenerateCurrentCallLogStatTask)->handle();
        (new GenerateHistoryCallLogStatTask)->handle();
    }

    public function testExportTask(): void
    {
        (new RunExportTaskJob)->handle();
    }

    public function testGenerateUserStatusStat(): void
    {
        $task = new GenerateUserStatusStatTask;
        for ($i = -10; $i < 0; $i++) {
            $time = time() + $i * 86400;
            $task->handle($time);
        }
    }

    public function testSyncCallLog(): void
    {
        /*$task = new SyncCallInLogJob();
        $task->setPageSize(100)->handle();*/
        $task = new SyncCallOutLogJob();
        $task->setPageSize(100)->handle();
    }

    public function testPreloadGroup(): void
    {
        $task = new PreloadGroupJob;
        $task->getPondIncrId();
    }
}
