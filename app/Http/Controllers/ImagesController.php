<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Image;
use App\Event;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function store(Request $request, $event_id)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,JPG,PNG,JPEG',
        ]);

        $image = $request->file('file');
        if ($image->isValid()) {
            $extention = '.jpeg';
            $name = time()."_" .pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $directory = 'events/pictures/';
            if(!File::exists($directory)) {
                File::makeDirectory($directory, $mode = 0777, true, true);
            }
            $image = Image::make($image->getRealPath());
            $image_resize = $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($directory. $name.$extention, 50);
            $thump_directory = 'events/thump/';
            if(!File::exists($thump_directory)) {
                File::makeDirectory($thump_directory, $mode = 0777, true, true);
            }
            $thump = $name . '_thump';
            $image_resize = $image->fit(150, 150)->save($thump_directory.$thump.$extention, 50);

            Event::find($event_id)->images()->create([
                'path' => $directory . $name. $extention,
                'thump' => $thump_directory . $thump. $extention,
            ]);
            return response('Saved', 200);
        }
        else{
            return response('No valid file', 501);
        }
    }

    public function destroy(Event $event, $image_id)
    {
        $image = $event->images()->find($image_id);
        File::delete($image->path);
        $image->delete();
        return back();
    }
}
