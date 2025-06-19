<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
        public function index(Request $request)
    {
        $query = Review::with('user');
        if ($search = $request->input('search')) {
            $query->where('comment', 'like', "%$search%");
        }
        $reviews = $query->orderByDesc('created_at')->paginate(15);

        return Inertia::render('reviews/index', [
            'reviews' => $reviews,
            'filters' => [
                'search' => $search ?? null,
            ]
        ]);
    }

    public function show(Review $review)
    {
        $review->load('user', 'reviewable');
        return Inertia::render('reviews/show', [
            'review' => $review,
        ]);
    }

    public function create()
    {
        return Inertia::render('reviews/create');
    }

    public function store(StoreReviewRequest $request)
    {
        $review = Review::create($request->validated());
        return redirect()->route('reviews.index')->with('success', 'Review created!');
    }

    public function edit(Review $review)
    {
        return Inertia::render('reviews/edit', [
            'review' => $review,
        ]);
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->update($request->validated());
        return redirect()->route('reviews.index')->with('success', 'Review updated!');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Review deleted!');
    }
}
