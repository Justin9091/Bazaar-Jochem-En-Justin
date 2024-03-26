<?php

namespace App\Http\Controllers;

use App\Models\advertisement\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    function Show(int $id){
        $ad = Advertisement::find($id);

        return view('advertisement')
            ->with('ad', $ad);
    }
}
