<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function edit_user_roles(User $user)
    {
        $this->authorize('can_access_roles', User::class);
        $roles = Role::whereNotIn('id', $user->roles()->pluck('id'))->get();
        return view('admin.sites.roles.edit', [
            'user' => $user->load('roles'),
            'roles' => $roles,
        ]);
    }

    public function detach_role(User $user, Role $role)
    {
        $this->authorize('can_access_roles', User::class);
        if($role->name == 'admin'){
            $count = $role->users()->count();
            if($count <= 1){
                return back()->with('exeption', 'Es muss immer mindestens ein Administrator bestehen. Bitte geben Sie mindestens einem anderen Nutzer zuerst diese Berechtigung, bevor Sie diese löschen.');
            }
        }
        $user->roles()->detach($role->id);
        return back();
    }

    public function user_roles_update(User $user, Request $request)
    {
        $this->authorize('can_access_roles', User::class);
        $user->roles()->save(Role::whereName($request->role)->first());
        return redirect()->route('admin_people_backend');
    }
}
