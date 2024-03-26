<?php

namespace App\enum;

use Illuminate\Support\Facades\Lang;

enum ComponentType : string
{
    case TEXT = "text-component";
    case IMAGE = "image-component";

    public function getLabel(): string
    {
        // Get translation from lang/en/editor.php
        return Lang::get("editor.{$this->value}");
    }
}
