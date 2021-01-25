<?php

namespace CrazyBoy49z\LaravelExtends\Console\Commands\Contracts;


interface ServiceInterface
{
    public function make(array $request);
}