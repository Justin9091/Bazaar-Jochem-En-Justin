<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function addReview(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'score' => 'required|integer|max:5',
            'reviewer' => 'required|string|max:255',
        ]);

        // Create the review
        Review::create([
            'user_id' => $validatedData['user_id'],
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'score' => $validatedData['score'],
            'reviewer' => $validatedData['reviewer'],
            'date' => date('Y-m-d H:i:s')
        ]);

        // Redirect back to the user profile page
        return redirect()->back()->with('success', 'Review added successfully.');
    }
}
