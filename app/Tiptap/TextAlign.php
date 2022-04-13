<?php

namespace App\Tiptap;

use Tiptap\Core\Extension;

class TextAlign extends Extension
{
    public static $name = 'textAlign';

    public function addOptions()
    {
        return [
            'types' => ['heading', 'paragraph'],
            'alignments' => ['text-start', 'text-center', 'text-end'],
            'defaultAlignment' => 'text-start'
        ];
    }

    public function addGlobalAttributes()
    {
        return [
            [
              'types' => $this->options['types'],
              'attributes' => [
                'textAlign' => [
                    'default' => $this->options['defaultAlignment'],
                    // 'parseHTML' => function ($DOMNode) {
                    //     dd($DOMNode->getAttribute('class'));
                    //     return $DOMNode->hasAttribute('class') ?? $this->options['defaultAlignment'];
                    // },
                    'renderHTML' => function ($attributes) {
                        // if ($attributes->textAlign === $this->options['defaultAlignment']) {
                        //     return null;
                        // }

                        return ['class' => "{$attributes->textAlign}"];
                    },
                ],
              ],
            ],
        ];
    }
}