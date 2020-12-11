<?php

namespace Sowren\Wormhole\Facades;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Facade;

/**
 * @method \Sowren\Wormhole\Wormhole saveFile(UploadedFile $file, string $directory = 'files', string $disk = 'public')
 * @method \Sowren\Wormhole\Wormhole saveBase64File(string $data, string $directory = 'files', string $disk = 'public')
 * @method \Sowren\Wormhole\Wormhole deleteFile(string $filename, string $directory = 'files', string $disk = 'public')
 */
class Wormhole extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'wormhole';
    }
}
