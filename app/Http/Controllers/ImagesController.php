<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Image;
use App\Event;
use Illuminate\Http\Request;
use App\Text;

class ImagesController extends Controller
{


    public function pictures()
    {
        return view('admin.sites.images.images');
    }
    public function remove_group_image()
    {
        Text::find(1)->update([
            'html' => ''
        ]);
        session()->flash('group_image', 'Bild wurde entfernt.');
        return back();
    }

    public function remove_vorstand_image()
    {
        Text::find(2)->images()->delete();
        session()->flash('group_image', 'Bild wurde entfernt.');
        return back();
    }

    public function store(Request $request, $event_id)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,JPG,PNG,JPEG',
        ]);

        $paths = $this->store_image($request, 'images/', true);
        if($paths){
            Event::find($event_id)->images()->create([
                'path' => $paths['main'],
                'thump' => $paths['thump'],
            ]);
            return response('Saved', 200);
        }
        else{
            return response('No a valid file', 501);
        }
    }

    public function destroy(Event $event, $image_id)
    {
        $image = $event->images()->find($image_id);
        File::delete($image->path);
        $image->delete();
        return back();
    }

    public function uploud_group_image(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,JPG,PNG,JPEG',
        ]);

        $paths = $this->store_image($request, 'images/', true);
        if($paths){
            $text = Text::where('id', '1')->first();
            $text->images()->where('image_type', 'App\Text')->delete();
            $text->images()->create([
                'path' => $paths['main'],
                'thump' => $paths['thump'],
            ]);

            $text->update([
                'html' => "<div class=\"text-center\"><img src=\"". asset($paths['main']). "\" class=\"img-fluid\" style=\"max-height: 50vh\"></div>"
            ]);
            session()->flash('group_image', 'Bild wurde hinzugefügt.');
            return back();
        }else{
            return response('No a valid file', 501);
        }
    }

    public function uploud_vorstand_image(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,JPG,PNG,JPEG',
        ]);

        $paths = $this->store_image($request, 'images/');
        if($paths){
            $text = Text::where('id', '2')->first();
            $text->images()->where('image_type', 'App\Text')->delete();
            $text->images()->create([
                'path' => $paths['main'],
                'thump' => $paths['thump'],
            ]);
            session()->flash('group_image', 'Bild wurde hinzugefügt.');
            return back();
        }else{
            return response('No a valid file', 501);
        }

    }

    public function store_image(Request $request, $directory, $thump = false)
    {
        $image = $request->file('file');
        if ($image->isValid()) {
            $extention = '.jpeg';
            $name = time()."_" .pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $directory = $directory . "main/";
            if(!File::exists($directory)) {
                File::makeDirectory($directory, $mode = 0777, true, true);
            }
            $image = Image::make($image->getRealPath());
            $image_resize = $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($directory. $name.$extention, 50);
            if($thump){
                $thump_directory = $directory . "thump/";
                if(!File::exists($thump_directory)) {
                    File::makeDirectory($thump_directory, $mode = 0777, true, true);
                }
                $thump = $name . '_thump';
                $image_resize = $image->fit(150, 150)->save($thump_directory.$thump.$extention, 50);
                return ['main' => $directory. $name.$extention, 'thump' => $thump_directory.$thump.$extention];
            }

            return ['main' => $directory. $name.$extention, 'thump' => ''];
        }else{
            return [];
        }
    }
}
