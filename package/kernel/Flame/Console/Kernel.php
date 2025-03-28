<?php

declare(strict_types=1);

namespace Flame\Console;

use Flame\Config\Config;
use Flame\Support\Facade\DB;
use Phinx\Console\Command;
use Symfony\Component\Console\Application;

class Kernel extends Application
{
    /**
     * Initialize the console application.
     */
    public function __construct()
    {
        parent::__construct('Console Tool.', '1.0');

        Config::init();

        DB::setConfig(Config::get('database'));

        $this->addCommands([
            new Command\Create,
            new Command\Migrate,
            new Command\Rollback,
            new Command\Status,
            new Command\SeedCreate,
            new Command\SeedRun,
        ]);

        // Load commands
        $commands = glob(dirname(__DIR__).'/*/Commands/*Command.php');
        $this->registerCommands($commands);
    }

    public function registerCommands(array $files): void
    {
        $pattern1 = '/\/(\w+\/\w+\/\w+\/\w+Command)\.php/';
        $pattern2 = '/\/(\w+\/\w+\/\w+\/\w+\/\w+Command)\.php/';
        foreach ($files as $file) {
            if (str_contains($file, 'bundles')) {
                $this->registerCommand($pattern2, $file);
            } else {
                $this->registerCommand($pattern1, $file);
            }
        }
    }

    private function registerCommand(string $pattern, string $file): void
    {
        preg_match($pattern, str_replace('\\', '/', $file), $matches);
        if (isset($matches[1])) {
            $command = str_replace('/', '\\', $matches[1]);
            $this->add(new $command);
        }
    }
}
