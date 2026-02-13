<?php

namespace App\Services\Interfaces;

use App\Models\Slideshow;

interface SlideshowServiceInterface
{
    public function create(array $data): Slideshow;
    public function update(int $id, array $data): Slideshow;
    public function delete(int $id): void;
}