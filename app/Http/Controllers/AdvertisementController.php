<?php

namespace App\Http\Controllers;

use App\Models\advertisement\Advertisement;
use App\Models\advertisement\RentAdvertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertisementController extends Controller
{
    function show(int $id)
    {
        $ad = Advertisement::find($id);
        $related = $ad->relatedAds()->get();

        return view('advertisement')
            ->with('ad', $ad)
            ->with('relatedAds', $related)
            ->with('allAds', Advertisement::where('user_id', Auth::id())->get());
    }
}
