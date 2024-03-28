<?php

namespace App\enum;

use App\Models\Component;
use Illuminate\Support\Facades\Lang;

enum ComponentType : string
{
    case TEXT = "text-component";
    case IMAGE = "image-component";

    public function getLabel(): string
    {
        return Lang::get("editor.{$this->value}");
    }
}
