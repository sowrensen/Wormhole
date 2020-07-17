<?php

namespace Sowren\Wormhole;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Wormhole
{
    /**
     * Save file to storage.
     *
     * @param  Request  $request  The request object
     * @param  string  $field  The input field name, default is 'file'
     * @param  string  $directory  The directory in which file should be saved, default is 'files'
     * @return string The file name
     * @throws Exception
     */
    public function saveFile(Request $request, string $field = 'file', string $directory = 'files'): string
    {
        $filename = '';
        if (!request($field)) {
            throw new Exception('Input field not found!');
        }

        try {
            $file = $request->file($field);
            $filename = Str::random(8).'_'.time().'.'.$file->getClientOriginalExtension();
            $file->storeAs($directory.'/', $filename, 'public');
            return $filename;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Save a Base64 encoded file to storage.
     *
     * @param  Request  $request  The request object
     * @param  string  $field  The input field name, default is 'file'
     * @param  string  $directory  The directory in which file should be saved, default is 'files'
     * @return string The file name
     * @throws Exception
     */
    public function saveBase64File(Request $request, string $field = 'file', string $directory = 'files'): string
    {
        $filename = '';
        if (!$request->input($field)) {
            throw new Exception('Input field not found!');
        }
        try {
            $data = $request->input($field);
            if (preg_match('/^data:(\w+)\/(\w+);base64,/', $data, $type)) {
                list(, $file64) = explode(',', explode(';', $data)[1]);
                $extension = strtolower($type[2]);
                $filename = Str::random(8).'_'.time().'.'.$extension;
                Storage::disk('public')->put('/'.$directory.'/'.$filename, base64_decode($file64));
            }
            return $filename;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Remove a file from storage.
     *
     * @param  string  $filename  Name of file to be deleted
     * @param  string  $directory  Directory in which the file resides, default 'files'
     * @return bool
     */
    public function deleteFile(string $filename, string $directory = 'files'): bool
    {
        if ($filename == '' || !Storage::disk('public')->exists($directory.'/'.$filename)) {
            return false;
        }
        return Storage::disk('public')->delete($directory.'/'.$filename);
    }
}
