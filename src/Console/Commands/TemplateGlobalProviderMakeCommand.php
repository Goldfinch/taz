<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'make:provider')]
class TemplateGlobalProviderMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:provider';

    protected $description = 'Create template global provider';

    protected $path = 'app/src/Providers';

    protected $type = 'provider';

    protected $stub = 'template-global-provider.stub';

    protected $prefix = 'TemplateProvider';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
