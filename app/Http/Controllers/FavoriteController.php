<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    function favorite(Request $request, $advertisment)
    {
        $user = $request->user();

        // Check if the user has already favorited the advertisment
        if ($user->favorites()->where('advertisment_id', $advertisment)->exists()) {
            $user->favorites()->where('advertisment_id', $advertisment)->delete();
        } else {
            $user->favorites()->create(['advertisment_id' => $advertisment]);
        }

        return redirect()->back();
    }

    function indenfew() {
        Role::insert([
            "name" => "admin",
        ]);
    }
}
