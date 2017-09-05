<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('can_access_events', User::class);
        $categories = Category::all();

        return view('admin.sites.categories.categories_index',[
            'categories' => $categories,
        ]);
    }

    public function pre_delete($id)
    {
        $this->authorize('can_access_events', User::class);
        $category = Category::find($id);
        $events = $category->events()->get();
        if($events->count() == 0){
            return redirect()->route('admin_categories');
        }
        $categories = Category::where('id', '!=', $id)->get();
        return view('admin.sites.categories.categories_pre_delete', [
            'events' => $events,
            'categories' => $categories,
            'category' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('can_access_events', User::class);
        $this->validate($request, [
            'name' => 'required|max:30|unique:categories,name'
        ]);

        $test = Category::create([
            'name' => $request->name
        ]);

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('can_access_events', User::class);
        $category = Category::find($id);
        return view('admin.sites.categories.categories_edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('can_access_events', User::class);
        $this->validate($request, [
            'name' => 'required|max:30|unique:categories,name,'. $id
        ]);

        Category::find($id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin_categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('can_access_events', User::class);
        $category = Category::find($id);
        if($category->events()->count() != 0)
        {
            return redirect()->route('adming_categories_pre_delete', $category->id);
        }
        Category::destroy($id);
        return back();
    }
}
