<?php

declare(strict_types=1);

namespace Flame\DevTools\Commands;

use Flame\DevTools\SchemaTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenEntityCommand extends Command
{
    use SchemaTrait;

    private array $ignoreTables = ['migrations'];

    protected function configure(): void
    {
        $this->setName('gen:entity')
            ->setDescription('Generate entity class');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $tables = $this->getTables();
        foreach ($tables as $row) {
            $tableName = implode('', $row);
            if (in_array($tableName, $this->ignoreTables)) {
                continue;
            }
            $className = parse_name($tableName, 1);
            $columns = $this->getTableInfo($tableName);

            $this->entityTpl($className, $columns);
        }

        return 1;
    }

    private function entityTpl($className, $columns): void
    {
        $fields = "\n";
        foreach ($columns as $column) {
            if ($column['Field'] === 'default') {
                $column['Field'] = 'isDefault';
            }
            if ($column['Field'] === 'id' && empty($column['Comment'])) {
                $column['Comment'] = 'ID';
            }
            $fields .= "    #[OA\Property(property: '{$column['Field']}', description: '{$column['Comment']}', type: '{$column['SwaggerType']}')]\n";
            $fields .= '    private '.$column['BaseType'].' $'.$column['Field'].";\n\n";
        }

        foreach ($columns as $column) {
            $fields .= $this->getSet($column['Field'], $column['BaseType'])."\n\n";
        }

        $fields = rtrim($fields, "\n");

        $content = file_get_contents(__DIR__.'/stubs/entity/entity.stub');
        $content = str_replace([
            '{$className}',
            '{$fields}',
        ], [
            $className,
            $fields,
        ], $content);

        file_put_contents(app_path('entity/'.$className.'Entity.php'), $content);
    }
}
