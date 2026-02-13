<?php

namespace App\Traits;

trait TrackDeletions
{
    protected static function bootTrackDeletions()
    {
        static::deleting(function ($model) {
            if (!$model->isForceDeleting() && \Auth::check()) {
                $model->update([
                    'deleted_by' => \Auth::id()
                ]);
            }
        });
    }
}