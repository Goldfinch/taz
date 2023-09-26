<?php

namespace Goldfinch\Taz\Console;

// use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;
use Goldfinch\Taz\Services\InputOutput;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class GeneratorCommand extends Command
{
    protected $files;

    // protected $name = 'make:model';

    protected $appRoot;

    protected $stub;

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $path;

    protected $type;

    protected $prefix;

    protected $extension = '.php';

    /**
     * Reserved names that cannot be used for generation.
     *
     * @var string[]
     */
    protected $reservedNames = [
        '__halt_compiler',
        'abstract',
        'and',
        'array',
        'as',
        'break',
        'callable',
        'case',
        'catch',
        'class',
        'clone',
        'const',
        'continue',
        'declare',
        'default',
        'die',
        'do',
        'echo',
        'else',
        'elseif',
        'empty',
        'enddeclare',
        'endfor',
        'endforeach',
        'endif',
        'endswitch',
        'endwhile',
        'enum',
        'eval',
        'exit',
        'extends',
        'false',
        'final',
        'finally',
        'fn',
        'for',
        'foreach',
        'function',
        'global',
        'goto',
        'if',
        'implements',
        'include',
        'include_once',
        'instanceof',
        'insteadof',
        'interface',
        'isset',
        'list',
        'match',
        'namespace',
        'new',
        'or',
        'print',
        'private',
        'protected',
        'public',
        'readonly',
        'require',
        'require_once',
        'return',
        'self',
        'static',
        'switch',
        'throw',
        'trait',
        'true',
        'try',
        'unset',
        'use',
        'var',
        'while',
        'xor',
        'yield',
        '__CLASS__',
        '__DIR__',
        '__FILE__',
        '__FUNCTION__',
        '__LINE__',
        '__METHOD__',
        '__NAMESPACE__',
        '__TRAIT__',
    ];

    /**
     * Create a new controller creator command instance.
     *
     * @param  \Symfony\Component\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files, $appRoot)
    {
        parent::__construct();

        $this->appRoot = $appRoot;
        $this->files = $files;
    }

    protected function configure(): void
    {
        if ($this->path)
        {
            $this
                ->addArgument('name', InputArgument::REQUIRED, 'How do you want to name it?')
            ;
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->stub[0] == '.')
        {
            $reflector = new \ReflectionClass(get_class($this));
            $path = $reflector->getFileName();
            $classname = $reflector->getShortName();
            $dir = explode($classname, $path)[0];

            $path = $dir. substr($this->stub, 2);
        }
        else
        {
            $path = __DIR__. '/stubs/' . $this->stub;
        }

        return $path;
    }

    protected function getAttrName($input)
    {
        return trim($input->getArgument('name'));
    }

    /**
     * Execute the console command.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($this->path)
        {
            $nameInput = $this->getAttrName($input);

            $io = new InputOutput($input, $output);

            if ($this->isReservedName($nameInput)) {

                $io->wrong('The name "'.$nameInput.'" is reserved by PHP.');
                return false;
            }

            $dirPath = $this->path . '/';
            $path = $dirPath . $nameInput . $this->prefix . $this->extension;

            if ($this->files->exists($path)) {

                $io->wrong('The  "'. $this->type . '' .$nameInput.'" is already exists.');
                return false;
            }

            $path = $this->appRoot .'/'. $path;

            if (!is_dir($dirPath)) {
                mkdir($dirPath);
            }

            file_put_contents($path, $this->sortImports($this->buildClass($nameInput)), 0);

            $io->right('The ' . $this->type . ' ' . $nameInput . ' has been created');
        }

        return Command::SUCCESS;
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        //
    }

    /**
     * Alphabetically sorts the imports for the given stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function sortImports($stub)
    {
        if (preg_match('/(?P<imports>(?:^use [^;{]+;$\n?)+)/m', $stub, $match)) {
            $imports = explode("\n", trim($match['imports']));

            sort($imports);

            return str_replace(trim($match['imports']), implode("\n", $imports), $stub);
        }

        return $stub;
    }

    /**
     * Parse the class name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');

        $name = str_replace('/', '\\', $name);

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        return $this->qualifyClass(
            $this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name
        );
    }

    /**
     * Qualify the given model class base name.
     *
     * @param  string  $model
     * @return string
     */
    protected function qualifyModel(string $model)
    {
        $model = ltrim($model, '\\/');

        $model = str_replace('/', '\\', $model);

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($model, $rootNamespace)) {
            return $model;
        }

        return is_dir(app_path('Models'))
                    ? $rootNamespace.'Models\\'.$model
                    : $rootNamespace.$model;
    }

    /**
     * Get a list of possible model names.
     *
     * @return array<int, string>
     */
    protected function possibleModels()
    {
        $modelPath = is_dir(app_path('Models')) ? app_path('Models') : app_path();

        return collect((new Finder)->files()->depth(0)->in($modelPath))
            ->map(fn ($file) => $file->getBasename($this->extension))
            ->values()
            ->all();
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return $this->files->exists($this->getPath($this->qualifyClass($rawName)));
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        $path = ''; // app path

        return $path.'/'.str_replace('\\', '/', $name).'.php';
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        return $path;
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     *
     */
    protected function buildClass($name)
    {
        $stub = file_get_contents($this->getStub());

        return $this
          ->replaceNamespace($stub, $name)
          ->replaceClassSingular($stub, $name)
          ->replaceClassSingularLowercase($stub, $name)
          ->replaceClassPlural($stub, $name)
          ->replaceClassKebab($stub, $name)
          ->replaceClass($stub, $name);
    }

    protected function replaceClassSingular(&$stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        $stub = str_replace(['DummyClassSingular', '{{ class_singular }}', '{{class_singular}}'], Str::lower(Str::singular(Str::of($class)->headline())), $stub);

        return $this;
    }

    protected function replaceClassSingularLowercase(&$stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        $stub = str_replace(['DummyClassSingularLowercase', '{{ class_singular_lowercase }}', '{{class_singular_lowercase}}'], Str::lower(strtolower(Str::singular(Str::of($class)->headline()))), $stub);

        return $this;
    }

    protected function replaceClassPlural(&$stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        $stub = str_replace(['DummyClassPlural', '{{ class_plural }}', '{{class_plural}}'], Str::lower(Str::pluralStudly(Str::of($class)->headline())), $stub);

        return $this;
    }

    protected function replaceClassKebab(&$stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        $stub = str_replace(['DummyClassKebab', '{{ class_kebab }}', '{{class_kebab}}'], Str::of($class)->kebab(), $stub);

        return $this;
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $searches = [
            ['DummyNamespace', 'DummyRootNamespace', 'NamespacedDummyUserModel'],
            ['{{ namespace }}', '{{ rootNamespace }}', '{{ namespacedUserModel }}'],
            ['{{namespace}}', '{{rootNamespace}}', '{{namespacedUserModel}}'],
        ];

        foreach ($searches as $search) {
            $stub = str_replace(
                $search,
                [$this->getNamespace($name), $this->rootNamespace(), $stub],
                $stub
            );
        }

        return $this;
    }

    /**
     * Get the full namespace for a given class, without the class name.
     *
     * @param  string  $name
     * @return string
     */
    protected function getNamespace($name)
    {
        return trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace(['DummyClass', '{{ class }}', '{{class}}'], $class, $stub);
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return trim($this->argument('name'));
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return 'App\\';
    }

    /**
     * Checks whether the given name is reserved.
     *
     * @param  string  $name
     * @return bool
     */
    protected function isReservedName($name)
    {
        $name = strtolower($name);

        return in_array($name, $this->reservedNames);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the '.strtolower($this->type)],
        ];
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array
     */
    protected function promptForMissingArgumentsUsing()
    {
        return [
            'name' => 'What should the '.strtolower($this->type).' be named?',
        ];
    }

    protected function addToLine($file_src , $search_word , $new_text)
    {
        $file = file($file_src);

        for($i = 0 ; $i < count($file) ; $i++)
        {
            if(strstr($file[$i] , $search_word))
            {
                $file[$i] = $file[$i] . $new_text . PHP_EOL;
                break;
            }
        }
        return $file;
    }
}
