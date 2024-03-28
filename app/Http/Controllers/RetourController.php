<?php

namespace App\Http\Controllers;

use App\Models\advertisement\Advertisement;
use App\Models\advertisement\RentAdvertisement;
use Illuminate\Http\Request;

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
}
