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

    protected $stubTemplates = [
        'config.stub' => 'full',
        'config-plain.stub' => 'plain',
    ];

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
            'before',
            null,
            InputOption::VALUE_REQUIRED,
            'Set yaml parameter Before'
        );

        $this->addOption(
            'nameprefix',
            null,
            InputOption::VALUE_REQUIRED,
            'Set name suffix to Yaml config name'
        );

        $this->addOption(
            'template',
            null,
            InputOption::VALUE_REQUIRED,
            'Specify template'
        );
    }

    protected function execute($input, $output): int
    {
        $stubOption = $input->getOption('plain');

        if ($stubOption !== false) {
            $this->stub = 'config-plain.stub';
        } else {
            $this->chooseStubTemplate($input, $output);
        }

        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    protected function replacer()
    {
        $after = $this->input->getOption('after');
        $before = $this->input->getOption('before');
        $nameprefix = $this->input->getOption('nameprefix');

        return [
            [$after, '{{ yaml_after }}', 'After: "' . $after . '"'],
            [$before, '{{ yaml_before }}', 'Before: "' . $before . '"'],
            [$nameprefix, '{{ yaml_nameprefix }}', $nameprefix],
        ];
    }

    protected function customReplace(&$stub, $name): self
    {
        $replace = parent::customReplace($stub, $name);

        $stub = str_replace(["\n\n\n\n", "\n\n\n", "\n\n"], ["\n", "\n", "\n"], $stub);

        return $this;
    }
}
