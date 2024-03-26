<?php

namespace App\Http\Controllers;

use App\Models\advertisement\Advertisement;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function show($userId)
    {
        // Get the user by ID with their associated customer and advertisements
        $user = User::with('customer', 'advertisements')->findOrFail($userId);

        // Pass the user data to the view
        return view('sellerprofile', compact('user'));
    }

    public function showaddadvertisementform($userId)
    {
        return view('addadvertisement', ['userId' => $userId]);
    }
    public function createadvertisement(Request $request, $userId)
    {
        // Validation
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:Huur,Verkoop',
            'expiration' => 'required|date',
        ]);

        // Create the advertisement
        $advertisement = new Advertisement();
        $advertisement->title = $validatedData['title'];
        $advertisement->description = $validatedData['description'];
        if($validatedData['type'] == 'Huur'){
            $advertisement->type = 'rent';
        } else {
            $advertisement->type = 'sell';
        }
        $advertisement->expires_at = $validatedData['expiration'];
        $advertisement->user_id = $userId;
        $advertisement->save();

        // Redirect back or to any other route as needed
        return redirect()->route('sellerprofile', ['userId' => $userId])->with('success', 'Advertisement created successfully.');
    }
}


