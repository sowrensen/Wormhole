# Wormhole

> Plug and play file uploader for Laravel applications.

Wormhole is a package for Laravel applications that provides a couple of methods which can be used to upload file and store them to different location in server. Make no mistake, Laravel itself provides very convenient way to upload file, and this package is using nothing but Laravel's `Storage` class under the hood. The difference is, methods provided here can be used for multiple purposes. I find myself copying and pasting same code on all of my projects and so I thought to put these methods in a package. Nothing fancy! 

**Plus**, there is a Vue component included with progress bar to show file uploading progress and with configurable front-end validation, which can be published if anyone wants.

Installation
---

To install the package run,

```bash
composer require sowrensen/wormhole
```

Usage
---

You can add an alias to use the facade or you can use it directly. To set an alias add following line in `config/app.php`.

```
'Wormhole' => Sowren\Wormhole\Facades\Wormhole::class,
``` 

There are three methods provided in this package. 

#### 1. saveFile

Use this method to store any binary file. It takes one mandatory and two optional parameters. After successful operation, an auto-generated file name will be returned, you should save this to your database.

Parameter | Type | Description
:---------|:-----|:-----------
`$request` | \Illuminate\Http\Request | An usual Request object (Required)
`$field` | string | The attribute name which contains the file (Default `'file'`)
`$directory` | string |  The directory name in which the file should be stored, it will be placed inside `storage/app/public` folder of Laravel app. Default is `'files'`.

**Returns**: The auto-generated file name. 

#### 2. saveBase64File

Use this method to store any Base64 encoded file. An example use case of Base64 encoded file when you resize and crop an image in a canvas before uploading. The parameters are same as `saveFile` method. After successful operation, an auto-generated file name will be returned, you should save this to your database.

Parameter | Type | Description
:---------|:-----|:-----------
`$request` | \Illuminate\Http\Request | An usual Request object (Required)
`$field` | string | The attribute name which contains the file (Default `'file'`)
`$directory` | string |  The directory name in which the file should be stored, it will be placed inside `storage/app/public` folder of Laravel app. Default is `'files'`.

**Returns**: The auto-generated file name.

#### 3. deleteFile

This method takes one mandatory parameter and one optional parameter. 

Parameter | Type | Description
:---------|:-----|:-----------
`$filename` | string | Name of the file to be removed (Required)
`$directory` | string | Name of the directory where the file resides inside `storage/app/public`. Default is `'files'`.

**Returns**: `true` or `false` depending on operation status.
