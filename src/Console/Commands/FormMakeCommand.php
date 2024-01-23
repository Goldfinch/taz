<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'make:form')]
class FormMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:form';

    protected $description = 'Create form [Form]';

    protected $path = '[psr4]/Forms';

    protected $type = 'form';

    protected $stub = 'form.stub';

    protected $prefix = '';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
