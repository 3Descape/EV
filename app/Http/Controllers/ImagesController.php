<?php

namespace App\Http\Controllers;

use File;
use App\User;
use App\Event;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Helpers\StoreImage;

class ImagesController extends Controller
{
    public function pictures()
    {
        $this->authorize('can_access_pictures', User::class);

        return view('admin.sites.images.images');
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

    public function store(Request $request, $event_id)
    {
        $this->authorize('can_access_pictures', User::class);
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,JPG,PNG,JPEG',
        ]);

        $paths = $this->store_image($request, 'images/', true);
        if ($paths) {
            Event::find($event_id)->images()->create([
                'path' => $paths['main'],
                'thump' => $paths['thump'],
            ]);

            return response('Saved', 200);
        } else {
            return response('No a valid file', 501);
        }
    }

    public function destroy(Event $event, $image_id)
    {
        $this->authorize('can_access_pictures', User::class);
        $image = $event->images()->find($image_id);
        File::delete($image->path);
        $image->delete();

        return back();
    }
}
