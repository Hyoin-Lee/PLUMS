<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display users
     * @return View | RedirectResponse
     */
    public function index(Request $request): View | RedirectResponse {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('view users')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view users.');
        }

        $query = $request->input('query');
        $users = User::query()
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('first_name', 'like', '%' . $query . '%')
                    ->orWhere('last_name', 'like', '%' . $query . '%');
            })
            ->paginate(10);
        $trashedCount = User::onlyTrashed()->count();
        return view('users.index', compact('users', 'trashedCount'));
    }

    /**
     * Display create user form
     * @return View
     */
    public function create(): View {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('create users')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to create users.');
        }

        return view('users.create');
    }

    /**
     * Stores newly created user in database
     */
    public function store(StoreUserRequest $request) {
        $validated = $request->validated();
        $roleToAssign = $request->input('role');
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('create users')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to create users.');
        }

        $user = User::create([
            'name' => $validated->input('name'),
            'email' => $validated->input('email'),
            'password' => bcrypt($validated->input('password')),
        ]);

        $user->assignRole($roleToAssign);
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show($id): View | RedirectResponse
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('view users')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to view users.');
        }

        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit(User $user): View | RedirectResponse
    {
        $admin = auth('sanctum')->user();

        if (!$admin->hasPermissionTo('edit users')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to edit users.');
        }

        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
        $admin = auth('sanctum')->user();
        $password = $validated['password'] ?? null;

        if (!$admin->hasPermissionTo('edit users')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to edit users.');
        }

        unset($validated['password']);
        $user->update($validated);

        if ($password) {
            $user->update([
                'password' => bcrypt($password),
            ]);
        }

        if ($validated['role'] && $admin->hasPermissionTo('edit users')) {
            $user->syncRoles([$validated['role']]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function delete(User $user): View
    {
        $admin = auth('sanctum')->user();

        if (!$admin->hasPermissionTo('delete users')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to delete users.');
        }

        return view('users.delete', compact('user'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $admin = auth('sanctum')->user();

        if (!$admin->hasPermissionTo('delete users')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to delete users.');
        }

        $user->delete();
        return redirect()->route('users.index')->withSucess("Deleted {$user->name}.");
    }

    public function trash(): View
    {
        $users = User::onlyTrashed()->orderBy('deleted_at')->paginate(5);
        return view('users.trash', compact(['users']));
    }

    public function restore($user): RedirectResponse
    {
        $user = User::onlyTrashed()->findOrFail($user);
        $user->restore();
        return redirect()->back()->with('success', "Restored {$user->name}.");
    }

    public function remove($user): RedirectResponse
    {
        $user = User::withTrashed()->findOrFail($user);
        $user->forceDelete();
        return redirect()->route('users.trash')
            ->with('success', 'User permanently deleted.');
    }

    public function restoreAll(): RedirectResponse
    {
        $users = User::onlyTrashed()->get();
        $trashCount = $users->count();

        foreach ($users as $user) {
            $user->restore(); // This restores the soft-deleted user
        }
        return redirect(route('users.trash'))
            ->with('success', "Successfully recovered {$trashCount} user(s).");
    }

    public function empty(): RedirectResponse
    {
        $users = User::onlyTrashed()->get();
        $trashCount = $users->count();
        foreach ($users as $user) {
            $user->forceDelete(); // This restores the soft-deleted user
        }
        return redirect(route('users.trash'))
            ->with('success', "Successfully deleted {$trashCount} user(s) .");
    }
}
