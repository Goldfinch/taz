<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:config')]
class ConfigMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:config';

    protected $description = 'Create YML config';

    protected $path = 'app/_config';

    protected $type = 'config';

    protected $stub = 'config.stub';

    protected $extension = '.yml';

    protected function configure(): void
    {
        parent::configure();

        $this->addOption(
            'plain',
            null,
            InputOption::VALUE_NONE,
            'Use clean config template with no placeholder attributes'
        );

        $this->addOption(
            'after',
            null,
            InputOption::VALUE_REQUIRED,
            'Set yaml parameter After'
        );

        $this->addOption(
            'namesuffix',
            null,
            InputOption::VALUE_REQUIRED,
            'Set name suffix to Yaml config name'
        );
    }

    protected function execute($input, $output): int
    {
        $stubOption = $input->getOption('plain');

        if ($stubOption !== false) {
            $this->stub = 'config-plain.stub';
        }

        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    protected function replacer()
    {
        $after = $this->input->getOption('after');
        $namesuffix = $this->input->getOption('namesuffix');

        return [
            [$after, '{{ yaml_after }}', 'After: "' . $after . '"'],
            [$namesuffix, '{{ yaml_namesuffix }}', $namesuffix],
        ];
    }
}
