@extends('layouts.user_side_master')

@section('content')

<div class="site-content">
    <main class="site-main  main-container no-sidebar">
        <div class="container">
            <div class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin">
                        
                        <a href="{{ route('home') }}">
                            <span>
                                Home
                            </span>
                    </a>
                       
                    </li>
                    <li class="trail-item trail-end active">
							<span>
								Shopping Cart
							</span>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="main-content-cart main-content col-sm-12" >
                    <h3 class="custom_blog_title">
                        Shopping Cart
                    </h3>
                    <div class="page-main-content">
                        <div class="shoppingcart-content">
                            <form action="shoppingcart.html" class="cart-form" style="border: none !important;">
                                <table class="shop_table">
                                    <thead>
                                    <tr>
                                        <th class="product-remove"></th>
                                        <th class="product-thumbnail"></th>
                                        <th class="product-name"></th>
                                        <th class="product-price"></th>
                                        <th class="product-quantity"></th>
                                        <th class="product-subtotal"></th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @foreach ($cart as $item)
                                      
                                    @php
                                       $product = \App\Models\product::find($item['product_id']);

                                    @endphp   
                                    <tr class="cart_item" style="border: 1px solid #f1f1f1;">
                                        <td class="product-remove">


                                            <form action="{{ route('cart.delete', $product->id ) }}" method="POST" title="Delete" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="remove" style="background: none; border: none; padding: 0; cursor: pointer;"><i class="fa fa-times" aria-hidden="true" style="color:grey; font-size:30px;" onmouseover="this.style.color='brown';" 
                                                    onmouseout="this.style.color='grey';" title="Delete"></i> </button>
                                            </form>
                                           
                                        
                                        </td>
                                        <td class="product-thumbnail">
                                            <a href="{{ route('product_details', $product->id) }}">
                                                <img src="{{ asset($product->product_images->first()->image ?? '/images/default-product.jpg') }}" alt="img"
                                                     class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image">
                                            </a>
                                        </td>
                                        <td class="product-name" data-title="Product">
                                            <a href="{{ route('product_details', $product->id) }}" class="title">{{ $product->name }}</a>
                                            <span class="attributes-select attributes-color">{{ $product->small_description }}</span>
                                            
                                        </td>
                                        <td class="product-quantity" data-title="Quantity" >
                                            <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" style="align-items: center; margin-left: 30px; display: flex; flex-direction: column;">
                                                @csrf
                                                <div class="quantity">
                                                    <div class="control">
                                                        <input 
                                                            type="number" 
                                                            name="quantity" 
                                                            data-step="1" 
                                                            data-min="1" 
                                                            min="1" 
                                                            max="{{ $product->quantity }}" 
                                                            value="{{ $item['quantity'] }}" 
                                                            title="Qty" 
                                                            class="input-qty qty" 
                                                            size="4">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn-update" style="margin-left: 20px;">Update</button>
                                            </form>
                                            
                                            
                                            
                                            <style>
                                        .quantity .control {
                                          display: flex;
                                          flex-direction: column; /* Stack the input and button vertically */
                                          align-items: flex-start; /* Align items to the left */
                                          gap: 10px; /* Space between the input and button */
                                        }

                                        .input-qty {
                                          width: 70px; /* Fixed width for the input */
                                          padding: 5px; /* Padding for the input */
                                        }

                                        .btn-update {
                                          background-color: white; /* Button color */
                                          color: #900A07; /* Text color */
                                          
                                          border-radius: 0px;
                                          padding-bottom: 0px !important;
                                          padding: 5px 2px; /* Button padding */
                                          font-size: 14px;
                                          cursor: pointer;
                                          transition: background-color 0.3s ease;
                                        }

                                        



                                            </style>
                                            

                                           
                                        </td>
                                        <td class="product-price" data-title="Price">
                                            @if($product->discount)
                                            <!-- Display the original price in del -->
                                            <del style="opacity: 50%; font-size:16px;">
                                                {{ number_format($product->price, 2) }} JOD
                                            </del>
                                    
                                            <!-- Display the discounted price in span -->
                                            <span class="woocommerce-Price-amount amount" style="font-size:16px; color:red;">
                                                <span class="woocommerce-Price-currencySymbol" style="font-size:16px;">
                                                    {{ number_format($product->price * (1 - $product->discount / 100), 2) }} 
                                                </span>
                                                JOD
                                            </span>
                                        @else 
                                            <!-- Display regular price if no discount -->
                                            <span class="woocommerce-Price-amount amount" style="font-size:16px;">
                                                <span class="woocommerce-Price-currencySymbol">
                                                    {{ number_format($product->price, 2) }}
                                                </span>
                                                JOD
                                            </span> 
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="actions" style="border: 1px solid #f1f1f1;">
                                            @php
                                            // Fetch all products for the cart at once to avoid multiple database queries
                                            $productIds = collect($cart)->pluck('product_id')->toArray();
                                            $products = \App\Models\Product::whereIn('id', $productIds)->get()->keyBy('id');
                                        
                                            // Calculate the total price of the cart with applied discounts
                                            $total = collect($cart)->sum(function($item) use ($products) {
                                                // Get the product from the already fetched products
                                                $product = $products[$item['product_id']];
                                        
                                                // Calculate the final price with discount
                                                $final_price = $product->discount 
                                                    ? $product->price * (1 - $product->discount / 100) 
                                                    : $product->price;
                                        
                                                // Return the total price for this product with the quantity
                                                return $final_price * $item['quantity'];
                                            });
                                          @endphp
                                            <div class="order-total">
														<span class="title">
															Total Price:
														</span>
                                                <span class="total-price">
                                                    {{ number_format($total, 2) }} JOD
														</span>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                           
                               
                                

                                    <form action="{{ route('order.create') }}" method="GET" class="control-cart">
                                        <button type="submit" class="button btn-cart-to-checkout">
                                            Checkout
                                        </button>
                                    </form>
                           
                               
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>


  <!------------------------- Success & error modal ------------------------------>

