<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\ResturantReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewResturant extends Controller
{
    public function AddReviewToResturant(Request $request, $resturantid)
    {
        $rules = [
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'string|max:1000',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        $review = new ResturantReview();
        $review->resturant_id = $resturantid;
        $review->user_id = auth()->id(); // Ensure you have user authentication in place
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');
        $review->save();

        return response()->json([
            'message' => 'Review added successfully.',
            'review' => $review
        ], 201);
    }

    // Method to retrieve reviews for a specific city
    public function GetReviewsForResturant($resturantid)
    {
        $resturant = Restaurant::findOrFail($resturantid);
        $reviews =  $resturant->resturantreview()->get();

        return response()->json([
            'resturant' => $resturant,
            'reviews' => $reviews
        ], 200);
}
}
