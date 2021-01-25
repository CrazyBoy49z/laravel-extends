<?php

namespace CrazyBoy49z\LaravelExtends\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class ServiceMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:service {name}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';
    /**
     * Get the class name from name input.
     *
     * @return string
     */

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        // First we need to ensure that the given name is not a reserved word within the PHP
        // language and that the class name will actually be valid. If it is not valid we
        // can error now and prevent from polluting the filesystem using invalid files.
        if ($this->isReservedName($this->getNameInput())) {
            $this->error('The name "'.$this->getNameInput().'" is reserved by PHP.');

            return false;
        }

        $name = $this->qualifyClass($this->getNameInput());

        $path = $this->getPath($name);
        $interfacePath = $this->getInterfacePath($name);

        // First we will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.
        if ((!$this->hasOption('force') ||
                !$this->option('force')) &&
            $this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');

            return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);
        $this->makeDirectory($interfacePath);
        $this->files->put($path, $this->buildClass($name));
        $this->files->put($interfacePath, $this->buildInterface($name));

        $this->info($this->type.' Interface created successfully.');
        $this->info($this->type.' created successfully.');
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

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function getInterfacePath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'].DIRECTORY_SEPARATOR.str_replace('\\', DIRECTORY_SEPARATOR,
                $name.'Interface').'.php';
    }

    /**
     * Build the interface with the given name.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function buildInterface($name)
    {
        $stub = $this->files->get($this->getInterfaceStub());

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $this->getInterfaceName());
    }

    /**
     * Get the Interface stub file for the generator.
     *
     * @return string
     */
    protected function getInterfaceStub()
    {
        return __DIR__.'/stubs/serviceInterface.stub';
    }

    protected function getInterfaceName()
    {
        return $this->getClassName().'Interface';
    }

    protected function getClassName()
    {
        return class_basename($this->getNameInput());
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/service.stub';
    }

    //

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
}