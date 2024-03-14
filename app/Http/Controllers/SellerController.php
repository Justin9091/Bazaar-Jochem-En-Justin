<?php

namespace App\Http\Controllers;

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
}


