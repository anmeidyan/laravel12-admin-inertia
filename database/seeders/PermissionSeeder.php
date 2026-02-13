<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            ['name' => 'View User Management', 'slug' => 'admin.user.*'],
            ['name' => 'View User', 'slug' => 'admin.user.list.index'],
            ['name' => 'Create User', 'slug' => 'admin.user.list.create'],
            ['name' => 'Edit User', 'slug' => 'admin.user.list.edit'],
            ['name' => 'Delete User', 'slug' => 'admin.user.list.delete'],
            ['name' => 'View Role', 'slug' => 'admin.user.role.index'],
            ['name' => 'Create Role', 'slug' => 'admin.user.role.create'],
            ['name' => 'Edit Role', 'slug' => 'admin.user.role.edit'],
            ['name' => 'Delete Role', 'slug' => 'admin.user.role.delete'],

            ['name' => 'View Slideshow', 'slug' => 'admin.slideshow.index'],
            ['name' => 'Create Slideshow', 'slug' => 'admin.slideshow.create'],
            ['name' => 'Edit Slideshow', 'slug' => 'admin.slideshow.edit'],
            ['name' => 'Delete Slideshow', 'slug' => 'admin.slideshow.delete'],

            ['name' => 'View Filemanager', 'slug' => 'admin.filemanager.view'],
            ['name' => 'Upload Filemanager', 'slug' => 'admin.filemanager.upload'],
            ['name' => 'Rename Filemanager', 'slug' => 'admin.filemanager.rename'],
            ['name' => 'Delete Filemanager', 'slug' => 'admin.filemanager.delete'],
        ]);
    }
}
