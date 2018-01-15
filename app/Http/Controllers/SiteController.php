<?php

namespace App\Http\Controllers;

use App\Site;
use App\User;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function about()
    {
        $this->authorize('can_access_sites', User::class);
        $texts = Site::where('category', '1')->with('images')->get();

        return view('admin.sites.sites.site_show', [
            'texts' => $texts,
        ]);
    }

    public function sga()
    {
        $this->authorize('can_access_sites', User::class);
        $texts = Site::where('category', '2')->get();

        return view('admin.sites.sites.site_show', [
            'texts' => $texts,
        ]);
    }

    public function info()
    {
        $this->authorize('can_access_sites', User::class);
        $texts = Site::where('category', '3')->get();

        return view('admin.sites.sites.site_show', [
            'texts' => $texts,
        ]);
    }

    public function imprint()
    {
        $this->authorize('can_access_sites', User::class);
        $texts = Site::where('category', '4')->get();

        return view('admin.sites.sites.site_show', [
            'texts' => $texts,
        ]);
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
}
