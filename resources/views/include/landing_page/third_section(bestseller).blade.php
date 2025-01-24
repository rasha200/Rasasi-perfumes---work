 
        <div class="stelina-tabs  default rows-space-40">
            <div class="container">

               
                <div class="tab-head">
                    <ul class="tab-link">
                        <li class="active">
                            <a data-toggle="tab" aria-expanded="true" href="#bestseller">Bestseller</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" aria-expanded="true" href="#top-rated">Top Rated</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-container">
                    <div id="bestseller" class="tab-panel active">
                        <div class="stelina-product">
                            <ul class="row list-products auto-clear equal-container product-grid">
                                @foreach ($bestseller as $product)
                                <li class="product-item  col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1">
                                    <div class="product-inner equal-element">
                                        <div class="product-top">
                                           
                                        </div>
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
                                                    <span style="color:#f9ba48;"> 
                                                        @for ($i = 1; $i <= 5; $i++)
                                                        <i class="zmdi {{ $i <= $product->average_rating ? 'zmdi-star' : 'zmdi-star-outline' }}" style="display: inline-block; vertical-align: middle;"></i>
                                                       @endfor
                                                    </span>
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
                                </li>
                                @endforeach 
                            </ul>
                        </div>
                    </div>
                  



                    <div id="top-rated" class="tab-panel">
                        <div class="stelina-product">
                            <ul class="row list-products auto-clear equal-container product-grid">

                                 @foreach ($topRatedProducts as $product)
                                <li class="product-item  col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1">
                                    <div class="product-inner equal-element">
                                        <div class="product-top">
                                           
                                        </div>
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
                                                    <span style="color:#f9ba48;"> 
                                                        @for ($i = 1; $i <= 5; $i++)
                                                        <i class="zmdi {{ $i <= $product->average_rating ? 'zmdi-star' : 'zmdi-star-outline' }}" style="display: inline-block; vertical-align: middle;"></i>
                                                       @endfor
                                                    </span>
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
                                </li>
                                @endforeach 
                             
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>