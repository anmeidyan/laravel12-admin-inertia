<?php

namespace App\Http\Controllers\Admin;

use App\Services\Interfaces\RoleServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Role;
use App\Models\Menu;

class RoleController extends Controller
{
    public function __construct(protected RoleServiceInterface $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        if (\Gate::denies('admin.user.role.index')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('flash', [
                    'type' => 'danger',
                    'message' => 'Unauthorized access attempt.'
                ]);
        }

        return Inertia::render('Role/Index', [
            'roles' => Role::whereNull('deleted_at')->get()
        ]);
    }

    public function create()
    {
        if (\Gate::denies('admin.user.role.create')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('flash', [
                    'type' => 'danger',
                    'message' => 'Unauthorized access attempt.'
                ]);
        }

        return Inertia::render('Role/Create', [
            'menus' => Menu::with(['permissions','children.permissions'])->where('is_active', 1)->whereNull('parent_id')->get()
        ]);
    }

    public function store(Request $request)
    {
        if (\Gate::denies('admin.user.role.create')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('flash', [
                    'type' => 'danger',
                    'message' => 'Unauthorized access attempt.'
                ]);
        }

        $validated = $request->validate([
            'is_active' => 'required|boolean',
            'name' => 'required|string|max:255|unique:roles,name,NULL,id,deleted_at,NULL',
            'permission_ids' => 'array',
            'permission_ids.*' => 'integer|exists:permissions,id',
        ]);

        $this->roleService->create($validated);

        return redirect()
            ->route('admin.user.role.index')
            ->with('flash', [
                'type' => 'success',
                'message' => 'Role created successfully.'
            ]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        if (\Gate::denies('admin.user.role.edit')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('flash', [
                    'type' => 'danger',
                    'message' => 'Unauthorized access attempt.'
                ]);
        }

        // dd(Role::with('permissions')->where('id',$id)->first());

        return Inertia::render('Role/Edit', [
            'role' => Role::with('permissions')->where('id',$id)->first(),
            'menus' => Menu::with(['permissions','children.permissions'])->where('is_active', 1)->whereNull('parent_id')->get()
        ]);
    }

    public function update(Request $request, string $id)
    {
        if (\Gate::denies('admin.user.role.edit')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('flash', [
                    'type' => 'danger',
                    'message' => 'Unauthorized access attempt.'
                ]);
        }

        $validated = $request->validate([
            'is_active' => 'required|boolean',
            'name' => 'required|string|max:255|unique:roles,name,'.$id.',id,deleted_at,NULL',
            'permission_ids' => 'array',
            'permission_ids.*' => 'integer|exists:permissions,id',
        ]);

        $this->roleService->update((int)$id, $validated);

        return redirect()
            ->route('admin.user.role.index')
            ->with('flash', [
                'type' => 'success',
                'message' => 'Role updated successfully.'
            ]);
    }

    public function destroy(string $id)
    {
        if (\Gate::denies('admin.user.role.delete')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('flash', [
                    'type' => 'danger',
                    'message' => 'Unauthorized access attempt.'
                ]);
        }

        $this->roleService->delete((int)$id);

        return redirect()
            ->route('admin.user.role.index')
            ->with('flash', [
                'type' => 'success',
                'message' => 'Role deleted successfully.'
            ]);
    }
}
