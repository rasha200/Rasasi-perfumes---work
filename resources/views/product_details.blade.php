@extends('layouts.user_side_master')

@section('content')
<div class="main-content main-content-details single no-sidebar">
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
                        <li class="trail-item">
                            <a href="{{ route('products.byCategory', $product->subCategory->category->id) }}">
								<span>
                                    {{$product->subCategory->category->name}}
								</span>
                            </a>
                        </li>

                        <li class="trail-item">
                            <a href="{{ route('products.bySubCategory', $product->subCategory->id) }}">
								<span>
                                    {{ $product->subCategory->name }}
								</span>
                            </a>
                        </li>

                        <li class="trail-item trail-end active">
                            Glorious Eau
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="content-area content-details full-width col-lg-9 col-md-8 col-sm-12 col-xs-12">
                <div class="site-main">
                    <div class="details-product">
                        <div class="details-thumd">
                            
                            <!-- Main Image Display -->
                            <div class="image-preview-container image-thick-box image_preview_container">
                                <img id="img_zoom" 
                                     data-zoom-image="{{ asset($productImages->first()->image ?? 'default-image.jpg') }}" 
                                     src="{{ asset($productImages->first()->image ?? 'default-image.jpg') }}" 
                                     alt="img" style="height: 500px; width:540px;">
                                <a href="#" class="btn-zoom open_qv">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                            </div>
                        
                            <!-- Thumbnail Carousel -->
                            <div class="product-preview image-small product_preview">
                                <div id="thumbnails" class="thumbnails_carousel owl-carousel" 
                                     data-nav="true" 
                                     data-autoplay="false" 
                                     data-dots="false" 
                                     data-loop="false" 
                                     data-margin="10"
                                     data-responsive='{"0":{"items":3},"480":{"items":3},"600":{"items":3},"1000":{"items":3}}'>
                                    @foreach ($productImages as $productImage)
                                        <a href="#" 
                                           data-image="{{ asset($productImage->image) }}" 
                                           data-zoom-image="{{ asset($productImage->image) }}" 
                                           class="{{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ asset($productImage->image) }}" 
                                                 data-large-image="{{ asset($productImage->image) }}" 
                                                 alt="img" style="height: 120px;">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <div class="details-infor" style="margin-top:50px;">
                            <h1 class="product-title">
                                {{ $product->name }} 
                            </h1>
                            <div class="stars-rating">
                                <div class="star-rating">
                                    <span class="star-5"></span>
                                </div>
                                <div class="count-star">
                                    (7)
                                </div>
                            </div>
                            <div class="availability">
                                availability:
                                @if ($product->quantity > 0)
                                <a href="#">In Stock</a>
                            @else
                            <a href="#">Sold Out</a>
                            @endif
                            </div>
                            <div class="price">
                                @if($product->discount)
                                <del class="old-price" style="opacity: 50%;">
                                    <span id="modalOldPrice">  {{ $product->price }} JOD</span>
                                </del>
                                <span style="color:red;">{{ number_format($product->price * (1 - $product->discount / 100), 2) }} JOD</span> 
                                <span style="color:white; background-color:black; font-size:10px; border: 1px solid black; padding:1px 6px 1px 6px;">{{ $product->discount}}%</span>
                                @else
                                @if($product->old_price)
                                <del class="old-price" style="opacity: 50%;">
                                    <span id="modalOldPrice">  {{ $product->old_price }} JOD</span>
                                </del>
                                @else
                                <span></span>
                               @endif
                                <span>{{ $product->price }} JOD</span>
                                @endif
                            </div>
                            <div class="product-details-description">
                                <ul>
                                    <li>{{ $product->small_description }}</li>
                                    <li>{{$product->subCategory->category->name}}</li>
                                    <li>{{ $product->subCategory->name }}</li>
                                </ul>
                            </div>
                            
                            <div class="group-button">

                                @if ($product->quantity > 0)
                                <div class="quantity-add-to-cart">
                                   

                                    <form class="pd-detail__form"  action="{{ route('cart.add') }}" method="POST" enctype="multipart/form-data">
                                        <div class="pd-detail-inline-2">
    
                                            <div class="u-s-m-b-15">
                                                    @csrf 
                                                    <input type="hidden" name="product_id" value="{{$product->id}}" >
                                                    <input type="hidden" name="name" value="{{$product->name}}">
                                                    <input type="hidden" name="price" value="{{$product->price}}">
                                                    <input type="hidden" name="discount" value="{{$product->discount}}">
                                                    <input type="hidden" name="final_price" value="{{ $product->discount > 0 ? $product->price * (1 - $product->discount / 100) : $product->price }}">

                                                    <input type="hidden" name="small_description" value="{{$product->small_description}}">
                                                   

                                                    <div class="quantity">
                                                        <div class="control">
                                                            <a class="btn-number qtyminus quantity-minus" href="#">-</a>
                                                            <input 
                                                                type="text"  
                                                                name="quantity" 
                                                                min="1" 
                                                                max="{{ $product->quantity }}" 
                                                                value="1" 
                                                                data-step="1" 
                                                                title="Qty" 
                                                                class="input-qty qty" 
                                                                size="4"
                                                                readonly> <!-- Keep the input readonly to prevent manual editing -->
                                                            <a href="#" class="btn-number qtyplus quantity-plus">+</a>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    
                                                    <button class="single_add_to_cart_button button">Add to cart</button>
                                            </div>
                                        </div>
                                    </form>
 
                                </div>
                                @else
                                <span class="sold-out-message" style="margin-top: 30px;">Sold Out</span>
                            @endif
