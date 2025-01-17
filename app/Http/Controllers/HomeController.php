<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()

    {
       //
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

       $categories = Category::with('subCategories')->get();

       $discountedSubCategories = SubCategory::where('discount', '>', 0)->get();


         // If discounted subcategories are less than 3, fill with random non-discounted subcategories
    if ($discountedSubCategories->count() < 3) {
        $additionalSubCategories = SubCategory::where('discount', '=', 0) // Non-discounted subcategories
            ->inRandomOrder()
            ->take(3 - $discountedSubCategories->count()) // Number needed to make up 3
            ->get();

        $discountedSubCategories = $discountedSubCategories->concat($additionalSubCategories);
    }

       $products = Product::with('product_images')->get();

       $discountedProducts = Product::where('discount', '>', 0)
        ->inRandomOrder() 
        ->limit(12) 
        ->get();

       $latestProduct = Product::latest()->take(9)->get();

       $topseller = Product::select('products.*', DB::raw('SUM(order_details.quantity) as total_sold'))
       ->join('order_details', 'products.id', '=', 'order_details.product_id')
       ->groupBy('products.id', 'products.name', 'products.price', 'products.old_price', 'products.small_description', 'products.description', 'products.subCategory_id', 'products.quantity', 'products.discount', 'products.created_at', 'products.updated_at', 'products.deleted_at') // Include all product fields
       ->orderBy('total_sold', 'desc')
       ->with('product_images') 
       ->take(1) 
       ->get();

       $bestseller = Product::select('products.*', DB::raw('SUM(order_details.quantity) as total_sold'))
       ->join('order_details', 'products.id', '=', 'order_details.product_id')
       ->groupBy('products.id', 'products.name', 'products.price', 'products.old_price', 'products.small_description', 'products.description', 'products.subCategory_id', 'products.quantity', 'products.discount', 'products.created_at', 'products.updated_at', 'products.deleted_at') // Include all product fields
       ->orderBy('total_sold', 'desc')
       ->with('product_images')
       ->take(8) 
       ->get();


        return view('landing_page', [
            'categories'=>$categories ,
            'products'=>$products ,
            'latestProduct'=>$latestProduct ,
            'bestseller'=>$bestseller ,
            'discountedSubCategories'=>$discountedSubCategories,
            'discountedProducts'=>$discountedProducts,
            'topseller'=>$topseller,

        ]);
    }
}
