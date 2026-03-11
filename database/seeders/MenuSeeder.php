<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userManagement = Menu::create([
            'is_active' => true,
            'is_view' => true,
            'order' => 2,
            'parent_id' => null,
            'name' => 'User Management',
            'url' => null,
            'route' => 'admin.user.*',
            'icon' => 'fa-user',
        ]);

        $userList = Menu::create([
            'is_active' => true,
            'is_view' => true,
            'order' => 1,
            'parent_id' => 1,
            'name' => 'List',
            'url' => '/admin-panel/user',
            'route' => 'admin.user.list.index',
            'icon' => null,
        ]);

        $userRole = Menu::create([
            'is_active' => true,
            'is_view' => true,
            'order' => 2,
            'parent_id' => 1,
            'name' => 'Role',
            'url' => '/admin-panel/role',
            'route' => 'admin.user.role.index',
            'icon' => null,
        ]);

        $slideshow = Menu::create([
            'is_active' => true,
            'is_view' => true,
            'order' => 1,
            'parent_id' => null,
            'name' => 'Slideshow',
            'url' => '/admin-panel/slideshow',
            'route' => 'admin.slideshow.index',
            'icon' => 'fa-images',
        ]);

        $noView = Menu::create([
            'is_active' => true,
            'is_view' => false,
            'order' => 99,
            'parent_id' => null,
            'name' => 'No View Menus',
            'url' => null,
            'route' => 'admin.user.*',
            'icon' => null,
        ]);

        $userManagement->permissions()->sync([1]);
        $userList->permissions()->sync([2,3,4,5]);
        $userRole->permissions()->sync([6,7,8,9]);
        $slideshow->permissions()->sync([10,11,12,13]);
        $noView->permissions()->sync([14,15,16,17]);
    }
}
