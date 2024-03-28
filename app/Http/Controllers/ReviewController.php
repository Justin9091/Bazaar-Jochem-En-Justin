<?php
namespace App\Http\Controllers;

use App\Http\Requests\AddReviewRequest;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Password;

class ReviewController extends Controller
{
    public function addReview(AddReviewRequest $request)
    {
        $validatedData = $request->validated();
        if ($validatedData['advertisement_id'] == 0){
            $validatedData['advertisement_id'] = null;
        }

        $reviewer = "";
        if (empty($validatedData['name'])){
            $reviewer = auth()->user()->name;
        } else {
            $reviewer = $validatedData['name'];
        }

        // Create the reviews
        Review::create([
            'user_id' => $validatedData['user_id'],
            'advertisement_id' => $validatedData['advertisement_id'],
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'score' => $validatedData['score'],
            'reviewer' => $reviewer,
            'date' => date('Y-m-d H:i:s')
        ]);

        // Redirect back to the user profile page
        return redirect()->back()->with('success', 'Review added successfully.');
    }
}
