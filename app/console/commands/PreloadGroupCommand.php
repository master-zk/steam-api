<?php

declare(strict_types=1);

namespace app\console\commands;

use app\bundles\manage\jobs\PreloadGroupJob;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PreloadGroupCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('preload-group')
            ->setDescription('The preload group command.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        (new PreloadGroupJob)->setPageSize(30)->handle();

        return 0;
    }
}
