<?php

namespace App\Http\Controllers;

use App\Models\Advertisment\Advertisment;
use Illuminate\Http\Request;

class AdvertismentController extends Controller
{
    function Show(int $id){
        $ad = Advertisment::find($id);

        return view('advertisment')
            ->with('ad', $ad);
    }
}
