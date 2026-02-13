<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface UserServiceInterface
{
    public function create(array $data): User;
    public function update(int $id, array $data): User;
    public function delete(int $id): void;
}