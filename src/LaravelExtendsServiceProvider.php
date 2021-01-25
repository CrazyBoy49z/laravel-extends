<?php

namespace CrazyBoy49z\LaravelExtends;

use CrazyBoy49z\LaravelExtends\Console\Commands\ServiceMakeCommand;
use CrazyBoy49z\LaravelExtends\Console\Commands\TraitMakeCommand;
use CrazyBoy49z\LaravelExtends\Console\Commands\ViewComposerMakeCommand;
use Illuminate\Support\ServiceProvider;

class LaravelExtendsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'crazyboy49z');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'crazyboy49z');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        //$this->publishes([
        //    __DIR__.'/../config/laravelextends.php' => config_path('laravelextends.php'),
        //], 'laravelextends.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/crazyboy49z'),
        ], 'laravelextends.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/crazyboy49z'),
        ], 'laravelextends.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/crazyboy49z'),
        ], 'laravelextends.views');*/

        // Registering package commands.
        $this->commands([
            TraitMakeCommand::class,
            ServiceMakeCommand::class,
            ViewComposerMakeCommand::class,
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        //$this->mergeConfigFrom(__DIR__.'/../config/laravelextends.php', 'laravelextends');

        // Register the service the package provides.
        $this->app->singleton('laravelextends', function ($app) {
            return new LaravelExtends;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravelextends'];
    }
}
