<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(ImageRequest $req, $folder = "", $name = "image")
    {
        if(!$req->hasFile('image')) return back();

        $file = $req->file('image');
        $extension = $file->getClientOriginalExtension(); // Get the original file extension
        $fileName = $folder . '/' . $name . '.' . $extension;

        $this->removeOldImage(Auth::user()->id);

        Storage::disk('public')->put($fileName, file_get_contents($file));


        return back();
    }

    private function removeOldImage($id)
    {
        $logos = Storage::disk('public')->files('logos');
        foreach ($logos as $key => $logo) {
            $fullName = File::basename($logo);

            $nameWithoutExtension = substr($fullName, 0, strrpos($fullName,'.'));

            if($nameWithoutExtension == $id) {
                Storage::disk('public')->delete('logos/' . $fullName);
                break;
            }
        }
    }
}
