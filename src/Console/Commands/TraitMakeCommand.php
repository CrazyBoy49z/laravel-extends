<?php

namespace CrazyBoy49z\LaravelExtends\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class TraitMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:trait {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new trait';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Trait';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/trait.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.DIRECTORY_SEPARATOR.Str::plural($this->type);
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        $name = ucwords(Str::camel(trim($this->argument('name'))), "/");

        if (Str::endsWith($name, $this->type) === false) {
            $name .= $this->type;
        }

        return $name;
    }
}
