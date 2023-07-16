<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'make:crontask')]
class CronTaskMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:crontask';

    protected $description = 'Create a cron task class';

    protected $path = 'app/src/Tasks';

    protected $type = 'cron task';

    protected $stub = 'crontask.stub';

    protected $prefix = 'CronTask';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
