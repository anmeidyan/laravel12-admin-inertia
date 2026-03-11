<?php

namespace App\Services;

use App\Models\Menu;

class MenuService
{
    public function getSideMenus()
    {
        if(auth()->check()){
            $permissionIds = auth()->user()->role->permissions->pluck('id');

            return Menu::with(['children' => function ($q) use ($permissionIds) {
                        $q->whereHas('permissions', function ($q) use ($permissionIds) {
                            $q->whereIn('permissions.id', $permissionIds);
                        });
                    }])
                    ->where('is_active', 1)
                    ->where('is_view', 1)
                    ->whereNull('parent_id')
                    ->whereHas('permissions', function ($q) use ($permissionIds) {
                        $q->whereIn('permissions.id', $permissionIds);
                    })
                    ->orderBy('order', 'asc')
                    ->get();
        }
    }
}