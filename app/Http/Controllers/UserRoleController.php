<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function edit(User $user)
    {
        $this->authorize('can_access_user', User::class);
        $roles = Role::whereNotIn('id', $user->roles()->pluck('id'))->get();

        return view('admin.sites.roles.role_edit', [
            'user' => $user->load('roles'),
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('can_access_user', User::class);
        $user->roles()->save(Role::find($request->role));

        return redirect()->route('user_index');
    }

    public function destroy(User $user, Role $role)
    {
        $this->authorize('can_access_user', User::class);
        if ($role->name == Role::ADMIN_ROLE_NAME) {
            $count = $role->users()->count();
            if ($count <= 1) {
                return back()->with('exeption', 'Es muss immer <strong>mindestens ein Administrator bestehen </strong>. Bitte geben Sie mindestens einem anderen Nutzer zuerst diese Berechtigung, damit Sie die Berechtigung von diesem Nutzer löschen können.');
            }
        }
        $user->roles()->detach($role->id);

        return back();
    }
}
