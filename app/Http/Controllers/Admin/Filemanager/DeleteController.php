<?php

namespace App\Http\Controllers\Admin\Filemanager;

use UniSharp\LaravelFilemanager\Controllers\DeleteController as BaseDelete;

class DeleteController extends BaseDelete
{
    public function getDelete()
    {
        if (!auth()->user()->role->permissions->pluck('slug')->contains('admin.filemanager.delete')) {
            return response()->json([
                'error' => 'Delete not allowed'
            ], 403);
        }

        return parent::getDelete();
    }
}
