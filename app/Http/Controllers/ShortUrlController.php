<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShortUrlController extends Controller
{
    public function edit(Request $request) {
        // Upsert the short URL, sellerId is the user ID wich is note in the request
        $user = Auth::getUser();

        $shortUrl = ShortUrl::updateOrCreate(
            ['seller_id' => $user->id],
            ['short_url' => $request->short_url]
        );

        return redirect('/account');
    }

    public function url($url) {
        $url = ShortUrl::all()->where('short_url', $url)->first();

        if($url && $url->seller_id) {
            return redirect('/seller/'.$url->seller_id);
        }

        return redirect('/');
    }
}
