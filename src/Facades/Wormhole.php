<?php

namespace Sowren\Wormhole\Facades;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string saveFile(UploadedFile $file, string $directory = 'files', string $disk = 'public')
 * @method static string saveBase64File(string $data, string $directory = 'files', string $disk = 'public')
 * @method static bool deleteFile(string $filename, string $directory = 'files', string $disk = 'public')
 * @see \Sowren\Wormhole\Wormhole
 */
class Wormhole extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'wormhole';
    }
}
