<?php

namespace App\Http\Controllers;

use App\Models\Advertisment\Advertisment;
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
        $advertisment = new Advertisment();
        $advertisment->title = $validatedData['title'];
        $advertisment->description = $validatedData['description'];
        $advertisment->type = $validatedData['type'];
        $advertisment->expires_at = $validatedData['expiration'];
        $advertisment->user_id = $userId;
        $advertisment->save();

        // Redirect back or to any other route as needed
        return redirect()->route('sellerprofile', ['userId' => $userId])->with('success', 'Advertisement created successfully.');
    }

    public function createqr(){

    }
}


