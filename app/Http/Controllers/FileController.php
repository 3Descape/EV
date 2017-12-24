<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\File;

class FileController extends Controller
{
	public function index(){
		$this->authorize('can_access_files', User::class);
		$files = File::all();
		return view('admin.sites.files.index', compact(
		            'files'
		        ));
	}
	
	public function store(Request $request){
		$data = $request->validate([
		            'name' => 'required|string|unique:files,name',
		            'description' => 'required|string',
		            'file' => 'required|file'
		        ]);
		
		$file = $request->file('file');
		if($file->isValid()){
			$path = Storage::disk('public')->putFileAs('files', $file, $data['name'].".".$file->getClientOriginalExtension(), 'public');
			File::create([
			                'name' => $data['name'],
			                'description' => $data['description'],
			                'path' => $path,
			                'size' => $file->getClientSize()
			            ]);
		}
		return response()->json(['status' => 'Datei wurde hinzugefügt'], 200);
	}
	
	public function delete(File $file)
	{
        Storage::disk('public')->delete($file->path);
        $file->delete();
        return back();
	}
}
