<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TrackDeletions;
use App\Models\Permission;

class Role extends Model
{
    use SoftDeletes, TrackDeletions;
    protected $table = 'roles';

    protected $fillable = [
        'is_active',
        'name',
        'slug',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
