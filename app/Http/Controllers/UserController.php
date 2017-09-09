<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user_delete($user)
    {
        $this->authorize('can_access_people', User::class);
        User::destroy($user);
        return back();
    }
}
