<?php

namespace Sowren\Wormhole;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Wormhole
{
    /**
     * Save file to storage.
     *
     * @param  UploadedFile  $file  The file to upload
     * @param  string  $directory  The directory in which file should be saved, default is 'files'.
     * @param  string  $disk  The disk where the file should upload
     * @return string The file name
     * @throws Exception
     */
    public function saveFile(UploadedFile $file, string $directory = 'files', string $disk = 'public'): string
    {
        try {
            $filename = Str::random(8).'_'.time().'.'.$file->getClientOriginalExtension();
            $file->storeAs($directory.'/', $filename, $disk);
            return $filename;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Save a Base64 encoded file to storage.
     *
     * @param  string  $data  Base64 file string
     * @param  string  $directory  The directory in which file should be saved, default is 'files'
     * @param  string  $disk  The disk where the file should upload
     * @return string The file name
     * @throws Exception
     */
    public function saveBase64File(string $data, string $directory = 'files', string $disk = 'public'): string
    {
        try {
            if (preg_match('/^data:(\w+)\/(\w+);base64,/', $data, $type)) {
                // Extract file data from base64 string which will be saved as binary file
                list(, $file64) = explode(',', explode(';', $data)[1]);
                $extension = strtolower($type[2]);
                $filename = Str::random(8).'_'.time().'.'.$extension;

                Storage::disk($disk)->put('/'.$directory.'/'.$filename, base64_decode($file64));
                return $filename;
            } else {
                throw new \Exception('Invalid file data!');
            }
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Remove a file from storage.
     *
     * @param  string  $filename  Name of file to be deleted
     * @param  string  $directory  Directory in which the file resides, default 'files'
     * @param  string  $disk  Disk in which the file is located
     * @return bool
     */
    public function deleteFile(string $filename, string $directory = 'files', string $disk = 'public'): bool
    {
        if ($filename == '' || !Storage::disk($disk)->exists($directory.'/'.$filename)) {
            return false;
        }
        return Storage::disk($disk)->delete($directory.'/'.$filename);
    }
}
