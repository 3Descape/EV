<?php

namespace App\Http\Controllers;

use App\Site;
use App\User;
use Illuminate\Http\Request;
use App\SiteCategory;
use App\Image;

class SiteController extends Controller
{
    public function edit(SiteCategory $site_category)
    {
        $this->authorize('can_access_sites', User::class);
        $sites = $site_category->sites()->get();
        $images = Image::all();
        return view('admin.sites.sites.site_edit', compact(
            'site_category',
            'sites',
            'images'
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

    public function update_body(Request $request, Site $site)
    {
        $this->authorize('can_access_sites', User::class);
        $site->update([
            'html' => $request->compiledData,
            'markup' => $request->rawData
        ]);

        return response()->json(['status' => 'Updated body'], 200);
    }

    public function update_title(Request $request, Site $site)
    {
        $this->authorize('can_access_sites', User::class);
        $site->update([
            'title' => $request->title,
        ]);

        return response()->json(['status' => 'Updated title'], 200);
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
        return response()->json(['status' => 'Wurde gelöscht.']);
    }
}
