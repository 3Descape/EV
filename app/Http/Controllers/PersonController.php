<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;

class PersonController extends Controller
{
    public function add($type = 'default')
    {
        return view('admin.sites.people.add',['selected' => $type]);
    }

    public function store(Request $request)
    {
        //TODO: Validation
        
        Person::create($request->all());
        if($request->category == '1')
            return redirect()->route('admin_people_frontend_sga');
        return redirect()->route('admin_people_frontend_ev');
    }
    public function edit(Person $person)
    {
        return view('admin.sites.people.edit', ['person' =>$person]);

    }

    public function update($person, Request $request)
    {
        Person::find($person)->update($request->all());
        if($request->category)
            return redirect()->route('admin_people_frontend_sga');
        return redirect()->route('admin_people_frontend_ev');
    }

    public function delete(Person $person)
    {
        Person::destroy($person->id);
        return back();
    }

}
