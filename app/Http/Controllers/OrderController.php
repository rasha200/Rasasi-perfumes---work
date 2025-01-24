<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();

        return view('dashboard.order.index' , ['orders'=> $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if (!auth()->check()) {
           
            session(['from_checkout' => true]);
    
            
            return redirect()->route('cart.index')->with('error', 'Please log in to proceed with checkout.');
        }
        
        $cart = json_decode(Cookie::get('cart', json_encode([])), true);
        return view('checkout', compact('cart'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'city' => 'required|string',
            'street' => 'nullable|string',
            'building_number' => 'nullable|string',
            'mobile' => 'required|regex:/^(\+?\d{1,3}[- ]?)?\d{10}$/',
            'email' => 'nullable|email',
            'note' => 'nullable|string|max:255',
            'payment_method' => 'required|in:paypal,stripe,cashOnDelivery',
        ]);
    
      
        $cart = json_decode($request->cookie('cart'), true);
    
        if (!$cart || count($cart) === 0) {
            return back()->with('error', 'Your cart is empty.');
        }
    
       
        $productIds = collect($cart)->pluck('product_id')->toArray();
        $products = \App\Models\Product::whereIn('id', $productIds)->get()->keyBy('id');
    
       
        $totalPrice = collect($cart)->sum(function($item) use ($products) {
           
            $product = $products[$item['product_id']];
    
            
            $final_price = $product->discount 
                ? $product->price * (1 - $product->discount / 100) 
                : $product->price;
    
           
            return $final_price * $item['quantity'];
        });
    
        try {
            
    
          
            $order = Order::create([
                'city' => $request->city,
                'street' => $request->street,
                'building_number' => $request->building_number,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'total_price' => $totalPrice,
                'order_status' => 'Pending', 
                'note' => $request->note, 
                'payment_method' => $request->payment_method,
                'user_id' => auth()->id(), 
            ]);
    
           
            foreach ($cart as $item) {
                $product = $products[$item['product_id']];
    
                
                $final_price = $product->discount 
                    ? $product->price * (1 - $product->discount / 100) 
                    : $product->price;
    
                
                OrderDetail::create([
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'discount' => $product->discount ?? 0,
                    'total_price' => $final_price * $item['quantity'], 
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                ]);
            }

             // Reduce product quantity after creating order
            foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            
            // Reduce the quantity of the product in stock
            $product->decrement('quantity', $item['quantity']);
        }
    
          
    
            
            Cookie::queue(Cookie::forget('cart'));

            $userName = auth()->user()->Fname. ' ' . auth()->user()->Lname;
    
            return redirect()->route('home')->with('success', "$userName, thank you so much for your order! 🛍️ We truly appreciate your trust in us. Your items will be on their way soon, and we hope they bring a smile to your day! 😊");
    
        } catch (\Exception $e) {
           
          
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $orderDetails = $order->orderDetails; 

        return view('dashboard.order.show', [
            'order' => $order,
            'orderDetails' => $orderDetails,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        
        $validation = $request->validate([
            'order_status' => 'required|string|in:Processing,Completed',
        ]);
    
        // Update the order status
        $order->update([
            'order_status' => $request->input('order_status'),
        ]);
    
        return redirect()->back()->with('success', 'Order status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete(); 
        
        return to_route('order.index')->with('success', 'Order deleted');
    }
}
