<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites()->get();

        // Loop through the favorites and get the ad
        foreach ($favorites as $favorite) {
            $favorite->ad = $favorite->advertisment;
        }

        $url = ShortUrl::all()->where('seller_id', Auth::getUser()->id)->first();

        if($url) {
            $url = $url->short_url;
        }

        return view('account')
            ->with('favoriteAds', $favorites)
            ->with('url', $url);
    }
}
