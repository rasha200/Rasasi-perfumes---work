<?php

namespace App\Http\Controllers;

use App\Models\ProductRating;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if (!auth()->check()) {
            // Store a session variable to remember that the user came from the product rating form
            session(['from_productrating' => true, 'product_id' => $request->input('product_id')]);
        
            // Redirect back with the error message and input data
            return redirect()->back()->with('error', 'Please log in to submit your rating.')->withInput();
        }

        $userId = auth()->id();
        $productId = $request->input('product_id');
    
        // Check if the user has a completed order for the product
        $hasPurchasedProduct = OrderDetail::where('product_id', $productId)
            ->whereHas('order', function ($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->where('order_status', 'Completed');
            })
            ->exists();
    
        if (!$hasPurchasedProduct) {
            return redirect()->back()->with('error', 'You can only rate products you have purchased with a completed order.');
        }



        ProductRating::create([
            'rating'=>$request->input('rating'),
            'user_id'=>auth()->id(),
            'product_id'=>$request->input('product_id'),
        ]);

        return redirect()->back()->with('success', 'Thank you for sharing your rating');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductRating $productRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductRating $productRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductRating $productRating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductRating $productRating)
    {
        //
    }
}
