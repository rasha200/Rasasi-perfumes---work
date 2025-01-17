<div class="banner-wrapp" style="margin-bottom: 50px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="banner">
                    <div class="item-banner style4">
                        <div class="inner">
                            @foreach($categories->slice(3, 1) as $category)
                            <div class="banner-content" style="background-image: url({{ asset('uploads/category/' . $category->image) }}) !important">
                                <h4 class="stelina-subtitle">TOP STAFF PICK</h4>
                                <h3 class="title">Best Collection</h3>
                                <div class="description">
                                    Explore our exclusive selection tailored just for you 
                                </div>
                                <a href="{{ route('products.byCategory', $category->id) }}" class="button btn-shop-now">Shop now</a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="banner">
                    <div class="item-banner style5">
                        <div class="inner">
                            @foreach($categories->slice(4, 1) as $category)
                            <div class="banner-content" style="background-image: url({{ asset('uploads/category/' . $category->image) }}) !important">
                                <h3 class="title">Discover unique <br/>choices made</h3>
                                <span class="code">
                                    to match your
                                        <span>
                                            style
                                        </span><br>
                                        and needs
                                    </span>
                                <a href="{{ route('products.byCategory', $category->id) }}" class="button btn-shop-now">Shop now</a>
                            </div>   
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
