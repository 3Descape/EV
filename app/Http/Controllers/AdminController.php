<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Person;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.sites.home');
    }
    public function about()
    {
        return view('admin.sites.about');
    }
    public function events()
    {
        return view('admin.sites.events')->with('events',Event::all()->toJson());
    }
    public function events_json()
    {
        return response()->json(Event::all());
    }

    public function events_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:255',
            'date' => 'required|date',
            'text' => 'required|max:255',
        ]);

        Event::create($request->all());
        return back();
    }
    public function event_delete($id){
        Event::where('id','=', $id)->delete();
    }
    public function sga()
    {
        return view('admin.sites.sga');
    }
    public function info()
    {
        return view('admin.sites.info');
    }

    public function personen_frontend()
    {
        $sga = Person::SGAMitglieder()->get();
        $ev = Person::EVMitglieder()->get();
        return view('admin.sites.people.frontend', ['sga' => $sga, 'ev' => $ev]);
    }

    public function personen_backend()
    {
        $users = User::all();
        return view('admin.sites.people.backend', ['users' => $users]);
    }

    public function user_role(User $user)
    {
        return view('admin.sites.people.user_edit', ['user' => $user]);
    }

    public function user_role_update($user, Request $request)
    {
        User::find($user)->update(['role' => $request['role']]);
        return redirect()->route('admin_people_backend');
    }

    public function user_delete($user)
    {
        User::destroy($user);
        return back();
    }

    public function test()
    {
        $this->authorize('is_admin', User::class);
        return \App\Role::firstOrFail();

    }
}
