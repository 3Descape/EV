<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Helpers\StoreImage;

class EventImageController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $this->authorize('can_access_events', User::class);
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,JPG,PNG,JPEG',
        ]);
        if ($request->hasFile('file')) {
            $image = new StoreImage();
            $saved = $image->store($request->file, 'events/', true);
            $image = $event->images()->create([
                'path' => $saved->mainPath,
                'thump' => $saved->thumbnailPath,
            ]);

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'Bild wurde hinzugefügt.',
                    'image' => $image
            ], 200);
            } else {
                return back();
            }
        } else {
            return response('No a valid file', 501);
        }
    }
}
