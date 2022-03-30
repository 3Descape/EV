<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $this->authorize('can_access_files', User::class);
        $files = File::all();
        $images = Image::all();

        return view('admin.sites.files.file_index', compact(
            'files',
            'images'
        ));
    }

    public function store(Request $request)
    {
        $this->authorize('can_access_files', User::class);
        $request->validate([
            'name' => 'required|string|unique:files,name',
            'file' => 'required|file'
        ]);

        $file = $request->file('file');
        if ($file->isValid()) {
            $path = Storage::disk('public')->putFileAs('files', $file, $request->name . '.' . $file->getClientOriginalExtension(), 'public');
            $file = File::create([
                'name' => $request->name,
                'html' => $request->html,
                'markup' => $request->markup,
                'path' => $path,
                'size' => $file->getClientSize()
            ]);

            return response()->json([
                'status' => 'Datei wurde hinzugefügt',
                'file' => $file
            ], 200);
        }
    }

    public function edit(File $file)
    {
        $this->authorize('can_access_files', User::class);

        return view('admin.sites.files.file_edit', [
            'file' => $file,
            'images' => Image::all()
        ]);
    }

    public function update(Request $request, File $file)
    {
        $this->authorize('can_access_files', User::class);
        $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('files')->ignore($file->name, 'name')
            ]
        ]);

        $file->update([
            'name' => $request->name,
            'html' => $request->html,
            'markup' => $request->markup,
        ]);

        return response()->json(['msg' => 'Änderungen wurden gespeichert.'], 200);
    }

    public function delete(File $file)
    {
        $this->authorize('can_access_files', User::class);
        Storage::disk('public')->delete($file->path);
        $file->delete();

        return response()->json(['status' => 'Datei wurde gelöscht.'], 200);
    }
}
