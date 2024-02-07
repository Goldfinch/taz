<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:crontask')]
class CronTaskMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:crontask';

    protected $description = 'Create cron task [CronTask]';

    protected $path = '[psr4]/Tasks';

    protected $type = 'cron task';

    protected $stub = 'crontask.stub';

    protected $suffix = 'CronTask';
}
