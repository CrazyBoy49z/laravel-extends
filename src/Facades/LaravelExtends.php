<?php

namespace CrazyBoy49z\LaravelExtends\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelExtends extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravelextends';
    }
}
