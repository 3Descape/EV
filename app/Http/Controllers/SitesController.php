<?php

namespace App\Http\Controllers;

use App\Text;
use Illuminate\Http\Request;

class SitesController extends Controller
{
    public function about()
    {
        $texts = Text::where('category', '1')->get();
        return view('admin.sites.texts_show', [
            'texts' => $texts,
        ]);
    }

    public function sga()
    {
        $texts = Text::where('category', '2')->get();
        return view('admin.sites.texts_show', [
            'texts' => $texts,
        ]);
    }

    public function info()
    {
        $texts = Text::where('category', '3')->get();
        return view('admin.sites.texts_show', [
            'texts' => $texts,
        ]);
    }

    public function imprint()
    {
        $texts = Text::where('category', '4')->get();
        return view('admin.sites.texts_show', [
            'texts' => $texts,
        ]);
    }

    public function update_body(Request $request, Text  $site)
    {
        $site->update([
            'html' => $request->compiledData,
            'markup' => $request->rawData
        ]);
        return response()->json(['status' => 'Updated body'], 200);
    }

    public function update_title(Request $request, Text  $site)
    {
        $site->update([
            'title' => $request->title,
        ]);
        return response()->json(['status' => 'Updated title'], 200);
    }
}
