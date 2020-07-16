<?php


namespace Sowren\Wormhole;


use Illuminate\Support\ServiceProvider;

class WormholeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
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
        $this->app->singleton('Wormhole', function ($app) {
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
            __DIR__.'/../resources/js/components/FileUploader.stub' => resource_path('js/components/FileUploader.vue'),
        ], 'wormhole-ui');

        $this->publishes([
            __DIR__.'/../resources/js/mixins/toasts.stub' => resource_path('js/mixins/toasts.js'),
        ], 'wormhole-js');
    }
}
