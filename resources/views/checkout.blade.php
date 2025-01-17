@extends('layouts.user_side_master')

@section('content')

<div class="main-content main-content-checkout">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
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
                            Checkout
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <h3 class="custom_blog_title">
            Checkout
        </h3>

        @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif
        <div class="checkout-wrapp">
            <div class="shipping-address-form-wrapp">
                <div class="shipping-address-form  checkout-form">
                    <form action="{{ route('order.store') }}" method="POST" id="checkoutForm">
                        @csrf
                        <div class="row-col-1 row-col">
                            <div class="shipping-address">
                                <h3 class="title-form">Shipping Address</h3>
                                
                                <!-- Email Address -->
                                <p class="form-row form-row-first">
                                    <label class="text">Email Address</label>
                                    <input name="email" title="Email Address" type="email" class="input-text" value="{{ old('email') }}" style="border:1px solid rgb(172, 171, 171);border-radius:0px;" >
                                </p>
                    
                                <!-- Mobile number -->
                                <p class="form-row form-row-last">
                                    <label class="text">Mobile number <span style="color:red;">*</span></label>
                                    <input name="mobile" title="Mobile number" type="text" class="input-text" value="{{ old('mobile') }}" style="border:1px solid rgb(172, 171, 171);border-radius:0px;" required>
                                </p>
                    
                                <!-- City -->
                                <p class="form-row forn-row-col forn-row-col-1">
                                    <label class="text">City <span style="color:red;">*</span></label>
                                    <select name="city" class="chosen-select" style="border:1px solid rgb(172, 171, 171); ">
                                        <option value="Aqaba">Aqaba</option>
                                        <option value="Amman">Amman</option>
                                        <option value="Balqa">Balqa</option>
                                        <option value="Zarqa">Zarqa</option>
                                        <option value="Madaba">Madaba</option>
                                        <option value="Irbid">Irbid</option>
                                        <option value="Jerash">Jerash</option>
                                        <option value="Ajloun">Ajloun</option>
                                        <option value="Mafraq">Mafraq</option>
                                        <option value="Karak">Karak</option>
                                        <option value="Tafilah">Tafilah</option>
                                        <option value="Ma'an">Ma'an</option>
                                    </select>                              
                                </p>
                    

                                <!-- Street -->
                                <p class="form-row forn-row-col forn-row-col-2">
                                    <label class="text">Street </label>
                                    <input name="street" title="Street" type="text" class="input-text" value="{{ old('street') }}" style="border:1px solid rgb(172, 171, 171);border-radius:0px;" >
                                </p>
                    
                                <!-- Building number -->
                                <p class="form-row forn-row-col forn-row-col-3">
                                    <label class="text">Building number </label>
                                    <input name="building_number" title="Building number" type="text" class="input-text" value="{{ old('building_number') }}" style="border:1px solid rgb(172, 171, 171);border-radius:0px;" >
                                </p>
                    
                                <!-- Note -->
                                <p class="form-row">
                                    <label class="text">Note</label>
                                    <input name="note" title="Note" type="text" class="input-text" value="{{ old('note') }}" style="border:1px solid rgb(172, 171, 171);border-radius:0px;">
                                </p>
                    
                                <!-- Payment Method -->
                                <p class="form-row">
                                    <label class="text">Payment <span style="color:red;">*</span></label>
                                    <select name="payment_method" class="chosen-select" style="border:1px solid rgb(172, 171, 171); border-radius:30px;">
                                        <option value="cashOnDelivery">Cash on Delivery</option>
                                        <option value="stripe">Credit Card</option>
                                        <option value="paypal">Cliq</option>
                                    </select>
                                </p>
                    
                                <p class="form-row">
                                    <button type="button" onclick="showConfirmModal('checkout')" class="button btn-cart-to-checkout">Place Order</button>
                                </p>
                            </div>
                        </div>
                    </form>

                     <!-- Confirmation Modal -->
                     <div id="confirmModal" class="custom-modal-overlay" style="display: none;">
                        <div class="custom-modal">
                            <div class="modal-header">
                                <div class="icon-container">
                                    <i class="fa fa-question-circle" style="font-size: 35px;"></i> <!-- Question Icon -->
                                </div>
                            </div>
                            <div class="modal-body">
                                <h2 id="modalTitle">Are you sure?</h2>
                                <p id="modalMessage">Ensure all details are correct before proceeding.</p>
                            </div>
                            <div class="modal-footer">
                                <button class="confirm-btn" onclick="closeConfirmModal()">Cancel</button>
                                <button id="confirmButton" class="confirm-btn">Yes</button>
                            </div>
                        </div>
                    </div>
                    

                    <script>
                        // Show the confirmation modal only if form validation passes
                        function showConfirmModal(action) {
                            const form = document.getElementById('checkoutForm');
                        
                            // Check if the form is valid
                            if (form.checkValidity()) {
                                // Modal element references
                                const modalTitle = document.getElementById('modalTitle');
                                const modalMessage = document.getElementById('modalMessage');
                                const confirmButton = document.getElementById('confirmButton');
                        
                                // Update modal content and actions based on the action
                                if (action === 'checkout') {
                                    modalTitle.textContent = 'Are you sure you want to place this order?';
                                    modalMessage.textContent = 'Ensure all details are correct before proceeding.';
                                    confirmButton.onclick = function () {
                                        submitForm('checkoutForm');
                                    };
                                }
                        
                                // Show modal
                                document.getElementById('confirmModal').style.display = 'flex';
                            } else {
                                // If form is not valid, show validation messages
                                form.reportValidity();
                            }
                        }
                        
                        // Close the confirmation modal
                        function closeConfirmModal() {
                            document.getElementById('confirmModal').style.display = 'none';
                        }
                        
                        // Submit the specific form when confirmed
                        function submitForm(formId) {
                            document.getElementById(formId).submit();
                        }
                        </script>

                    <div class="row-col-2 row-col">
                        <div class="your-order">
                            <h3 class="title-form">
                                Your Order 
                            </h3>
                            <div class="slider">
                                @foreach ($cart as $item)
                                    @php
                                        $product = \App\Models\product::find($item['product_id']);
                                    @endphp   
                                    <div class="product-item-order" >
                                        <div class="product-thumb">
                                            <a href="{{ route('product_details', $product->id) }}">
                                                <img src="{{ asset($product->product_images->first()->image ?? '/images/default-product.jpg') }}" alt="img" style="height: 85px;">
                                            </a>
                                        </div>
                                        <div class="product-order-inner">
                                            <h6 class="product-name">
                                                <a href="{{ route('product_details', $product->id) }}" style="font-size: 15px;">{{ $product->name }}</a>
                                            </h6>
                    
                                            @if($product->discount)
                                                <div class="price" style="font-size: 15px;">
                                                    {{ number_format($product->price * (1 - $product->discount / 100), 2) }} JOD <br>
                                                    <span class="count">x{{ $item['quantity'] }}</span>
                                                </div>
                                            @else 
                                                <div class="price">
                                                    {{ $product->price }} JOD<br>
                                                    <span class="count">x{{ $item['quantity'] }}</span>
                                                </div>
                                            @endif  
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                    
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
                            <div class="order-total" style="margin-top: 18px;">
                                <span class="title">
                                    Total Price:
                                </span>
                                <span class="total-price">
                                    {{ number_format($total, 2) }} JOD
                                </span>


                            </div>

                            <div class="button-control" style="margin-top: 18px;">
                                
                                <a href="{{ route('cart.index') }}" class="button btn-back-to-shipping">Back to cart</a>
                                
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $('.slider').slick({
                                infinite: true,
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                prevArrow: '<button type="button" class="slick-prev custom-prev"></button>',  // Customize previous arrow
                                nextArrow: '<button type="button" class="slick-next custom-next"></button>', // Customize next arrow
                                responsive: [
                                    {
                                        breakpoint: 1024,
                                        settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 1
                                        }
                                    },
                                    {
                                        breakpoint: 768,
                                        settings: {
                                            slidesToShow: 1,
                                            slidesToScroll: 1
                                        }
                                    }
                                ]
                            });
                        });
                    </script>


<style>

.slick-prev.custom-prev {
    background-color: #e03e1f;  /* Darker green on visited */
    top: 50%;
}

.slick-next.custom-next {
    background-color: #e03e1f;  /* Darker red on hover */
    top: 50%;
}
.slick-prev.custom-prev:hover {
    background-color: #e03e1f;  /* Darker green on hover */
    top: 50%;
}

.slick-next.custom-next:hover {
    background-color: #e03e1f;  /* Darker red on hover */
    top: 50%;
}

    </style>
                    
                                        
                </div>
               
                
            </div>
           
  
        </div>
    </div>
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

        // Refresh the page and clear the session when the user clicks "OK"
        $('.close-modal-btn').click(function() {
            $('#customModal').fadeOut();
            
            // Refresh the page
            location.reload(); // This will cause the page to reload and the session will be cleared
        });
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
             <h2> Empty </h2>
             <p id="modalMessage">{{ Session::get('error') }}</p>
         </div>
         <div class="modal-footer">
             <button class="close-modal-btn">ok</button>
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


@endsection