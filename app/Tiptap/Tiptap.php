<?php

namespace App\Tiptap;

use Exception;

trait Tiptap
{
    function safeEncodeMarkup($value)
    {
        $content = json_decode(stripcslashes(trim($value,'"')), true);

        if(!$content)
        {
            return [$value, false];
        }

        return [$content, true];
    }

    function toHtml($value)
    {
        [$content, $isJson] = $this->safeEncodeMarkup($value);

        if($isJson)
        {
            return app()->make(\Tiptap\Editor::class)->setContent($content)->getHTML();
        }

        return $content;
    }

    public function getMarkupAttribute($value)
    {
        return $this->safeEncodeMarkup($value)[0];
    }

    public function getRawMarkupAttribute()
    {
        return $this->getRawOriginal('markup');
    }
}