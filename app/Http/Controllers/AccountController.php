<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites()->get();

        // Loop through the favorites and get the ad
        foreach ($favorites as $favorite) {
            $favorite->ad = $favorite->advertisment;
        }

        return view('account')
            ->with('favoriteAds', $favorites);
    }
}
