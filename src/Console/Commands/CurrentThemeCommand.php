<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Goldfinch\Taz\Services\InputOutput;
use SilverStripe\View\SSViewer;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'display:theme')]
class CurrentThemeCommand extends GeneratorCommand
{
    protected static $defaultName = 'display:theme';

    protected $description = 'Display current theme';

    protected $no_arguments = true;

    protected function execute($input, $output): int
    {
        $themes = SSViewer::get_themes();
        $currentTheme = '';

        if ($themes && count($themes)) {
            foreach ($themes as $theme) {
                if ($theme[0] != '$') {
                    $currentTheme = $theme;
                }
            }
        }

        $io = new InputOutput($input, $output);
        $io->display($currentTheme);

        return Command::SUCCESS;
    }
}
