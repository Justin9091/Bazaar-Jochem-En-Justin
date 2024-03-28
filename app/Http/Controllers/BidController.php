<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidRequest;
use App\Models\advertisement\Advertisement;
use Illuminate\Http\Request;

class BidController extends Controller
{
    function bid(BidRequest $request, $advertisementId) {
        // Get all biddings a user has made on advertisements that havent been expired
        $biddings = auth()->user()->bids()->whereHas('advertisement', function($query) {
            $query->where('expires_at', '>', now());
        })->get();

        if($biddings->count() >= 4) {
            return redirect()->back()->withErrors(["bid" => 'You already have 4 biddings placed!']);
        }

        $advertisement = Advertisement::find($advertisementId);

        if($advertisement->expires_at < now()) {
            return redirect()->back()->withErrors(["bid" => 'This advertisement has expired']);
        }

        $hightesBid = $advertisement->bids->max('bid');

        if($request->bid <= $hightesBid) {
            return redirect()->back()->withErrors(["bid" => 'Your bid must be higher than the current highest bid']);
        }

        $advertisement->bids()->create([
            'user_id' => auth()->id(),
            'bid' => $request->bid
        ]);
        return redirect()->back();
    }
}
