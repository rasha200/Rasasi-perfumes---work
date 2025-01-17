<div class="shopcart-description stelina-submenu">
    <div class="content-wrap">
        <h3 class="title">Shopping Cart</h3>
        <ul class="minicart-items">
            @foreach ($cart as $item)
                                      
            @php
               $product = \App\Models\product::find($item['product_id']);

            @endphp 
            <li class="product-cart mini_cart_item">
                <a href="{{ route('product_details', $product->id) }}" class="product-media">
                    <img src="{{ asset($product->product_images->first()->image ?? '/images/default-product.jpg') }}" alt="img">
                </a>
                <div class="product-details">
                    <h5 class="product-name">
                        <a href="{{ route('product_details', $product->id) }}">{{ $product->name }}</a>
                    </h5>
                    <div class="variations">
                                <span class="attribute_color">
                                    <a href="#"></a>
                                </span>
                        
                        <span class="attribute_size">
                                    <a href="#"></a>
                                </span>
                    </div>
                    <span class="product-price">
                                @if($product->discount)
                                   <del style="opacity: 50%; font-size:16px;">
                                     {{ $product->price }} JOD
                                   </del>
                                   <br>
                                <span class="price">
                                    <span>{{ number_format($product->price * (1 - $product->discount / 100), 2) }} JOD</span>
                                </span>
                                @else 
                                <span class="price">
                                    <span>{{ $product->price }} JOD</span>
                                </span>
                                @endif   
                            </span>
                    <span class="product-quantity">
                                (x{{ $item['quantity'] }})
                            </span>
                    <div class="product-remove">
                        

                        <form action="{{ route('cart.delete',$product->id ) }}" method="POST" title="Delete" style="display: inline;">
                            @csrf
                          <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;"><i class="fa fa-trash-o" title="Delete" aria-hidden="true" style="color:grey;" onmouseover="this.style.color='brown';" 
                            onmouseout="this.style.color='grey';" title="Delete"></i></button>
                        </form>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        
        @php
        // Initialize total price
        $total = 0;
    
        // Loop through cart items and calculate the total
        foreach ($cart as $item) {
            // Ensure the data exists and is numeric
            $price = isset($item['price']) && is_numeric($item['price']) ? $item['price'] : 0;
            $quantity = isset($item['quantity']) && is_numeric($item['quantity']) ? $item['quantity'] : 1;
            $discount = isset($item['discount']) && is_numeric($item['discount']) ? $item['discount'] : 0;
    
            // Calculate final price after discount
            $finalPrice = $discount > 0 ? $price * (1 - $discount / 100) : $price;
    
            // Add to total
            $total += $finalPrice * $quantity;
        }
    @endphp
        <div class="subtotal">
            <span class="total-title">Subtotal: </span>
            <span class="total-price">
                        <span class="Price-amount">
                            {{ number_format($total, 2) }} JOD
                        </span>
                    </span>
        </div>
        <div class="actions">
            <a class="button button-viewcart" href="{{ route('cart.index') }}">
                <span>View cart</span>
            </a>
            
        </div>
    </div>
</div>