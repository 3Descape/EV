<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Models\Image;
use App\Models\Person;
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
        $peopleGroup = Person::with('category')->orderBy('name')->get()->groupBy('category.name');

        return view('admin.sites.files.file_index', compact(
            'files',
            'images',
            'peopleGroup',
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
            $new_file = File::create([
                'name' => $request->name,
                'markup' => $request->markup,
                'path' => $path,
                'size' => $file->getSize()
            ]);

            return response()->json([
                'status' => 'Datei wurde hinzugefügt',
                'file' => $new_file,
            ], 200);
        }
    }

    public function edit(File $file)
    {
        $this->authorize('can_access_files', User::class);

        $peopleGroup = Person::with('category')->orderBy('name')->get()->groupBy('category.name');

        return view('admin.sites.files.file_edit', [
            'file' => $file,
            'images' => Image::all(),
            'peopleGroupProp' => $peopleGroup,
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
