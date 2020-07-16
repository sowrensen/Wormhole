<?php

namespace Sowren\Wormhole;

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
     */
    public function saveFile(Request $request, string $field = 'file', string $directory = 'files'): string
    {
        $filename = '';
        if (!request($field)) {
            return $filename;
        }
        $file = $request->file($field);
        $filename = Str::random(8).'_'.time().'.'.$file->getClientOriginalExtension();
        $file->storeAs($directory.'/', $filename, 'public');

        return $filename;
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

    /**
     * Save a Base64 encoded file to storage.
     *
     * @param  Request  $request  The request object
     * @param  string  $field  The input field name, default is 'file'
     * @param  string  $directory  The directory in which file should be saved, default is 'files'
     * @return string The file name
     */
    public function saveBase64File(Request $request, string $field = 'file', string $directory = 'files'): string
    {
        $filename = '';
        if (!request($field)) {
            return $filename;
        }

        $fileB64 = $request->input($field);
        if ($fileB64 == "") {
            return $filename;
        }

        list($type, $fileB64) = explode(';', $fileB64);
        list(, $fileB64) = explode(',', $fileB64);

        $extension = explode('/', mime_content_type($base64_encoded_string))[1];
        $filename = Str::random(8).'_'.time().'.'.$extension;
        $file = base64_decode($fileB64);
        // Store image in public disk
        Storage::disk('public')->put('/'.$directory.'/'.$filename, $file);

        return $filename;
    }
}
