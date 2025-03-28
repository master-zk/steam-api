<?php

declare(strict_types=1);

namespace Flame\DevTools\Commands;

use Flame\DevTools\SchemaTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenServiceCommand extends Command
{
    use SchemaTrait;

    private array $ignoreTables = ['migrations'];

    protected function configure(): void
    {
        $this->setName('gen:service')
            ->setDescription('Generate service class');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->ensureDirectoryExists([
            app_path('service'),
        ]);

        $tables = $this->getTables();
        foreach ($tables as $row) {
            $tableName = implode('', $row);

            if (in_array($tableName, $this->ignoreTables)) {
                continue;
            }

            $className = parse_name($tableName, 1);

            $this->serviceTpl($className);
        }

        return 1;
    }

    private function serviceTpl(string $name): void
    {
        $content = file_get_contents(__DIR__.'/stubs/service/service.stub');
        $content = str_replace([
            '{$name}',
        ], [
            $name,
        ], $content);

        $serviceFile = app_path('service/'.$name.'Service.php');
        if (! file_exists($serviceFile)) {
            file_put_contents($serviceFile, $content);
        }
    }
}
