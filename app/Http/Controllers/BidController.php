<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidRequest;
use App\Models\advertisement\Advertisement;
use Illuminate\Http\Request;

class BidController extends Controller
{
    function bid(BidRequest $request, $advertisementId) {
        $advertisement = Advertisement::find($advertisementId);

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
