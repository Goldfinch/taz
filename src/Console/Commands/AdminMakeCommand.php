<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:admin')]
class AdminMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:admin';

    protected $description = 'Create admin model [ModelAdmin]';

    protected $path = '[psr4]/Admin';

    protected $type = 'admin';

    protected $stub = 'admin.stub';

    protected $stubTemplates = [
        'admin.stub' => 'full',
        'admin-plain.stub' => 'plain',
    ];

    protected $suffix = 'Admin';

    protected function configure(): void
    {
        parent::configure();

        $this->addOption(
            'template',
            null,
            InputOption::VALUE_REQUIRED,
            'Specify template'
        );
    }

    protected function execute($input, $output): int
    {
        $template = $this->chooseStubTemplate($input, $output);

        if ($template == 'plain') {

            $url_default = $this->callInnerReplace('{{ class_kebab }}', $this->getAttrName($input));
            $title_default = $this->callInnerReplace('{{ class_singular }}', $this->getAttrName($input));
            $icon_default = 'font-icon-database';
            $priority_default = -0.5;
            $models_default = '';

            $this->questions['url'] = $this->askStringQuestion('$url_segment:', $input, $output, $url_default);
            $this->questions['title'] = $this->askStringQuestion('$menu_title:', $input, $output, $title_default);
            $this->questions['icon'] = $this->askStringQuestion('$menu_icon_class:', $input, $output, $icon_default);
            $this->questions['priority'] = $this->askStringQuestion('$menu_priority:', $input, $output, $priority_default);
            $this->questions['models'] = $this->askStringQuestion('$managed_models: (eg: App\Models\Fruit,App\Models\Worker:The Workers Title:workersurl,Page:Pages', $input, $output, $models_default);
        }

        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    protected function replacer()
    {
        $questions = $this->questions;

        if ($questions && is_array($questions) && ! empty($questions)) {

            $url = $questions['url'];
            $title = $questions['title'];
            $icon = $questions['icon'];
            $priority = $questions['priority'];
            $models = $questions['models'];

            if ($models) {
                $modesl_namespace_str = '';
                $models_array = [];

                foreach (explode(',', $models) as $model) {

                    if (strpos($model, ':') !== false) {
                        $mex = explode(':', $model);
                        $mexCount = count($mex);

                        if ($mexCount > 1) {

                            if ($mexCount == 2) {
                                $models_array[$mex[0].'::class'] = [
                                    'title' => $mex[1],
                                ];
                            } elseif ($mexCount == 3) {
                                $models_array[$mex[2]] = [
                                    'dataClass' => $mex[0].'::class',
                                    'title' => $mex[1],
                                ];
                            }
                            $modesl_namespace_str .= PHP_EOL.'use '.$mex[0].';';
                        }
                    } else {
                        $models_array[] = $model.'::class';
                        $modesl_namespace_str .= PHP_EOL.'use '.$model.';';
                    }
                }

                $modesl_str = '[';

                foreach ($models_array as $k => $ma) {

                    if (is_string($k)) {
                        if (strpos($k, '::class') != false) {
                            $st = $k;
                        } else {
                            $st = '\''.$k.'\'';
                        }
                        $modesl_str .= PHP_EOL.'        '.$st.' => ';
                    } elseif (is_string($ma)) {
                        if (strpos($ma, '\\') !== false) {
                            $x = explode('\\', $ma);
                            $ma = $x ? end($x) : $x;
                        }
                        $modesl_str .= PHP_EOL.'        '.$ma.',';
                    }

                    if (is_array($ma)) {
                        $modesl_str .= '[';

                        $el = '';

                        foreach ($ma as $ki => $mai) {

                            if ($ki == 'title') {
                                $maiMod = '\''.$mai.'\'';
                            } elseif ($ki == 'dataClass') {

                                if (strpos($mai, '\\') !== false) {
                                    $x = explode('\\', $mai);
                                    $mai = $x ? end($x) : $x;
                                }

                                $maiMod = $mai;
                            }

                            $modesl_str .= PHP_EOL.'            \''.$ki.'\''.' => '.$maiMod.',';
                        }
                        $modesl_str .= PHP_EOL.'        ],';
                    }
                }

                $modesl_str .= PHP_EOL.'    ]';

            } else {
                $modesl_str = '[]';
                $modesl_namespace_str = '';
            }

            return [
                [$url, '{{ __url }}', $url],
                [$title, '{{ __title }}', $title],
                [$icon, '{{ __icon }}', $icon],
                [$priority, '{{ __priority }}', $priority],
                [true, '{{ __models }}', $modesl_str],
                [$modesl_namespace_str, '{{ __modesl_namespace_str }}', $modesl_namespace_str],
            ];
        }
    }
}
