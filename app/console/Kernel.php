<?php

declare(strict_types=1);

namespace app\console;

use Flame\Console\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    public function __construct()
    {
        parent::__construct();

        $commands = array_merge(
            glob(__DIR__.'/commands/*Command.php'),
            glob(app_path('bundles/*/commands/*Command.php'))
        );

        parent::registerCommands($commands);
    }
}
