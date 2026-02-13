<?php

namespace App\Http\Controllers\Admin;

use App\Services\Interfaces\UserServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            return redirect()->route('admin.dashboard')->with('danger', 'Unauthorized access attempt.');
        }

        $data = [];
        $data['users'] = User::whereNull('deleted_at')->get();

        return view('admin.users.index', $data);
    }

    public function create()
    {
        if (\Gate::denies('admin.user.list.create')) {
            return redirect()->route('admin.dashboard')->with('danger', 'Unauthorized access attempt.');
        }

        $data = [];
        $data['roles'] = Role::whereNull('deleted_at')->get();

        return view('admin.users.create', $data);
    }

    public function store(Request $request)
    {
        if (\Gate::denies('admin.user.list.create')) {
            return redirect()->route('admin.dashboard')->with('danger', 'Unauthorized access attempt.');
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

        return redirect()->route('admin.user.list.index')->with('success', 'User created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        if (\Gate::denies('admin.user.list.edit')) {
            return redirect()->route('admin.dashboard')->with('danger', 'Unauthorized access attempt.');
        }

        $data = [];
        $data['user'] = User::findOrFail($id);
        $data['roles'] = Role::whereNull('deleted_at')->get();

        return view('admin.users.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        if (\Gate::denies('admin.user.list.edit')) {
            return redirect()->route('admin.dashboard')->with('danger', 'Unauthorized access attempt.');
        }

        $validated = $request->validate([
            'is_active' => 'required|boolean',
            'role_id' => 'required|integer|exists:roles,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id.',id,deleted_at,NULL',
            'password_confirmation' => 'same:password',
        ]);

        $this->userService->update((int)$id, $validated);

        return redirect()->route('admin.user.list.index')->with('success', 'User updated successfully.');
    }

    public function destroy(string $id)
    {
        if (\Gate::denies('admin.user.list.delete')) {
            return redirect()->route('admin.dashboard')->with('danger', 'Unauthorized access attempt.');
        }

        $this->userService->delete((int)$id);

        return redirect()->route('admin.user.list.index')->with('success', 'User deleted successfully.');
    }
}
