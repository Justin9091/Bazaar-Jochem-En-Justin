<?php

namespace App\Http\Controllers;
use App\Http\Requests\RentItemRequest;
use App\Models\advertisement\Advertisement;
use App\Models\advertisement\RentAdvertisement;
use Illuminate\Http\Request;

class RentController
{

    public function createagenda($userid, $date)
    {
        $advertisements = Advertisement::where('user_id', $userid)->get();
        $rentingslist = array();

        foreach($advertisements as $advertisement){
            if ($advertisement->type == 'rent'){
                $rents = RentAdvertisement::where('advertisement_id', $advertisement->id)->get();
                foreach($rents as $rent){
                    $rentadvertisement = Advertisement::where('id', $rent->advertisement_id)->first();
                    $rentingslist['Verhuur: ' . $rentadvertisement->title] = $rent->from_date;
                    $rentingslist['Teruggave: '. $rentadvertisement->title] = $rent->to_date;
                }
            }
        }
        return view('agenda')->with('rentingslist', $rentingslist);
    }
    public function rentitem(RentItemRequest $request, $advertisementid){
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        RentAdvertisement::create([
            'advertisement_id' => $advertisementid,
            'from_date' => $fromDate,
            'to_date' => $toDate
        ]);

        return back();
    }
}
