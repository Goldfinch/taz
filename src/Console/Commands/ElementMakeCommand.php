<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;

#[AsCommand(name: 'make:element')]
class ElementMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:element';

    protected $description = 'Create element [BaseElement]';

    protected $path = '[psr4]/Elements';

    protected $type = 'element';

    protected $stub = 'element.stub';

    protected $prefix = 'Element';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        $nameInput = $this->getAttrName($input);

        // Create page template

        $command = $this->getApplication()->find('make:element-template');

        $arguments = [
            'name' => $nameInput,
        ];

        $greetInput = new ArrayInput($arguments);
        $returnCode = $command->run($greetInput, $output);

        // Register element

        $rootDir = $this->getNamespaceRootDir();

        $newContent = $this->addToLine(
            'app/_config/elements.yml',
            'allowed_elements:',
            '    - ' . $rootDir . '\Elements\\' . $nameInput . 'Element',
        );

        file_put_contents('app/_config/elements.yml', $newContent);

        return Command::SUCCESS;
    }
}
