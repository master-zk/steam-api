<?php

declare(strict_types=1);

namespace app\console\commands;

use app\bundles\manage\jobs\SyncCallInLogJob;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncCallLogCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('sync-call-log')
            ->setDescription('The sync-call-log command.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $i = 0;
        while ($i < 1000) {
            (new SyncCallInLogJob)->setPageSize(100)->handle(); // 同步通话记录数据
            sleep(10);
            $i++;
        }

        return 0;
    }
}
