<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;

#[AsCommand(name: 'make:page')]
class PageMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:page';

    protected $description = 'Create a new page class';

    protected $path = 'app/src/Pages';

    protected $type = 'page';

    protected $stub = 'page.stub';

    protected $prefix = '';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        $nameInput = $this->getAttrName($input);

        // Create page controller

        $command = $this->getApplication()->find('make:page-controller');

        $arguments = [
            'name'    => $nameInput,
        ];

        $greetInput = new ArrayInput($arguments);
        $returnCode = $command->run($greetInput, $output);

        // Create page template

        $command = $this->getApplication()->find('make:page-template');

        $arguments = [
            'name'    => $nameInput,
        ];

        $greetInput = new ArrayInput($arguments);
        $returnCode = $command->run($greetInput, $output);

        return Command::SUCCESS;
    }
}
