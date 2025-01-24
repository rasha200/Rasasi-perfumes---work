<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   


    public function index(Request $request)
    {

       $products = Product::with('product_images')->get();
       // Fetch the average rating for each product
       foreach ($products as $product) {
        // Calculate the average rating
         $averageRating = $product->product_ratings()->avg('rating') ?? 0; 
         $product->average_rating = $averageRating; 
     }
      
       return view('dashboard.products.index' , ['products'=> $products]);
    }

   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $SubCategories= SubCategory::all();
      
        return view ('dashboard.products.create',['SubCategories'=>$SubCategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'small_description' => 'required|string',
            'description' => 'required',
            'old_price' => 'nullable',
            'price' => 'required',
            'discount' => 'nullable|numeric|min:0|max:100',
            'quantity' => 'required|integer',
            'is_bestseller' => 'required|in:true,false',
            'is_new' => 'required|in:true,false',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,WEBP,AVIF|max:2048',
            'subCategory_id' => 'required|exists:sub_categories,id',
        ]);

        $product = Product::create([
            'name'=>$request->input('name'),
            'small_description'=>$request->input('small_description'),
            'description'=>$request->input('description'),
            'price'=>$request->input('price'),
            'old_price'=>$request->input('old_price'),
            'discount' => $request->input('discount'), 
            'quantity'=>$request->input('quantity'),
            'is_bestseller' => 'false',
            'is_new' => 'false',
            'subCategory_id'=>$request->input('subCategory_id'),
        ]);

        $images = [];

        if ($request->hasFile('image')) {
            foreach($request->file('image') as $file) {
               
                $filename = uniqid() . '_' . $file->getClientOriginalExtension();
                $path = public_path('uploads/productImages/');
                $file->move($path, $filename);
    
               
                $images[] = [
                    'image' => 'uploads/productImages/' . $filename,
                    'product_id'=> $product->id, 
                ];
            }
    
            
            ProductImage::insert($images);
        }

       

        return to_route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $productImages = $product->product_images; 
        $averageRating = $product->product_ratings()->avg('rating')?? 0;

        return view('dashboard.products.show' , [
            'product'=> $product,
            'productImages'=>$productImages,
            'averageRating'=>$averageRating,
        ]);
    }




    public function show_user_side( $id)
    {
        
        $product = Product::findOrFail($id); 
        $averageRating = $product->product_ratings()->avg('rating')?? 0;
        // dd($averageRating); 
        $productImages = $product->product_images; 
        $relatedProducts = Product::where('subCategory_id', $product->subCategory_id)
        ->where('id', '!=', $product->id)
        ->inRandomOrder() 
        ->take(12) 
        ->get();
        // Fetch the average rating for each product
        foreach ($relatedProducts as $relatedProduct) {
            // Calculate the average rating
             $average_Rating = $relatedProduct->product_ratings()->avg('rating') ?? 0; 
             $relatedProduct->average_rating = $average_Rating; 
         }

        return view('product_details' , [
            'product'=> $product,
            'productImages'=>$productImages,
            'relatedProducts' => $relatedProducts,
            'averageRating'=>$averageRating,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $SubCategories= SubCategory::all();
        $productImages = $product->product_images;
        return view ('dashboard.products.edit',[
            'product'=>$product ,
            'SubCategories'=>$SubCategories,
            'productImages'=>$productImages,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'small_description' => 'required|string',
            'description' => 'required',
            'old_price' => 'nullable',
            'price' => 'required',
            'discount' => 'nullable|numeric|min:0|max:100',
            'quantity' => 'required|integer',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,WEBP,AVIF|max:2048',
            'subCategory_id' => 'required|exists:sub_categories,id',
        ]);

    

        $product->update([
            'name'=>$request->input('name'),
            'small_description'=>$request->input('small_description'),
            'description'=>$request->input('description'),
            'old_price'=>$request->input('old_price'),
            'price'=>$request->input('price'),
            'discount' => $request->input('discount'),
            'quantity'=>$request->input('quantity'),
            'subCategory_id'=>$request->input('subCategory_id'),
        ]);

        $images = [];

        if ($request->hasFile('image')) {
            foreach($request->file('image') as $file) {
               
                $filename = uniqid() . '_' . $file->getClientOriginalExtension();
                $path = public_path('uploads/productImages/');
                $file->move($path, $filename);
    
               
                $images[] = [
                    'image' => 'uploads/productImages/' . $filename,
                    'product_id'=> $product->id, 
                ];
            }
    
            
            ProductImage::insert($images);
        }

       

        return to_route('products.index')->with('success', 'Product updated successfully');
    }




// <!--==============  (for the bestseller and the new choosen products)  =============================-->
    public function toggleStatus($id, $type)
    {
        
        $product = Product::findOrFail($id);
    
        
        if ($type === 'bestseller') {
            $product->is_bestseller = $product->is_bestseller === 'true' ? 'false' : 'true';
        } elseif ($type === 'new') {
            $product->is_new = $product->is_new === 'true' ? 'false' : 'true';
        } else {
            return redirect()->back()->with('error', 'Invalid toggle type.');
        }
    
        $product->save();
    
        return redirect()->back()->with('success', 'Product status updated successfully.');
    }
    



    public function productsByCategory($id, Request $request)
    {
        
        $category = Category::findOrFail($id);
        
       
        $maxPrice = Product::whereHas('subCategory', function ($query) use ($id) {
            $query->where('category_id', $id);
        })->max('price');
    
        
        $query = Product::with('product_images')->whereHas('subCategory', function ($query) use ($id) {
            $query->where('category_id', $id);
        });
    
        // Check if min_price and max_price are provided
        if ($request->has('min_price') && $request->has('max_price')) {
            $minPrice = $request->query('min_price', 0);
            $maxPrice = $request->query('max_price', $maxPrice); // Use the original max price
    
            $query->where(function ($query) use ($minPrice, $maxPrice) {
                // Filter by original price range
                $query->whereBetween('price', [$minPrice, $maxPrice])
                      // Also filter by discounted price range (price after discount)
                      ->orWhere(function ($query) use ($minPrice, $maxPrice) {
                          $query->whereRaw('price - (price * discount / 100) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
                      });
            });
        }
    
        
        $products = $query->orderBy('name', 'asc')->paginate(16);

        // Fetch the average rating for each product
        foreach ($products as $product) {
            // Calculate the average rating
             $averageRating = $product->product_ratings()->avg('rating') ?? 0; 
             $product->average_rating = $averageRating; 
         }
    
        return view('store', compact('products', 'category', 'maxPrice'));
    }
    

    

    public function productsBySubCategory($id, Request $request)
    {
        
        $subCategory = SubCategory::findOrFail($id);
    
       
        $maxPrice = Product::where('subCategory_id', $id)->max('price');
    
       
        $query = Product::with('product_images')->where('subCategory_id', $id);
    
        // Check if min_price and max_price are provided
        if ($request->has('min_price') && $request->has('max_price')) {
            $minPrice = $request->query('min_price', 0);
            $maxPrice = $request->query('max_price', $maxPrice); // Use the original max price
    
            $query->where(function ($query) use ($minPrice, $maxPrice) {
                // Filter by original price range
                $query->whereBetween('price', [$minPrice, $maxPrice])
                      // Also filter by discounted price range (price after discount)
                      ->orWhere(function ($query) use ($minPrice, $maxPrice) {
                          $query->whereRaw('price - (price * discount / 100) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
                      });
            });
        }
    
       
        $products = $query->orderBy('name', 'asc')->paginate(16);
         // Fetch the average rating for each product
         foreach ($products as $product) {
            // Calculate the average rating
             $averageRating = $product->product_ratings()->avg('rating') ?? 0; 
             $product->average_rating = $averageRating; 
         }
    
        return view('store', compact('products', 'subCategory', 'maxPrice'));
    }
    
    

    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        if ($product->orderDetails()->exists()) {
            return to_route('products.index')->with('error', 'Cannot delete a product with active orders.');
        }
    
        $product->delete(); 
        
        return to_route('products.index')->with('success', 'Product deleted');
    }
}