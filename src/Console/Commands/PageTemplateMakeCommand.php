<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;

#[AsCommand(name: 'make:page-template')]
class PageTemplateMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:page-template';

    protected $description = 'Create a new page template';

    protected $path = 'themes/main/templates/App/Pages/Layout';

    protected $type = 'page template';

    protected $stub = 'page-template.stub';

    protected $prefix = '';

    protected $extension = '.ss';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
