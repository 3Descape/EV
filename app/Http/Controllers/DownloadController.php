<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;

class DownloadController extends Controller
{
    public function index(){
        $files = File::all();
        return view('sites.download', compact(
            'files'
        ));
    }

    public function file_download(File $file)
    {
        $path = storage_path($file->path);

        return response()->download('storage/'.$file->path);
    }
}
