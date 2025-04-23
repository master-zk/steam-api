<?php

namespace app\bundles\game\scheduler;

use app\bundles\game\jobs\GetSteamGameInfoJob;
use Flame\Console\Contracts\ScheduleTaskInterface;

class GetSteamGameInfoTask implements ScheduleTaskInterface
{

    public function cron(): ?string
    {
        return '0 * 2 * * *';
    }

    public function handle()
    {
        $iob = new GetSteamGameInfoJob();
        $pageSize = 50;

        for ($i = 1; $i < 20; $i++) {
            $iob->handle($i * $pageSize, $pageSize);
        }
    }
}