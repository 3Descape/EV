<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function add($type = 'default')
    {
        return view('admin.sites.people.add', [
            'selected' => $type
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'nullable',
            'category' => 'required'
        ]);

        Person::create($request->all());

        if($request->category == '1')
            return redirect()->route('admin_people_frontend_sga');
        return redirect()->route('admin_people_frontend_ev');
    }

    public function edit(Person $person)
    {
        return view('admin.sites.people.edit', ['person' =>$person]);
    }

    public function update(Person $person, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'nullable',
            'category' => 'required'
        ]);

        $person->update($request->all());
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
