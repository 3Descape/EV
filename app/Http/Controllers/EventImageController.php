<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Helpers\StoreImage;

class EventImageController extends Controller
{
    public function store(Request $request, Event $event)
    {
        \Log::info('storeImageEvent');
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,JPG,PNG,JPEG',
        ]);
        \Log::info('validate');
        if ($request->hasFile('file')) {
            \Log::info('valid file');
            $image = new StoreImage();
            $saved = $image->store($request->file, 'events/', true);
            \Log::info('create image in db');
            $image = $event->images()->create([
                'path' => $saved->mainPath,
                'thump' => $saved->thumbnailPath,
            ]);
            \Log::info('bevore response');

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'Bild wurde hinzugefügt.',
                    'image' => $image
            ], 200);
            } else {
                \Log::info('not json');

                return back();
            }
        } else {
            \Log::info('not a valid file');

            return response('No a valid file', 501);
        }
    }
}