@if (Session::get('success') )
<div id="customModal" class="custom-modal-overlay">
    <div class="custom-modal">
        <div class="modal-header">
            <div class="icon-container">
                <i class="fa fa-check-circle success-icon"></i> <!-- Success icon -->
            </div>
        </div>
        <div class="modal-body">
            <h2> Successfully </h2>
            <p id="modalMessage">{{ Session::get('success') }}</p>
        </div>
        <div class="modal-footer">
            <button class="close-modal-btn">OK</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Show the modal
        $('#customModal').fadeIn();

        // Set the modal title and message
        var isSuccess = '{{ Session::get("success") }}' ? true : false;
        $('#modalTitle').text(isSuccess ? 'Success' : 'Error');
        $('#modalMessage').text('{{ Session::get("success") ?? Session::get("error") }}');
    });

    // Close the modal when the user clicks "OK"
    $('.close-modal-btn').click(function() {
        $('#customModal').fadeOut();
    });
</script>
@endif

@if (Session::get('error'))
 <div id="customModal" class="custom-modal-overlay">
     <div class="custom-modal">
        <div class="modal-header">
            <div class="icon-container">
                <i class="fa fa-exclamation-circle error-icon"></i> <!-- Error icon -->
            </div>
        </div>
         <div class="modal-body">
             <h2> Please Login to Proceed </h2>
             <p id="modalMessage">{{ Session::get('error') }}</p>
         </div>
         <div class="modal-footer">
             <button class="close-modal-btn" onclick="window.location.href='{{ route('login') }}'">Login</button>
         </div>
     </div>
 </div>

 <script>
     $(document).ready(function() {
         // Show the modal
         $('#customModal').fadeIn();

         // Set the modal title and message
         var isSuccess = '{{ Session::get("success") }}' ? true : false;
         $('#modalTitle').text(isSuccess ? 'Success' : 'Error');
         $('#modalMessage').text('{{ Session::get("success") ?? Session::get("error") }}');
     });

     // Close the modal when the user clicks "OK"
     $('.close-modal-btn').click(function() {
         $('#customModal').fadeOut();
     });
 </script>
@endif

{{-- <pre> {{ print_r($cart, true) }} </pre> --}}
@endsection