<?php

namespace App\Http\Controllers;

use App\User;
use App\Person;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function people_frontend_sga()
    {
        $this->authorize('can_access_people', User::class);
        $sga = Person::SGAMitglieder()->get();
        return view('admin.sites.people.sga', [
            'sga' => $sga
        ]);
    }

    public function people_frontend_ev()
    {
        $this->authorize('can_access_people', User::class);
        $ev = Person::EVMitglieder()->get();
        return view('admin.sites.people.ev', [
            'ev' => $ev
        ]);
    }

    public function people_backend()
    {
        $this->authorize('can_access_people', User::class);
        $users = User::with('roles')->get();
        return view('admin.sites.people.backend', [
            'users' => $users
        ]);
    }
}
