<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;
use App\Traits\StoreImageTrait;
class PersonController extends Controller
{
    use StoreImageTrait;
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

        $paths = ['main' => Null, 'thump' => Null];
        if($request->file('file')){
            $paths = $this->store_image($request, 'images/sga', true);
        }

        Person::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'image_path' => $paths['main'],
            'thump_path' => $paths['thump']
        ]);

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
            'category' => 'required',
        ]);
        $paths = ['main' => '', 'thump' => ''];
        if($request->file('file')){
            $paths = $this->store_image($request, 'images/sga', true);
        }

        $person->update([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'image_path' => $paths['main'] ? $paths['main'] : $person->image_path,
            'thump_path' => $paths['thump'] ? $paths['thump'] : $person->thump_path
        ]);

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
