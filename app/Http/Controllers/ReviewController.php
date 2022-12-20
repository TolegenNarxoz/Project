<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required',
            'product_id' => 'required|numeric|exists:products,id',
        ]);

//        Review::create($validated);
        Auth::user()->reviews()->create($validated);
        return back()->with('message', 'Reviews is created');
    }


    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->back();
    }
}
