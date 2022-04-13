<?php

namespace App\Tiptap;

use Tiptap\Nodes\Image as TiptapImage;

class Image extends TiptapImage
{
    public function addAttributes()
    {
        return array_merge(
            parent::addAttributes(),
            ['size' => [
                'default' => 50,
                'renderHTML' => fn ($attributes) => [
                    'style' => $attributes->size ? "max-width: {$attributes->size}%" : null,
                ],
            ]
        ]);
    }
}