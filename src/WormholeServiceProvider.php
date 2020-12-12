<?php

namespace Sowren\Wormhole;

use Illuminate\Support\ServiceProvider;
use Sowren\Wormhole\Console\Commands\PublishCommand;

class WormholeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerCommands();
            $this->registerPublishing();
        }

        $this->registerResources();
    }

    /**
     * Register all package resources.
     *
     * @return void
     */
    private function registerResources()
    {
        $this->registerFacades();
    }

    /**
     * Register any bindings to the app.
     *
     * @return void
     */
    protected function registerFacades()
    {
        $this->app->bind('wormhole', function ($app) {
            return new \Sowren\Wormhole\Wormhole();
        });
    }

    /**
     * Register package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../resources/js/components/FileUploader-Bootstrap.stub' => resource_path('js/components/FileUploader.vue'),
        ], 'wormhole-bootstrap');

        $this->publishes([
            __DIR__.'/../resources/js/components/FileUploader-UIKit.stub' => resource_path('js/components/FileUploader.vue'),
        ], 'wormhole-uikit');
    }

    /**
     * Register package commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->commands([
            PublishCommand::class,
        ]);
    }
}
