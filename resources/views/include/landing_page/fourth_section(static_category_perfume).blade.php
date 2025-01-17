<div class="banner-wrapp rows-space-65">
    <div class="container">
        <div class="banner">
            <div class="item-banner style17">
                <div class="inner">
                    @foreach($categories->slice(0, 1) as $category)
                    <div class="banner-content">
                        <h3 class="title">Collection Arrived</h3>
                        <div class="description">
                            You have no items & Are you <br/>ready to use? come & shop with us!
                        </div>
                        <div class="banner-price">
                            Price from:
                            <span class="number-price">10.00 JOD </span>
                        </div>
                        <a href="{{ route('products.byCategory', $category->id) }}" class="button btn-shop-now">Shop now</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>