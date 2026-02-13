<?php

namespace App\Services\Interfaces;

use App\Models\Role;

interface RoleServiceInterface
{
    public function create(array $data): Role;
    public function update(int $id, array $data): Role;
    public function delete(int $id): void;
}