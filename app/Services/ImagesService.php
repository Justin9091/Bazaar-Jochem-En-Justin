<?php

namespace App\Services;

use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImagesService
{
    public function store($file, $folder = "", $name = "image")
    {
        $extension = $file->getClientOriginalExtension(); // Get the original file extension
        $fileName = $folder . '/' . $name . '.' . $extension;

        $this->removeOldImage($name);

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
