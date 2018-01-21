<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('can_access_people', User::class);
        $users = User::with('roles')->get();

        return view('admin.sites.users.user_index', [
            'users' => $users
        ]);
    }

    public function user_delete($user)
    {
        $this->authorize('can_access_people', User::class);
        $admins = User::with('roles')->get()->filter(function ($user) {
            return $user->hasRole('administrator');
        });
        if ($admins->count() === 1) {
            return back()->with('exeption', 'Es muss immer mindestens ein Administrator bestehen. Bitte geben Sie mindestens einem anderen Nutzer zuerst diese Berechtigung, bevor Sie diesen löschen.');
        }
        User::destroy($user);

        return back();
    }
}
