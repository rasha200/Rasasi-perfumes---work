<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\OrderDetail;
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

    // <!--==========================================  (Hero section)  ==============================-->
        $discountedSubCategories = SubCategory::where('discount', '>', 0)->get();

        // If discounted subcategories are less than 3, fill with random non-discounted subcategories
        if ($discountedSubCategories->count() < 3) {
              $additionalSubCategories = SubCategory::where('discount', '=', 0) // Non-discounted subcategories
                 ->inRandomOrder()
                 ->take(3 - $discountedSubCategories->count()) // Number needed to make up 3
                 ->get();
 
             $discountedSubCategories = $discountedSubCategories->concat($additionalSubCategories);
        }


    // <!--==========================================  (Hero section + Secound section + Fourth section)  ==============================-->
       $categories = Category::with('subCategories')->get();



    // <!--==========================================  (Hero section)  ==============================-->
       $products = Product::with('product_images')->get();

       $topProduct = Product::where('top_product', 1)->first();

    // <!--==========================================  (First section)  ==============================-->
       $discountedProducts = Product::where('discount', '>', 0)
        ->inRandomOrder() 
        ->limit(12) 
        ->get();

        // Fetch the average rating for each product
       foreach ($discountedProducts as $product) {
          // Calculate the average rating
           $averageRating = $product->product_ratings()->avg('rating') ?? 0; 
           $product->average_rating = $averageRating; 
       }




    //    $bestseller = Product::select('products.*', DB::raw('SUM(order_details.quantity) as total_sold'))
    //    ->join('order_details', 'products.id', '=', 'order_details.product_id')
    //    ->groupBy('products.id', 'products.name', 'products.price', 'products.old_price', 'products.small_description', 'products.description', 'products.subCategory_id', 'products.quantity', 'products.discount', 'products.created_at', 'products.updated_at', 'products.deleted_at') // Include all product fields
    //    ->orderBy('total_sold', 'desc')
    //    ->with('product_images')
    //    ->take(8) 
    //    ->get();



 // <!--==========================================  (Third section)  ==============================-->
    $managerBestsellers = Product::where('is_bestseller', 'true')
    ->with('product_images')
    ->take(8)
    ->get();


    $systemBestsellers  = Product::select('products.*')
    ->joinSub(
        OrderDetail::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id'),
        'order_totals',
        'products.id',
        '=',
        'order_totals.product_id'
    )
    ->where('is_bestseller', 'false') // Exclude manager-selected
    ->orderBy('order_totals.total_sold', 'desc')
    ->with('product_images')
    ->take(8- $managerBestsellers->count()) // Fill remaining spots
    ->get();

    // Combine manager-selected and system-calculated
    $bestseller = $managerBestsellers->merge($systemBestsellers);



        // Fetch the average rating for each product
        foreach ($bestseller as $product) {
            // Calculate the average rating
             $averageRating = $product->product_ratings()->avg('rating') ?? 0; 
             $product->average_rating = $averageRating; 
         }


         $products_rating = Product::with('product_ratings')->get();

         // Calculate average rating for each product
         foreach ($products_rating as $product) {
             $product->average_rating = $product->product_ratings->avg('rating') ?? 0;
         }


         
    // <!--==========================================  (Third section)  ==============================-->
         $topRatedProducts = $products_rating->sortByDesc('average_rating')->take(8);
         
         


    // <!--==========================================  (Fifth section)  ==============================-->
         $managerNewProducts = Product::where('is_new', 'true')
         ->with('product_images')
         ->take(9)
         ->get();


       $systemNewProducts = Product::where('is_new', 'false') // Exclude manager-selected
       ->orderBy('created_at', 'desc') // Latest first
       ->with('product_images')
       ->take(9 - $managerNewProducts->count()) // Fill remaining spots
       ->get();

       $latestProduct = $managerNewProducts->merge($systemNewProducts);





        return view('landing_page', [
            'discountedSubCategories'=>$discountedSubCategories,
            'categories'=>$categories ,
            'topProduct'=>$topProduct,
            'products'=>$products ,
            'discountedProducts'=>$discountedProducts,
            'bestseller'=>$bestseller ,
            'latestProduct'=>$latestProduct ,
            'topRatedProducts'=>$topRatedProducts ,
        ]);
    }
}
