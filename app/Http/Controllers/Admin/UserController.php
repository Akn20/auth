<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('status', true)->get();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'mobile' => 'nullable|string|max:10',
        ]);

        User::create($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::where('status', true)->get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    public function deleted()
    {
        $users = User::onlyTrashed()
            ->with('role')
            ->latest()
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function restore($id)
    {
        User::withTrashed()->where('id', $id)->restore();

        return redirect()
            ->route('admin.users.deleted')
            ->with('success', 'User Restored Successfully.');
    }
}
