<?php

namespace App\Services;

use App\Services\Interfaces\SlideshowServiceInterface;
use App\Logging\Concerns\HasLogging;
use App\Logging\LogAction;
use App\Traits\TrackDeletions;
use App\Models\Slideshow;

class SlideshowService implements SlideshowServiceInterface
{
    use TrackDeletions, HasLogging;

    public function create(array $data): Slideshow
    {
        try {
            $data['created_by'] = auth()->id();

            $slideshow = Slideshow::create($data);

            $this->logAdmin(
                'Admin created slideshow',
                LogAction::CREATE,
                ['target_slideshow_id' => $slideshow->id]
            );

            return $slideshow;
        } catch (\Throwable $e) {
            $this->logCritical('Critical admin operation failed', [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    public function update(int $id, array $data): Slideshow
    {
        try {
            $data['updated_by'] = auth()->id();
        
            $slideshow = Slideshow::findOrFail($id);
            $slideshow->update($data);

            $this->logAdmin(
                'Admin updated slideshow',
                LogAction::UPDATE,
                ['target_slideshow_id' => $slideshow->id]
            );

            return $slideshow;
        } catch (\Throwable $e) {
            $this->logCritical('Critical admin operation failed', [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    public function delete(int $id): void
    {
        try {
            Slideshow::find($id)->delete();

            $this->logAdmin(
                'Admin deleted slideshow',
                LogAction::DELETE,
                ['target_slideshow_id' => $id]
            );
        } catch (\Throwable $e) {

            $this->logCritical('Critical admin operation failed', [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}