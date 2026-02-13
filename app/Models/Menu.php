<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'name',
        'route',
        'icon',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }
}
