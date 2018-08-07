<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('can_access_user', User::class);
        $users = User::with('roles')->get();

        return view('admin.sites.users.user_index', [
            'users' => $users
        ]);
    }

    public function user_delete(User $user)
    {
        $this->authorize('can_access_user', User::class);
        $admins = User::with('roles')->get()->filter(function ($user) {
            return $user->isAdmin();
        });
        if ($admins->count() === 1 && $user->isAdmin()) {
            return back()->with('exeption', $user->admin_delte_exception);
        }

        $user->delete();

        return back();
    }
}
