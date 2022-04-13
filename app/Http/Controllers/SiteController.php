<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Models\Image;
use App\Models\Person;
use App\Models\PersonCategory;
use App\Models\SiteCategory;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function edit(SiteCategory $site_category)
    {
        $this->authorize('can_access_sites', User::class);
        $sites = $site_category->sites()->get();
        $images = Image::all();
        $peopleGroup = Person::with('category')->orderBy('name')->get()->groupBy('category.name');
        return view('admin.sites.sites.site_edit', compact(
            'site_category',
            'sites',
            'images',
            'peopleGroup',
        ));
    }

    public function store(Request $request)
    {
        $this->authorize('can_access_sites', User::class);
        $request->validate([
            'title' => 'required|string',
            'site_category_id' => 'required|exists:site_categories,id',
            'order' => 'numeric'
        ]);

        $site = Site::create([
            'title' => $request->title,
            'site_category_id' => $request->site_category_id,
            'order' => $request->order
        ]);

        return response()->json(['status' => 'Wurde hinzugefügt', 'site' => $site], 200);
    }

    public function update(Request $request, Site $site)
    {
        $this->authorize('can_access_sites', User::class);

        $request->validate([
            'title' => 'required|string',
            'markup' => 'required|min:1'
        ]);

        $site->update([
            'title' => $request->title,
            'markup' => $request->markup
        ]);

        return response()->json(['status' => 'Gespeichert'], 200);
    }

    public function update_order(Request $request)
    {
        $this->authorize('can_access_sites', User::class);
        foreach ($request->sites as $site) {
            Site::find($site['id'])->update([
                'order' => $site['order']
            ]);
        }

        return response()->json(['status' => 'Reihenfolge wurde gespeichert.']);
    }

    public function destroy(Site $site)
    {
        $this->authorize('can_access_sites', User::class);
        $site->delete();

        return response()->json(['status' => 'Seite wurde gelöscht.']);
    }
}
