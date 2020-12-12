<?php


namespace Sowren\Wormhole\Test\Feature;

use Sowren\Wormhole\Test\TestCase;

class CommandTest extends TestCase
{
    private function clearPublishedResources()
    {
        if (\File::exists(resource_path('js/components/FileUploader.vue'))) {
            unlink(resource_path('js/components/FileUploader.vue'));
        }
    }

    /** @test */
    public function testWormholePublishCommandWithBootstrapArgument()
    {
        $this->clearPublishedResources();
        $this->assertFileDoesNotExist(resource_path('js/components/FileUploader.vue'));
        \Artisan::call('wormhole:publish', [
            'preset' => 'bootstrap'
        ]);
        $this->assertFileExists(resource_path('js/components/FileUploader.vue'));
    }

    /** @test */
    public function testWormholePublishCommandWithUikitArgument()
    {
        $this->clearPublishedResources();
        $this->assertFileDoesNotExist(resource_path('js/components/FileUploader.vue'));
        \Artisan::call('wormhole:publish', [
            'preset' => 'uikit'
        ]);
        $this->assertFileExists(resource_path('js/components/FileUploader.vue'));
    }

    /** @test */
    public function testWormholePublishCommandWithInvalidArgument()
    {
        $this->clearPublishedResources();
        $this->assertFileDoesNotExist(resource_path('js/components/FileUploader.vue'));
        \Artisan::call('wormhole:publish', [
            'preset' => 'invalid'
        ]);
        $this->assertFileDoesNotExist(resource_path('js/components/FileUploader.vue'));
    }
}
