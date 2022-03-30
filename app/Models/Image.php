<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'thump',
        'name',
        'description',
    ];

    public function image()
    {
        return $this->morphTo();
    }

    public function deleteImage()
    {
        Storage::disk('public')->delete($this->path);
        if ($this->hasThumbnail()) {
            Storage::disk('public')->delete($this->thump);
        }
        $this->delete();
    }

    public function hasThumbnail()
    {
        return !!$this->thump;
    }
}
