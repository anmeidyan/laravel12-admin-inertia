<?php

namespace App\Http\Controllers\Admin;

use App\Services\Interfaces\UserServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(protected UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        if (\Gate::denies('admin.user.list.index')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('flash', [
                    'type' => 'danger',
                    'message' => 'Unauthorized access attempt.'
                ]);
        }

        return Inertia::render('User/Index', [
            'users' => User::with('role')->whereNull('deleted_at')->get(),
        ]);
    }

    public function create()
    {
        if (\Gate::denies('admin.user.list.create')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('flash', [
                    'type' => 'danger',
                    'message' => 'Unauthorized access attempt.'
                ]);
        }

        return Inertia::render('User/Create',[
            'roles' => Role::whereNull('deleted_at')->get(),
        ]);
    }

    public function store(Request $request)
    {
        if (\Gate::denies('admin.user.list.create')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('flash', [
                    'type' => 'danger',
                    'message' => 'Unauthorized access attempt.'
                ]);
        }

        $validated = $request->validate([
            'is_active' => 'required|boolean',
            'role_id' => 'required|integer|exists:roles,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8|same:password',
        ]);

        $this->userService->create($validated);

        return redirect()
            ->route('admin.user.list.index')
            ->with('flash', [
                'type' => 'success',
                'message' => 'User created successfully.'
            ]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        if (\Gate::denies('admin.user.list.edit')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('flash', [
                    'type' => 'danger',
                    'message' => 'Unauthorized access attempt.'
                ]);
        }

        return Inertia::render('User/Edit',[
            'user' => User::with('role')->whereNull('deleted_at')->findOrFail($id),
            'roles' => Role::whereNull('deleted_at')->get(),
        ]);
    }

    public function update(Request $request, string $id)
    {
        if (\Gate::denies('admin.user.list.edit')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('flash', [
                    'type' => 'danger',
                    'message' => 'Unauthorized access attempt.'
                ]);
        }

        $validated = $request->validate([
            'is_active' => 'required|boolean',
            'role_id' => 'required|integer|exists:roles,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id.',id,deleted_at,NULL',
            'password_confirmation' => 'same:password',
        ]);

        $this->userService->update((int)$id, $validated);

        return redirect()
            ->route('admin.user.list.index')
            ->with('flash', [
                'type' => 'success',
                'message' => 'User updated successfully.'
            ]);
    }

    public function destroy(string $id)
    {
        if (\Gate::denies('admin.user.list.delete')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('flash', [
                    'type' => 'danger',
                    'message' => 'Unauthorized access attempt.'
                ]);
        }

        $this->userService->delete((int)$id);

        return redirect()
            ->route('admin.user.list.index')
            ->with('flash', [
                'type' => 'success',
                'message' => 'User deleted successfully.'
            ]);
    }
}
