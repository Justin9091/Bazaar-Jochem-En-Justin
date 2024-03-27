<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    function favorite(Request $request, $advertisement)
    {
        $user = $request->user();

        if ($user->favorites()->where('advertisement_id', $advertisement)->exists()) {
            $user->favorites()->where('advertisement_id', $advertisement)->delete();
        } else {
            $user->favorites()->create(['advertisement_id' => $advertisement]);
        }

        return redirect()->back();
    }
}
