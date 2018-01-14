<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function edit(User $user)
    {
        $this->authorize('can_access_roles', User::class);
        $roles = Role::whereNotIn('id', $user->roles()->pluck('id'))->get();

        return view('admin.sites.roles.role_edit', [
            'user' => $user->load('roles'),
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('can_access_roles', User::class);
        $user->roles()->save(Role::find($request->role));

        return redirect()->route('user_index');
    }

    public function destroy(User $user, Role $role)
    {
        $this->authorize('can_access_roles', User::class);
        if ($role->name == 'administrator') {
            $count = $role->users()->count();
            if ($count <= 1) {
                return back()->with('exeption', 'Es muss immer mindestens ein Administrator bestehen. Bitte geben Sie mindestens einem anderen Nutzer zuerst diese Berechtigung, bevor Sie diese löschen.');
            }
        }
        $user->roles()->detach($role->id);

        return back();
    }
}
