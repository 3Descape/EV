<?php
namespace App\Htttp\Helpers;
use Illumminate\Http\Request;
use Image;
use Storage;
use Illuminate\Support\Carbon;

class StoreImage{
    protected $file;
    protected $saveTo;
    protected $generateThumbnail;
    public $extention;
    public $mainPath;
    public $thumbnailPath;

    public function __construct(){
        $this->extention = ".jpeg";
    }
    public function store($file, $saveTo, $generateThumbnail){
        $this->file = $file;
        $this->saveTo = $saveTo;
        $this->generateThumbnail = $generateThumbnail;
        if($this->file->isValid()){
            $image = $this->mainImage();
            $path = $this->saveTo . '/main/' . $this->generateHasName($image). '.jpg';
            $this->mainPath = Storage::disk('public')->put($path, $image, 'public');

            if($this->generateThumbnail){
                $image = $this->thumbnail();
                $path = $this->saveTo . '/thumbnail/' . $this->generateHasName($image). '.jpg';
                $this->thumbnailPath = Storage::disk('public')->put($path, $image, 'public');
            }
        }
        return $this;
    }

    public function mainImage(){
        $image = Image::make($this->file->getRealPath());
        return $image->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpg' , 50)->__toString();
    }

    public function thumbnail(){
        $image = Image::make($this->file->getRealPath());
        return $image->fit(150, 150)->encode('jpg' , 50)->__toString();
    }

    public function generateHasName($file){
        return md5($file . Carbon::now()->toAtomString());
    }
}