<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;

#[AsCommand(name: 'make:page')]
class PageMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:page';

    protected $description = 'Create page';

    protected $path = '[psr4]/Pages';

    protected $type = 'page';

    protected $stub = 'page.stub';

    protected function execute($input, $output): int
    {
        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        $nameInput = $this->getAttrName($input);

        // Create page controller
        $command = $this->getApplication()->find('make:page-controller');
        $command->run(new ArrayInput(['name' => $nameInput]), $output);

        // Create page template
        $command = $this->getApplication()->find('make:page-template');
        $command->run(new ArrayInput(['name' => $nameInput]), $output);

        return Command::SUCCESS;
    }
}
