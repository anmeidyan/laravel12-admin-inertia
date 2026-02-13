<?php

namespace App\Services;

use App\Services\Interfaces\RoleServiceInterface;
use App\Logging\Concerns\HasLogging;
use App\Logging\LogAction;
use App\Traits\TrackDeletions;
use App\Models\Role;

class RoleService implements RoleServiceInterface
{
    use TrackDeletions, HasLogging;

    public function create(array $data): Role
    {
        try {
            $data['slug'] = \Str::slug($data['name']);
            $data['created_by'] = auth()->id();

            $role = Role::create($data);

            $this->logAdmin(
                'Admin created role',
                LogAction::CREATE,
                ['target_role_id' => $role->id]
            );

            return $role;
        } catch (\Throwable $e) {
            $this->logCritical('Critical admin operation failed', [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    public function update(int $id, array $data): Role
    {
        try {
            $data['slug'] = \Str::slug($data['name']);
            $data['updated_by'] = auth()->id();
        
            $role = Role::findOrFail($id);
            $role->update($data);

            if (isset($data['permission_ids'])) {
                $role->permissions()->sync($data['permission_ids']);
            }

            $this->logAdmin(
                'Admin updated role',
                LogAction::UPDATE,
                ['target_role_id' => $role->id]
            );

            return $role;
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
            Role::find($id)->delete();

            $this->logAdmin(
                'Admin deleted role',
                LogAction::DELETE,
                ['target_role_id' => $id]
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