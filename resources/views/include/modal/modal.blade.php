<!-- Modal Structure -->
@if(isset($product))
<div id="quickviewModal" class="kt-popup-quickview mfp-hide">
    <div class="details-thumb">
        <!-- Main Product Image Slider -->
        <div class="slider-product slider-for">
            <!-- First Image of the Product -->
            <div class="details-item">
                <img id="modalImage" src="{{ asset($product->product_images->first()->image ?? '/images/default-product.jpg') }}" alt="Product Image">
            </div>
        </div>

        <!-- Thumbnails Slider (optional if you want thumbnails, otherwise this can be removed) -->
        <div class="slider-nav">
            <div class="details-item">
               
            </div>
        </div>
    </div>

    <style>
       
.slider-nav {
    display: none;
}


.slider-for .details-item {
    display: block; 
}


#modalImage {
    width: 100%; 
    height: auto;
}

    </style>

    <div class="details-infor">
        <h1 id="modalTitle" class="product-title">{{ $product->name }}</h1>

        <div class="stars-rating">
            <div class="star-rating">
                <span class="star-5"></span>
            </div>
            <div class="count-star">(7)</div>
        </div>

        <div class="availability">
            Availability: <a id="modalAvailability" href="#">In Stock</a>
        </div>

        <div class="price">
            @if($product->old_price)
            <del class="old-price" style="opacity: 50%;">
                <span id="modalOldPrice"> {{ $product->old_price }} JOD</span>
            </del>
            @else

            
            <span></span>
          @endif

            <span id="modalPrice">{{ $product->price }} JOD</span>
        </div>

        <div class="product-details-description">
            <ul>
                <li id="modalSmallDescription">{{ $product->small_description }}</li>
                <li id="modalCategory">{{$product->subCategory->category->name}}</li>
                <li id="modalSubCategory">{{ $product->subCategory->name }}</li>
            </ul>
        </div>


        <div class="group-button">
            
            <div class="quantity-add-to-cart">
               
                <form class="pd-detail__form"  action="{{ route('cart.add') }}" method="POST" enctype="multipart/form-data">
                    <div class="pd-detail-inline-2">

                        <div class="u-s-m-b-15">
                                @csrf 
                                <input type="hidden" name="product_id" value="{{$product->id}}" >
                                <input type="hidden" name="name" value="{{$product->name}}">
                                <input type="hidden" name="price" value="{{$product->price}}">
                                <input type="hidden" name="small_description" value="{{$product->small_description}}">
                                <div class="quantity">
                                    <div class="control">
                                        <a class="btn-number qtyminus quantity-minus" href="#">-</a>
                                        <input type="number" name="quantity" data-step="1" data-min="1" value="1" title="Qty" max="{{$product->quantity}}"
                                               class="input-qty qty" size="4">
                                        <a href="#" class="btn-number qtyplus quantity-plus">+</a>
                                    </div>
                                </div>
                                
                                <button class="single_add_to_cart_button button">Add to cart</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endif