<style>
    .sold-out-message {
    
    color: #900A07;
    font-weight: bold;
    font-size:25px;
    display: block;
    margin-top: 10px;
}

.single_add_to_cart_button[disabled] {
    background-color: #ccc;
    cursor: not-allowed;
}

    </style>
                            </div>
                        </div>
                    </div>
                    <div class="tab-details-product">
                        <ul class="tab-link">
                            <li class="active">
                                <a data-toggle="tab" aria-expanded="true" href="#product-descriptions">Descriptions </a>
                            </li>
                        </ul>
                        <div class="tab-container">
                            <div id="product-descriptions" class="tab-panel active">
                                <p>
                                    {{ $product->description }}
                                </p>
                               
                            </div>
                           
                        </div>
                    </div>
                    <div style="clear: left;"></div>
                    <div class="related products product-grid">
                        <h2 class="product-grid-title">You may also like</h2>
                        <div class="owl-products owl-slick equal-container nav-center"  data-slick ='{"autoplay":false, "autoplaySpeed":1000, "arrows":true, "dots":false, "infinite":true, "speed":800, "rows":1}' data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":3}},{"breakpoint":"1200","settings":{"slidesToShow":2}},{"breakpoint":"992","settings":{"slidesToShow":2}},{"breakpoint":"480","settings":{"slidesToShow":1}}]'>
                            



        <!------------------------- Related Products ------------------------------>

                            @foreach($relatedProducts as $product)
                            <div class="product-item style-1">
                                <div class="product-inner equal-element">
                                    
                                    <div class="product-thumb">
                                        @if($product->discount)
                                        <div class="product-top">
                                            <div class="flash">
                                                    <span class="onnew">
                                                        <span class="text">
                                                            {{ $product->discount }}%
                                                        </span>
                                                    </span>
                                            </div>
                                           
                                        </div>
                                        @endif
                                        <div class="thumb-inner">
                                            <a href="{{ route('product_details', $product->id) }}">
                                                @if($product->product_images->isNotEmpty())
                                                <img src="{{ asset($product->product_images[0]->image) }}" alt="img" style="height: 368px; width:368px;">
                                                @else
                                            <span>No image available</span>
                                        @endif
                                            </a>
                                          
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h5 class="product-name product_title">
                                            <a href="{{ route('product_details', $product->id) }}">{{ $product->name }} </a>
                                        </h5>
                                        <div class="group-info">
                                            <div class="stars-rating">
                                                <div class="star-rating">
                                                    <span class="star-3"></span>
                                                </div>
                                                <div class="count-star">
                                                    (3)
                                                </div>
                                            </div>
                                            @if($product->discount)
                                                <div class="price">
                                                    <del>
                                                        {{ $product->price }} JOD
                                                    </del>
                                                    <ins>
                                                        {{ number_format($product->price * (1 - $product->discount / 100), 2) }} JOD
                                                    </ins>
                                                </div>
                                                @else
                                                <div class="price">
                                                    @if($product->old_price)
                                                    <del>
                                                        {{ $product->old_price }} JOD
                                                    </del>
                                                    @else
                                                     <span></span>
                                                    @endif
                                                    <ins>
                                                        {{ $product->price }} JOD
                                                    </ins>
                                                </div>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  <!------------------------- Success & error modal ------------------------------>
  @if (session('success'))
  <div id="customModal" class="custom-modal-overlay">
      <div class="custom-modal">
          <div class="modal-header">
              <div class="icon-container">
                  <i class="fa fa-check-circle success-icon"></i> <!-- Success icon -->
              </div>
          </div>
          <div class="modal-body">
              <h2>Successfully</h2>
              <p id="modalMessage">{{ session('success') }}</p>
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
             <h2> Error</h2>
             <p id="modalMessage">{{Session::get('error') }}</p>
         </div>
         <div class="modal-footer">
             <button class="close-modal-btn" >Ok</button>
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