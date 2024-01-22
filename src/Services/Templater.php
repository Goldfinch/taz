<?php

namespace Goldfinch\Taz\Services;

use Symfony\Component\Finder\Finder;
use Goldfinch\Taz\Services\InputOutput;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\ChoiceQuestion;

class Templater
{
    protected static $io;
    protected static $input;
    protected static $output;
    protected static $command;
    protected static $componentName;

    public static function defineTheme()
    {
        $themes = Finder::create()
            ->in(THEMES_PATH)
            ->depth(0)
            ->directories();

        $ssTheme = null;

        if (!$themes || !$themes->count()) {
            self::$io->wrong('There are no [themes] in your project for this action');

            return Command::FAILURE;
        } elseif ($themes->count() > 1) {
            // choose theme

            $availableThemes = [];

            foreach ($themes as $theme) {
                $availableThemes[] = $theme->getFilename();
            }

            $helper = self::$command->getHelper('question');
            $question = new ChoiceQuestion(
                'Which templete?',
                $availableThemes,
                0,
            );
            $question->setErrorMessage('Theme %s is invalid.');
            $theme = $helper->ask(self::$input, self::$output, $question);
        } else {
            foreach ($themes as $themeItem) {
                $theme = $themeItem->getFilename();
            }
        }

        if (isset($theme) && $theme) {
            return $theme;
        } else {
            self::$io->wrong('The ['.self::$componentName.'] templates creation failed');
            return Command::FAILURE;
        }
    }

    public function __construct($input, $output, $command, $componentName)
    {
        self::$io = new InputOutput($input, $output);
        self::$input = $input;
        self::$output = $output;
        self::$command = $command;
        self::$componentName = $componentName;
    }

    public static function create($input, $output, $command, $componentName)
    {
        return new static($input, $output, $command, $componentName);
    }

    public static function copyFiles($files)
    {
        $fs = new Filesystem();

        $anyCreated = 0;

        foreach ($files as $k => $file) {
            if ($fs->exists($file['to'])) {
                $files[$k]['text'] = 'already exists';
                $files[$k]['state'] = '🔴';
            } else {
                $fs->copy($file['from'], $file['to']);
                $files[$k]['text'] = 'created';
                $files[$k]['state'] = '🟢';
                $anyCreated++;
            }
            unset($files[$k]['from']);
        }

        if ($anyCreated) {
            self::$io->right('The ['.self::$componentName.'] templates have been created');
            $return = Command::SUCCESS;
        } else {
            self::$io->wrong('The ['.self::$componentName.'] templates are already exist');
            $return = Command::FAILURE;
        }

        $table = new Table(self::$output);
        $table->setRows($files);
        $table->render();

        return $return;
    }
}
