<?php

namespace App\Http\Controllers\Admin\Filemanager;

use UniSharp\LaravelFilemanager\Controllers\RenameController as BaseRename;

class RenameController extends BaseRename
{
    public function getRename()
    {
        if (!auth()->user()->role->permissions->pluck('slug')->contains('admin.filemanager.rename')) {
            abort(403, 'Rename not allowed');
        }

        return parent::getRename();
    }
}
