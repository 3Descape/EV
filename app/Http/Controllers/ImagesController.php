<?php

namespace App\Http\Controllers;

use File;
use App\User;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Helpers\StoreImage;

class ImagesController extends Controller
{
    public function index()
    {
        $this->authorize('can_access_pictures', User::class);
        $images = Image::all();

        return view('admin.sites.images.images', compact(
            'images'
        ));
    }

    public function getImage(Image $image)
    {
        return response()->json(['path' => $image->path], 200);
    }

    public function uploud_group_image(Request $request)
    {
        $this->authorize('can_access_pictures', User::class);
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,JPG,PNG,JPEG',
        ]);

        if ($request->hasFile('file')) {
            $image = new StoreImage();
            $saved = $image->store($request->file, 'images/', false);

            if ($image = Image::where('name', 'gruppenbild')->first()) {
                $image->update([
                    'path' => $saved->mainPath
                ]);
            } else {
                Image::create([
                    'path' => $saved->mainPath,
                    'name' => 'gruppenbild'
                ]);
            }

            return back()->with('info', 'Das Bild wurde hinzugefügt.');
        }

        return back()->with(['info' => 'Das Bild konnte nicht aktualisiert werden.', 'type' => 'danger']);
    }

    public function remove_group_image()
    {
        $this->authorize('can_access_pictures', User::class);
        Image::where('name', 'gruppenbild')->delete();
        session()->flash('info', 'Bild wurde entfernt.');

        return back();
    }

    public function store(Request $request)
    {
        $this->authorize('can_access_pictures', User::class);
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,JPG,PNG,JPEG',
            'name' => 'string|nullable',
            'description' => 'string|nullable'
        ]);

        if ($request->hasFile('file')) {
            $image = new StoreImage();
            $saved = $image->store($request->file, 'images/', true);

            $image = Image::create([
                'path' => $saved->mainPath,
                'thump' => $saved->thumbnailPath,
                'name' => $request->name ?: '',
                'description' => $request->description ?: ''
            ]);

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'Bild wurde hinzugefügt.',
                    'image' => $image
            ], 200);
            }

            return back();
        } else {
            return response()->with(['status' => 'Ungültige Datei.']);
        }
    }

    public function destroy(Image $image)
    {
        $image->deleteImage();

        if (request()->expectsJson()) {
            return response()->json(['status' => 'Bild wurde gelöscht.'], 200);
        }

        return back();
    }
}
