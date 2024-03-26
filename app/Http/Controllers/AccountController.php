<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::getUser();
        $favorites = $user->favorites()->get();

        // Loop through the favorites and get the ad
        foreach ($favorites as $favorite) {
            $favorite->ad = $favorite->advertisement;
        }

        $url = ShortUrl::all()->where('seller_id', Auth::getUser()->id)->first();

        if($url) {
            $url = $url->short_url;
        }

        $logos = Storage::disk('public')->files('logos');
        foreach ($logos as $key => $logo) {
            $fullName = File::basename($logo);

            $nameWithoutExtension = substr($fullName, 0, strrpos($fullName,'.'));

            if($nameWithoutExtension == $user->id) {
                $user->customLogo = Storage::url('logos/' . $fullName);
                break;
            }
        }

        return view('account')
            ->with('favoriteAds', $favorites)
            ->with('url', $url)
            ->with('logo', $user->customLogo);
    }
}
