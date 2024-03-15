<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SellerController extends Controller
{
    public function show($userId)
    {
        // Get the user by ID with their associated customer and advertisements
        $user = User::with('customer', 'advertisements')->findOrFail($userId);

        $logos = Storage::disk('public')->files('logos');
        foreach ($logos as $key => $logo) {
            $fullName = File::basename($logo);

            $nameWithoutExtension = substr($fullName, 0, strrpos($fullName,'.'));

            if($nameWithoutExtension == $user->id) {
                $user->customLogo = Storage::url('logos/' . $fullName);
                break;
            }
        }

        return view('sellerprofile', compact('user'));
    }
}


