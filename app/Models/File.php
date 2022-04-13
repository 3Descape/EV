<?php

namespace App\Models;

use App\Tiptap\Tiptap;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory, Tiptap;

    protected $fillable = [
        'name',
        'markup',
        'size',
        'path',
    ];

    protected $appends = [
        'description'
    ];

    public function getDescriptionAttribute()
    {
        return $this->toHtml($this->raw_markup);
    }
}
