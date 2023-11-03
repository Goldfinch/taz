<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;

#[AsCommand(name: 'make:block-template')]
class BlockTemplateMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:block-template';

    protected $description = 'Create a new block template';

    protected $path = 'themes/[theme]/templates/[namespace_root]/Blocks';

    protected $type = 'block template';

    protected $stub = 'block-template.stub';

    protected $prefix = 'Block';

    protected $extension = '.ss';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
