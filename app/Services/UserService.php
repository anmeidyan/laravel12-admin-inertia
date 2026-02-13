<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Logging\Concerns\HasLogging;
use App\Logging\LogAction;
use App\Traits\TrackDeletions;
use App\Models\User;

class UserService implements UserServiceInterface
{
    use TrackDeletions, HasLogging;

    public function create(array $data): User
    {
        try {
            $data['password'] = \Hash::make($data['password']);
            $data['created_by'] = auth()->id();

            $user = User::create($data);

            $this->logAdmin(
                'Admin created user',
                LogAction::CREATE,
                ['target_user_id' => $user->id]
            );

            return $user;
        } catch (\Throwable $e) {
            $this->logCritical('Critical admin operation failed', [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    public function update(int $id, array $data): User
    {
        try {
             if (empty($data['password'])) {
                unset($data['password']);
            } else {
                $data['password'] = \Hash::make($data['password']);
            }
            $data['updated_by'] = auth()->id();

            $user = User::findOrFail($id);
            $user->update($data);

            $this->logAdmin(
                'Admin updated user',
                LogAction::UPDATE,
                ['target_user_id' => $user->id]
            );

            return $user;
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
            User::find($id)->delete();

            $this->logAdmin(
                'Admin deleted user',
                LogAction::DELETE,
                ['target_user_id' => $id]
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