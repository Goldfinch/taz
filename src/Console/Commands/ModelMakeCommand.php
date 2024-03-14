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

    protected $stubTemplates = [
        'model.stub' => 'full',
        'model-plain.stub' => 'plain',
        'model-fielder.stub' => ['full-fielder', 'full (fielder)', 'goldfinch/fielder'],
        'model-plain-fielder.stub' => ['plain-fielder', 'plain (fielder)', 'goldfinch/fielder'],
    ];

    protected function configure(): void
    {
        parent::configure();

        $this->addOption(
            'template',
            null,
            InputOption::VALUE_REQUIRED,
            'Specify template'
        );
    }

    protected function execute($input, $output): int
    {
        $this->chooseStubTemplate($input, $output);

        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
