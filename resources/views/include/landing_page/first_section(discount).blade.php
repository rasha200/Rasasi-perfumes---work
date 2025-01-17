<div class="stelina-product produc-featured rows-space-65">
    <div class="container">
        <h3 class="custommenu-title-blog">
            Discount
        </h3>
        <div class="owl-products owl-slick equal-container nav-center"
        data-slick='{"autoplay":false, "autoplaySpeed":1000, "arrows":true, "dots":true, "infinite":false, "speed":800, "rows":1}'
        data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":4}},{"breakpoint":"1200","settings":{"slidesToShow":3}},{"breakpoint":"992","settings":{"slidesToShow":2}},{"breakpoint":"480","settings":{"slidesToShow":1}}]'>
   
             @foreach ($discountedProducts as $product)
             <div class="product-item style-5">
                <div class="product-inner equal-element">
                  
                    <div class="product-thumb">

                        <div class="product-top">
                            <div class="flash">
                                    <span class="onnew">
                                        <span class="text">
                                            {{ $product->discount }}%
                                        </span>
                                    </span>
                            </div>
                           
                        </div>
                        <div class="thumb-inner">
                            <a href="{{ route('product_details', $product->id) }}">
                                @if($product->product_images->isNotEmpty())
                                <img src="{{ asset($product->product_images[0]->image) }}" alt="img" style="height: 250px;">
                                @else
                                <span>No image available</span>
                            @endif
                            </a>
                            
                        </div>
                       
                    </div>
                    <div class="product-info">
                        <h5 class="product-name product_title">
                            <a href="{{ route('product_details', $product->id) }}">{{ $product->name }}</a>
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
                            <div class="price">
                                <del>
                                    {{ $product->price }} JOD
                                </del>
                                <ins>
                                    {{ number_format($product->price * (1 - $product->discount / 100), 2) }} JOD
                                </ins>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


<style>

.slick-prev, .slick-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1;
    background: #ccc; /* Example style */
    border-radius: 50%;
    width: 30px;
    height: 30px;
}
.slick-prev {
    left: -35px;
}
.slick-next {
    right: -35px;
}


    .new-label {
        font-size: 12px;
	    border-radius: 20px;
	    font-weight: 500;

        position: absolute;
        top: 10px;  /* Adjusts the distance from the top */
        left: 10px; /* Adjusts the distance from the left */
        text-transform: capitalize;
	display: inline-block;
	float: left;
	line-height: 22px;
	height: 22px;
	min-width: 44px;
	padding: 0 5px;
	text-align: center;
	background-color: #900A07;
	color: #fff;
       
        z-index: 10;  /* Ensures it stays on top of the image */
    }
    
    .card {
        position: relative;
    }

    
    </style>