<?php

namespace Goldfinch\Taz\Console\Commands;

use SilverStripe\View\SSViewer;
use Goldfinch\Taz\Services\InputOutput;
use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'app:theme')]
class CurrentThemeCommand extends GeneratorCommand
{
    protected static $defaultName = 'app:theme';

    protected $description = 'Display current theme';

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
        $io->text($currentTheme);

        return Command::SUCCESS;
    }
}
