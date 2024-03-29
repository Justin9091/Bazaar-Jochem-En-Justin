<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\UserFavorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    function favorite(Request $request, $advertisement)
    {
        $user = $request->user();

        if (UserFavorite::all()
                ->where('user_id', auth()->id())
                ->where('advertisement_id', $advertisement)
                ->count() > 0) {
            $user->favorites()->where('advertisement_id', $advertisement)->delete();
        } else {
            $user->favorites()->create(['advertisement_id' => $advertisement]);
        }

        return redirect()->back();
    }
}
