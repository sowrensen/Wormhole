<?php


namespace Sowren\Wormhole\Test\Feature;

use Sowren\Wormhole\Wormhole;
use Orchestra\Testbench\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileDeleteTest extends TestCase
{
    /** @test */
    public function a_file_should_get_deleted()
    {
        $file = UploadedFile::fake()->image('avatar.png');
        $wh = new Wormhole();
        $filename = $wh->saveFile($file, 'avatars');
        $wh->deleteFile($filename, 'avatars');
        Storage::disk('public')->assertMissing('avatars/'.$filename);
    }
}
