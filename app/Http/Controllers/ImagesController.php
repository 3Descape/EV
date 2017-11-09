<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Text;
use App\Traits\StoreImageTrait;
use App\User;
use File;
class ImagesController extends Controller
{
    use StoreImageTrait;

    public function pictures()
    {
        $this->authorize('can_access_pictures', User::class);
        return view('admin.sites.images.images');
    }

    public function remove_group_image()
    {
        $this->authorize('can_access_pictures', User::class);
        Text::find(1)->update([
            'html' => ''
        ]);
        session()->flash('group_image', 'Bild wurde entfernt.');
        return back();
    }

    public function remove_vorstand_image()
    {
        $this->authorize('can_access_pictures', User::class);
        Text::find(2)->images()->delete();
        session()->flash('group_image', 'Bild wurde entfernt.');
        return back();
    }

    public function store(Request $request, $event_id)
    {
        $this->authorize('can_access_pictures', User::class);
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
        $this->authorize('can_access_pictures', User::class);
        $image = $event->images()->find($image_id);
        File::delete($image->path);
        $image->delete();
        return back();
    }

    public function uploud_group_image(Request $request)
    {
        $this->authorize('can_access_pictures', User::class);
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
        $this->authorize('can_access_pictures', User::class);
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
}
