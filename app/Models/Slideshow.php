<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TrackDeletions;

class Slideshow extends Model
{
    use SoftDeletes, TrackDeletions;
    protected $table = 'slideshows';

    protected $fillable = [
        'is_active',
        'order',
        'title',
        'description',
        'image_path',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
