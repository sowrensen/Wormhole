<?php

namespace Sowren\Wormhole\Facades;

use Illuminate\Support\Facades\Facade;

class Wormhole extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Wormhole';
    }
}
