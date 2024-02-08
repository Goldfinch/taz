<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:model')]
class ModelMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:model';

    protected $description = 'Create model [DataObject]';

    protected $path = '[psr4]/Models';

    protected $type = 'model';

    protected $stub = 'model.stub';

    protected function configure(): void
    {
        parent::configure();

        $this->addOption(
            'plain',
            null,
            InputOption::VALUE_NONE,
            'Plane model template'
        );

        $this->addOption(
            'fielder',
            null,
            InputOption::VALUE_NONE,
            'Fielder model template'
        );
    }

    protected function execute($input, $output): int
    {
        if ($input->getOption('fielder') !== false) {
            $this->stub = 'model-fielder.stub';
        } else if ($input->getOption('plain') !== false) {
            $this->stub = 'model-plain.stub';
        }

        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
