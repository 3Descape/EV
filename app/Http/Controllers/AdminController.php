<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Person;
use App\User;
use App\Role;

class AdminController extends Controller
{
    public function index()
    {
        $this->authorize('can_access_dashboard', User::class);
        return view('admin.sites.home');
    }

    public function personen_frontend_sga()
    {
        $this->authorize('can_access_people', User::class);
        $sga = Person::SGAMitglieder()->get();
        return view('admin.sites.people.sga', ['sga' => $sga]);
    }

    public function personen_frontend_ev()
    {
        $this->authorize('can_access_people', User::class);
        $ev = Person::EVMitglieder()->get();
        return view('admin.sites.people.ev', ['ev' => $ev]);
    }

    public function personen_backend()
    {
        $this->authorize('can_access_people', User::class);
        $users = User::with('roles')->get();
        return view('admin.sites.people.backend', ['users' => $users]);
    }

    public function user_role(User $user)
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
                return back()->with('exeption', 'Es muss immer mindestens ein Administrator bestehen. Bitte geben Sie mindestens einem anderen Nutzer zuerst diese Berechtigung, bevor Sie diese löschen können.');
            }
        }
        $user->roles()->detach($role->id);
        return back();
    }

    public function user_role_update(User $user, Request $request)
    {
        $this->authorize('can_access_roles', User::class);
        $user->roles()->save(Role::whereName($request->role)->first());
        return redirect()->route('admin_people_backend');
    }

    public function user_delete($user)
    {
        $this->authorize('can_access_people', User::class);
        User::destroy($user);
        return back();
    }
}
