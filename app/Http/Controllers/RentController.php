<?php

namespace App\Http\Controllers;
use App\Models\Advertisment\Advertisment;
use App\Models\Advertisment\RentAdvertisment;
use Illuminate\Http\Request;

class RentController
{

    public function createagenda($userid, $date)
    {
        $advertisements = Advertisment::where('user_id', $userid)->get();
        $rentingslist = array();

        foreach($advertisements as $advertisement){
            if ($advertisement->type == 'rent'){
                $rents = RentAdvertisment::where('advertisment_id', $advertisement->id)->get();
                foreach($rents as $rent){
                    $rentAdvertisment = Advertisment::where('id', $rent->advertisment_id)->first();
                    $rentingslist['Verhuur: ' . $rentAdvertisment->title] = $rent->from_date;
                    $rentingslist['Teruggave: '. $rentAdvertisment->title] = $rent->to_date;
                }
            }
        }
        return view('agenda')->with('rentingslist', $rentingslist);
    }
    public function rentitem(Request $request, $advertisementid){
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $rentadvertisement = RentAdvertisment::create([
            'advertisment_id' => $advertisementid,
            'from_date' => $fromDate,
            'to_date' => $toDate
        ]);
        return back();
    }
}
