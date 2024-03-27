<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortenUrlRequest;
use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShortUrlController extends Controller
{
    public function edit(ShortenUrlRequest $request) {
        $validated = $request->validated();
        $user = Auth::getUser();

        ShortUrl::updateOrCreate(
            ['seller_id' => $user->id],
            ['short_url' => $validated['short_url']]
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
