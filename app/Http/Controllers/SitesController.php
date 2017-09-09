<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Text;
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

    public function edit($id)
    {
        $text = Text::find($id);
        //dd($text->formattedText());
        return view('admin.sites.texts_edit',[
            'text' => $text
        ]);
    }

    public function update(Request $request, $text_id)
    {
        Text::find($text_id)->update([
            'title' => $request->title,
            'text' => $request->text
        ]);

        return redirect()->route('admin_about');
    }
}