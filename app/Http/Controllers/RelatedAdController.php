<?php

namespace App\Http\Controllers;

use App\Models\advertisement\Advertisement;
use Illuminate\Http\Request;

class RelatedAdController extends Controller
{
    public function addRelatedAd(Request $request, $baseAdvertisementId) {
        $baseAdvert = Advertisement::find($baseAdvertisementId);
        $relatedAdvert = Advertisement::find($request->related_ad_id);

        $baseAdvert->relatedAds()->attach($relatedAdvert);

        error_log('kip');
        return redirect()->back();
    }

    public function removeRelatedAd($baseAdvertisementId, $relatedAdvertisementId) {
        $baseAdvert = Advertisement::find($baseAdvertisementId);
        $relatedAdvert = Advertisement::find($relatedAdvertisementId);

        $baseAdvert->relatedAds()->detach($relatedAdvert);
        return redirect()->back();
    }
}
