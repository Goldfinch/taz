<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:page-template')]
class PageTemplateMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:page-template';

    protected $description = 'Create page template';

    protected $path = 'themes/[theme]/templates/[namespace_root]/Pages/Layout';

    protected $type = 'page template';

    protected $stub = 'page-template.stub';

    protected $extension = '.ss';
}
