<?php

namespace App\Http\Controllers;

use App\Models\advertisement\Advertisement;
use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getReviews($apitoken)
    {
        $user = User::where('api_token', $apitoken)->first();

        if ($user) {
            $reviews = $user->reviews()->get();

            return response()->json($reviews);
        } else {
            return response()->json(['error' => 'Invalid API token'], 401);
        }
    }

    public function getAdvertisements($apitoken)
    {
        $user = User::where('api_token', $apitoken)->first();

        if ($user) {
            $advertisements = $user->advertisements()->get();

            return response()->json($advertisements);
        } else {
            return response()->json(['error' => 'Invalid API token'], 401);
        }
    }

    public function getAdvertisementsAndReviews($apitoken)
    {
        $user = User::where('api_token', $apitoken)->first();

        if ($user) {
            $advertisements = $user->advertisements()->get();
            $reviews = $user->reviews()->get();

            return response()->json(['advertisements' => $advertisements, 'reviews' => $reviews]);
        } else {
            return response()->json(['error' => 'Invalid API token'], 401);
        }
    }
}
