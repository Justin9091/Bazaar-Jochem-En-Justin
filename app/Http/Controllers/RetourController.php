<?php

namespace App\Http\Controllers;

use App\Models\advertisement\Advertisement;
use App\Models\advertisement\RentAdvertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetourController extends Controller
{
    public function show(Request $req)
    {
        $advertisementId = $req->advertisement;
        $advertisement = Advertisement::find($advertisementId);
        $rents = RentAdvertisement::where('advertisement_id', $advertisementId)->whereNot('image', null)->get();

        $returns = [];

        // Loop trough all rents and add the damage and image to the return array
        foreach ($rents as $rent) {
            $return = [
                'damage' => $rent->damage,
                'image' => $rent->image,
                'updated_at' => $rent->updated_at,
            ];
            array_push($returns, $return);
        }

        return view('return-list')
            ->with('advertisement', $advertisement)
            ->with('returns', $returns);
    }

    function returnItem()
    {
        return view('return')
            ->with('advertisements', Advertisement::where('user_id', Auth::id())->where('type', 'rent')->get());
    }

    function storeReturnedItem(Request $req)
    {
        $rentAdvertisement = RentAdvertisement::find($req->advertisementId)->orderBy('to_date', 'desc')->first();
        $this->updateDamage($rentAdvertisement);

        $req->file('image')->store('public/images/returnedItems');
        $rentAdvertisement->image = $req->file('image')->hashName();
        $rentAdvertisement->save();

        return redirect()->route('sellerprofile', Auth::id());
    }

    private function updateDamage(RentAdvertisement $ad)
    {
        if($ad == null) return;

        $from = $ad['from_date'];
        $to = $ad['to_date'];

        $from = \Carbon\Carbon::parse($from);
        $to = \Carbon\Carbon::parse($to);

        $days = $from->diffInDays($to);
        $ad->damage = $this->getLatestDamage($ad->id) - ($days * 1);
        $ad->save();
    }

    private function getLatestDamage($adId)
    {
        $ad = RentAdvertisement::find($adId)->orderBy('to_date', 'desc')->first();

        if($ad == null) return 100;

        return $ad->damage;
    }
}
