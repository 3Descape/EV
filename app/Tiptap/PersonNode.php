<?php

namespace App\Tiptap;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class PersonNode extends Node
{
    public static $name = 'personnode';

    public function addOptions()
    {
        return [
            'people' => [],
            'HTMLAttributes' => [],
        ];
    }

    // public function parseHTML()
    // {
    //     return array_map(function ($level) {
    //         return [
    //             'tag' => "h{$level}",
    //             'attrs' => [
    //                 'level' => $level,
    //             ],
    //         ];
    //     }, $this->options['levels']);
    // }

    // public function addAttributes()
    // {
    //     return [
    //         ':person' => $this->options['people'][$node->attrs->personId],
    //     ];
    // }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        $attrs = HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes);
        $attrs[':person'] = $this->options['people'][$node->attrs->personId]->toJson();
        return [
            "person",
            $attrs,
            0,
        ];
    }
}
