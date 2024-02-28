<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(ImageRequest $req, $folder = "", $name = "image")
    {
        if(!$req->hasFile('image')) return back();

        $file = $req->file('image');
        $extension = $file->getClientOriginalExtension(); // Get the original file extension
        $fileName = $folder . '/' . $name . '.' . $extension;

        if(Storage::disk('public')->exists($fileName)) {
            Storage::disk('public')->delete($fileName);
        }

        Storage::disk('public')->put($fileName, file_get_contents($file));


        return back();
    }
}
