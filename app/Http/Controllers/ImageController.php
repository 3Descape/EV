<?php

namespace App\Http\Controllers;

use File;
use App\User;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Helpers\StoreImage;

class ImageController extends Controller
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
        $this->authorize('can_access_pictures', User::class);
        $image->deleteImage();

        if (request()->expectsJson()) {
            return response()->json(['status' => 'Bild wurde gelöscht.'], 200);
        }

        return back();
    }
}
