<?php

namespace App\Http\Controllers;

use App\Site;
use Illuminate\Http\Request;

class SitesController extends Controller
{
    public function about()
    {
        $texts = Site::where('category', '1')->with('images')->get();

        return view('admin.sites.texts_show', [
            'texts' => $texts,
        ]);
    }

    public function sga()
    {
        $texts = Site::where('category', '2')->get();

        return view('admin.sites.texts_show', [
            'texts' => $texts,
        ]);
    }

    public function info()
    {
        $texts = Site::where('category', '3')->get();

        return view('admin.sites.texts_show', [
            'texts' => $texts,
        ]);
    }

    public function imprint()
    {
        $texts = Site::where('category', '4')->get();

        return view('admin.sites.texts_show', [
            'texts' => $texts,
        ]);
    }

    public function update_body(Request $request, Site $site)
    {
        $site->update([
            'html' => $request->compiledData,
            'markup' => $request->rawData
        ]);

        return response()->json(['status' => 'Updated body'], 200);
    }

    public function update_title(Request $request, Site $site)
    {
        $site->update([
            'title' => $request->title,
        ]);

        return response()->json(['status' => 'Updated title'], 200);
    }
}
