<?php

namespace CrazyBoy49z\LaravelExtends\Console\Commands;;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class ViewComposerMakeCommand extends GeneratorCommand
{
    protected $files;
    protected $config;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view-composer {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new view composer class';
    /**
     * @var string
     */

    protected $type = 'ViewComposer';

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        $name = ucwords(Str::camel(trim($this->argument('name'))), "\/");

        if (Str::endsWith($name, ['Composer', 'ViewComposer']) === false) {
            $name .= 'Composer';
        }

        return $name;
    }

    /**
     * Get the stub files for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/view.composer.stub';
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
        return $rootNamespace.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.Str::plural($this->type);
    }

}