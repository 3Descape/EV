<?php

namespace App\Providers;

use App\Models\Person;
use Illuminate\Support\ServiceProvider;
use Tiptap\Editor;

class TiptapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(Editor::class, function($app) {
           return new Editor([
                'extensions' => [
                    // Starter Kit
                    new \Tiptap\Nodes\Blockquote([
                        'HTMLAttributes' => [
                            'class' => 'blockquote border-start border-3 ps-2',
                        ],
                    ]),
                    new \Tiptap\Nodes\BulletList,
                    new \Tiptap\Nodes\CodeBlock([
                        'HTMLAttributes' => [
                            'class' => 'bg-light rounded p-2 my-2 font-monospace lh-lg text-danger',
                        ],
                    ]),
                    new \Tiptap\Nodes\Document,
                    new \Tiptap\Nodes\HardBreak,
                    new \Tiptap\Nodes\Heading,
                    new \Tiptap\Nodes\HorizontalRule,
                    new \Tiptap\Nodes\ListItem,
                    new \Tiptap\Nodes\OrderedList,
                    new \Tiptap\Nodes\Paragraph,
                    new \Tiptap\Nodes\Text,
                    new \Tiptap\Marks\Bold,
                    new \Tiptap\Marks\Code,
                    new \Tiptap\Marks\Italic,
                    new \Tiptap\Marks\Strike,


                    new \App\Tiptap\TextAlign,
                    new \Tiptap\Marks\Link,
                    new \Tiptap\Marks\Underline,
                    new \Tiptap\Nodes\Table([
                        'HTMLAttributes' => [
                            'class' => 'table table-bordered',
                        ],
                    ]),
                    new \Tiptap\Nodes\TableRow,
                    new \Tiptap\Nodes\TableCell,
                    new \Tiptap\Nodes\TableHeader,
                    new \App\Tiptap\Image([
                        'HTMLAttributes' => [
                            'class' => 'img-fluid',
                        ],
                    ]),
                    new \App\Tiptap\PersonNode([
                        'people' => Person::with('category')->get()->keyBy('id'),
                    ]),
                ]
            ]);
       });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
