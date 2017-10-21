<?php
namespace App\Traits;
use Illuminate\Http\Request;
use File;
use Image;
trait StoreImageTrait{
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
