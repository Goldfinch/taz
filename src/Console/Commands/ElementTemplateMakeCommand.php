<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:element-template')]
class ElementTemplateMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:element-template';

    protected $description = 'Create element template';

    protected $path = 'themes/[theme]/templates/[namespace_root]/Elements';

    protected $type = 'element template';

    protected $stub = 'element-template.stub';

    protected $prefix = 'Element';

    protected $extension = '.ss';
}
