<?php

namespace App\Http\Controllers;

use App\Models\Advertisment\Advertisment;
use Illuminate\Http\Request;

class BidController extends Controller
{
    function bid(Request $request, $advertismentId) {
        $advertisment = Advertisment::find($advertismentId);

        $hightesBid = $advertisment->bids->max('bid');

        if($request->bid <= $hightesBid) {
            return redirect()->back()->withErrors(["bid" => 'Your bid must be higher than the current highest bid']);
        }

        $advertisment->bids()->create([
            'user_id' => auth()->id(),
            'bid' => $request->bid
        ]);
        return redirect()->back();
    }
}
