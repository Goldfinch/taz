<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:element')]
class ElementMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:element';

    protected $description = 'Create element [BaseElement]';

    protected $path = '[psr4]/Elements';

    protected $type = 'element';

    protected $stub = 'element.stub';

    protected $suffix = 'Element';

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
            $this->stub = 'element-fielder.stub';
        } else if ($input->getOption('plain') !== false) {
            $this->stub = 'element-plain.stub';
        }

        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        $className = $this->askClassNameQuestion('What [class name] this element need to be assigned to? (eg: Page, App/Pages/Page)', $input, $output);

        $nameInput = $this->getAttrName($input);

        // create page template
        $command = $this->getApplication()->find('make:element-template');
        $command->run(new ArrayInput(['name' => $nameInput]), $output);

        // find config
        $config = $this->findYamlConfigFileByName('app-elements');

        // create new config if not exists
        if (!$config) {

            $command = $this->getApplication()->find('make:config');
            $command->run(new ArrayInput([
                'name' => 'elements',
                '--plain' => true,
                '--after' => 'dnadesign/silverstripe-elemental',
                '--nameprefix' => 'app-',
            ]), $output);

            $config = $this->findYamlConfigFileByName('app-elements');
        }

        // update config
        $this->updateYamlConfig(
            $config,
            $className . '.allowed_elements',
            $this->getNamespaceClass($input),
        );

        return Command::SUCCESS;
    }
}
