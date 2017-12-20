<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user_delete($user)
    {
        $this->authorize('can_access_people', User::class);
        $admins = User::with('roles')->get()->filter(function($user){
            return $user->hasRole('administrator');
        });
        if($admins->count()===1){
            return back()->with('exeption', 'Es muss immer mindestens ein Administrator bestehen. Sie müssen zuerst einen anderen Benutzer diese Berechtigung geben, bevor Sie diesen löschen können.');
        }
        User::destroy($user);
        return back();
    }
}
