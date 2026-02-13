<?php

namespace App\Http\Controllers\Admin\Filemanager;

use UniSharp\LaravelFilemanager\Controllers\UploadController as BaseUpload;

class UploadController extends BaseUpload
{
    public function upload()
    {
        if (!auth()->user()->role->permissions->pluck('slug')->contains('admin.filemanager.upload')) {
            return response()->json([
                'error' => 'Upload not allowed'
            ], 403);
        }

        return parent::upload();
    }
}
