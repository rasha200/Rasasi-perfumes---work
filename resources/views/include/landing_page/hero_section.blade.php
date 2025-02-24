<div class="home-slider-banner">
    <div class="container">
        <div class="row10">
            <div class="col-lg-8 silider-wrapp">
                <div class="home-slider">
                    
                    <div class="slider-owl owl-slick equal-container nav-center"
     data-slick='{"autoplay":true, "autoplaySpeed":4000, "arrows":true, "dots":true, "infinite":true, "speed":1000, "rows":1}'
     data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":1}}]'>
    
    @foreach($discountedSubCategories as $subcategory)
        <div class="slider-item style7">
            <div class="slider-inner equal-element" style="background-image: url({{ asset('uploads/subcategory/' . $subcategory->image) }});  background-repeat: no-repeat; ">
                <div class="slider-infor" style="height:625px !important;">
                    @if($subcategory->discount > 0)
                    <h5 class="title-small">
                        Sale up to {{ $subcategory->discount }}% off!
                    </h5>
                    @else
                    <h5 class="title-small">
                        Shop unique collection
                    </h5>
                    @endif
                    <h3 class="title-big">
                        {{ $subcategory->name }} Collection
                    </h3>
                    <a href="{{ route('products.bySubCategory', $subcategory->id) }}" class="button btn-shop-the-look bgroud-style" >Shop now</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

                </div>
            </div>


            <div class="col-lg-4 banner-wrapp">
                
                <div class="banner">

                    <div class="item-banner style7">
                        <div class="inner">
                            @foreach($categories->slice(0, 1) as $category)
                            <div class="banner-content" style="background-image: url({{ asset('uploads/category/' . $category->image) }}) !important; background-repeat: no-repeat;">
                                <h3 class="title">Pick Your <br/>Items</h3>
                                <div class="description" style="color:black;">
                                    Discover the special collection of {{ $category->name }}
                                </div>
                                <a href="{{ route('products.byCategory', $category->id) }}" class="button btn-lets-do-it">Shop now</a>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>


                <div class="banner">
                    <div class="item-banner style8">
                        <div class="inner">
                            @if ($topProduct)
                            <div class="banner-content" style="
                              background-image: linear-gradient(rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.4)), 
                              url('{{ asset($topProduct->product_images[0]->image) }}'); 
                              background-size: 375px 306px !important; 
                              background-position: center center; 
                              background-repeat: no-repeat;
                              height: 306px;">

                                <h3 class="title">Our top<br/>Product,</h3>
                                <div class="description" style="color:black;">
                                    built for quality and reliability
                                    
                                </div>
                               

                                <a href="{{ route('product_details', $topProduct->id) }}"> <span class="price"> {{ $topProduct->name }}</span> </a>
                              

                                <a href="{{ route('product_details', $topProduct->id) }}" class="button btn-lets-do-it">Shop now</a>

                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
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

.slick-dots li button:before {
    font-size:0px !important;
}



.slider-owl,
.slider-item {
    width: 100%;  /* Ensure the slider and item elements take up the full width of their parent */
    padding: 0; /* Remove padding if any */
    margin: 0; /* Remove margin if any */
}





</style>