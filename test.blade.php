@forelse($cart as $item)
<!--====== Row ======-->
<tr>
    <td>
        <div class="table-p__box">
            <div class="table-p__img-wrap">
                @php
                    $product = \App\Models\product::find($item['product_id']);
                    $image= $product->images->first()->path;
                @endphp

                <img class="u-img-fluid" src="{{asset('storage/' . $image)}}" alt="{{ $item['name'] }}">
            </div>
            <div class="table-p__info">

                    <span class="table-p__name">

                        <a href="{{route('productDetails' , $item['product_id'])}}">{{$item['name']}}</a></span>

                <span class="table-p__category">
                @php
                    $category = $product->subCategory->name;
                @endphp
                    <a href="">{{$category}}</a></span>
                <ul class="table-p__variant-list">
                    <li>

                        <span>Quantity: {{$product->quantity}}</span>

                    </li>

                </ul>
            </div>
        </div>
    </td>
    <td>

        <span class="table-p__price">${{$item['price']}}</span></td>
    <td>
        <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" class="input-counter-form">
            @csrf
            <div class="table-p__input-counter-wrap">
                <div class="input-counter">
                    <span class="input-counter__minus fas fa-minus" onclick="updateQuantity({{ $item['product_id'] }}, -1)"></span>
                    <input
                        class="input-counter__text input-counter--text-primary-style"
                        type="number"
                        name="quantity"
                        data-product-id="{{ $item['product_id'] }}"
                        value="{{ $item['quantity'] }}"
                        min="1"
                        required
                    >

                    <span class="input-counter__plus fas fa-plus" onclick="updateQuantity({{ $item['product_id'] }}, 1)"></span>
                </div>

            </div>
        </form>
    </td>
    <td>
        <form action="{{ route('cart.delete', $item['product_id']) }}" method="POST">
            @csrf
            <button type="submit" class="far fa-trash-alt table-p__delete-link" onclick="return confirm('Are you sure you want to remove this item?');"></button>
        </form>
    </td>
</tr>
<!--====== End - Row ======-->
@empty
<tr>
    <td colspan="5" class="text-center">Your cart is empty!</td>
</tr>
@endforelse