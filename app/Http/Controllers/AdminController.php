<?php

namespace App\Http\Controllers;

use App\User;
//use App\Person;
use App\PeopleCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use File;

class AdminController extends Controller
{
    public function people_backend()
    {
        $this->authorize('can_access_people', User::class);
        $users = User::with('roles')->get();
        return view('admin.sites.people.backend', [
            'users' => $users
        ]);
    }

    public function people_commitee(){
        return view();
    }
}
