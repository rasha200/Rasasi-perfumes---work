<div class="product-in-stock-wrapp">
    <div class="container">
        <h3 class="custommenu-title-blog white">
            New Arrivals
        </h3>
        <div class="stelina-product style3">
            <ul class="row list-products auto-clear equal-container product-grid">
                @foreach ($latestProduct->slice(0, 9) as $product)
                <li class="product-item  col-lg-4 col-md-6 col-sm-6 col-xs-6 col-ts-12 style-3">
                    <div class="product-inner equal-element">
                        <div class="product-thumb">
                            <div class="product-top">
                                <div class="flash">
                                        <span class="onnew">
                                            <span class="text">
                                                new
                                            </span>
                                        </span>
                                </div>
                               
                            </div>
                            <div class="thumb-inner ">
                               
                                <a href="{{ route('product_details', $product->id) }}" tabindex="0">
                                    <div class="new-label">New</div>
                                    @if($product->product_images->isNotEmpty())
                                    <img src="{{ asset($product->product_images[0]->image) }}" alt="img" style="height: 140px; width:140px">
                                    @else
                                    <span>No image available</span>
                                @endif
                                </a>
                            </div>
                           
                        </div>
                        <div class="product-info">
                            <h5 class="product-name product_title">
                                <a href="{{ route('product_details', $product->id) }}" tabindex="0">{{ $product->name }}</a>
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
                                    <span>{{ $product->price }} JOD</span>
                                </div>
                            </div>
                            <div class="group-buttons">
                                <div class="quantity">
                                    <div class="control">
                                        <a class="btn-number qtyminus quantity-minus" href="#">-</a>
                                        <input type="text" data-step="1" data-min="0" value="1" title="Qty"
                                               class="input-qty qty" size="4">
                                        <a href="#" class="btn-number qtyplus quantity-plus">+</a>
                                    </div>
                                </div>
                                <a href="{{ route('product_details', $product->id) }}" class="add_to_cart_button button" tabindex="0">Shop now</a>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<style>
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