<?php


namespace Sowren\Wormhole\Test;

use Sowren\Wormhole\WormholeServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            WormholeServiceProvider::class,
        ];
    }
}
