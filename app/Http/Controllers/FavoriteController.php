<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    function favorite(Request $request, $advertisement)
    {
        $user = $request->user();

        // Check if the user has already favorited the advertisement
        if ($user->favorites()->where('advertisement_id', $advertisement)->exists()) {
            $user->favorites()->where('advertisement_id', $advertisement)->delete();
        } else {
            $user->favorites()->create(['advertisement_id' => $advertisement]);
        }

        return redirect()->back();
    }

    function indenfew() {
        Role::insert([
            "name" => "admin",
        ]);
    }
}
