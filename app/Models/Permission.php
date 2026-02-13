<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Menu;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $fillable = [
        'name',
        'slug'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }
}
