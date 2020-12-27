<?php


namespace Sowren\Wormhole\Test\Feature;

use Illuminate\Http\UploadedFile;
use Sowren\Wormhole\Test\TestCase;
use Sowren\Wormhole\Facades\Wormhole;
use Illuminate\Support\Facades\Storage;

class FileDeleteTest extends TestCase
{
    /** @test */
    public function testFileDelete()
    {
        $file = UploadedFile::fake()->image('avatar.png');
        $filename = Wormhole::saveFile($file, 'avatars');
        Wormhole::deleteFile($filename, 'avatars');
        Storage::disk('public')->assertMissing('avatars/'.$filename);
    }
}
