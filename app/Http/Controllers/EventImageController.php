<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Helpers\StoreImage;

class EventImageController extends Controller
{
    public function store(Request $request, $event_id)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,JPG,PNG,JPEG',
        ]);

        if ($request->hasFile('file')) {
            $image = new StoreImage();
            $saved = $image->store($request->file, 'events/', true);
            Event::find($event_id)->images()->create([
                'path' => $saved->mainPath,
                'thump' => $saved->thumbnailPath,
            ]);

            return response('Saved', 200);
        } else {
            return response('No a valid file', 501);
        }
    }
}
