<?php

namespace App\Http\Helpers;

use Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class StoreImage
{
    public $extention;
    public $mainPath;
    public $thumbnailPath;

    public function __construct()
    {
        $this->extention = '.jpeg';
    }

    public function store($file, $saveTo, $generateThumbnail)
    {
        $this->file = $file;
        $this->saveTo = $saveTo;
        $this->generateThumbnail = $generateThumbnail;
        if ($this->file->isValid()) {
            $image = $this->mainImage();
            $this->mainPath = $file->hashName($saveTo . 'main');
            Storage::disk('public')->put($this->mainPath, $image);

            if ($this->generateThumbnail) {
                $image = $this->thumbnail();
                $this->thumbnailPath = $file->hashName($saveTo . 'thumbnail');
                Storage::disk('public')->put($this->thumbnailPath, $image);
            }
        }

        return $this;
    }

    public function mainImage()
    {
        $image = Image::make($this->file->getRealPath());

        return $image->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpg', 50)->__toString();
    }

    public function thumbnail()
    {
        $image = Image::make($this->file->getRealPath());

        return $image->fit(150, 150)->encode('jpg', 50)->__toString();
    }

    public function generateHasName($file)
    {
        return md5($file . Carbon::now()->toAtomString());
    }
}
