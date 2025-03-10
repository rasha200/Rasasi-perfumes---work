@extends('layouts.dashboard_master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

  <div class="pagetitle" style="margin-top: 30px;">
    <h1><i class="bi bi-bag "></i> Products</h1>
  </div>
  
        <a href="{{ route('products.create') }}" style="margin-top: 30px;">
            <button type="button" class="btn btn-info">
                <i class="zmdi zmdi-plus"></i> Add new product
            </button>
        </a>
      
</div>

    
 
    
    @if(session('error'))
  
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="bi bi-exclamation-octagon me-1"></i>
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    @if(session('success'))
   
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-1"></i>
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif



<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title"></h5>

          <!-- Table with stripped rows -->
          <table class="table datatable">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Image</th>
                          <th>Brand</th>
                          <th>Price</th>
                          <th>Discount</th>
                          <th>Quantity</th>
                          <th>Is bestseller</th>
                          <th>Is new</th>
                          <th>Top product</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($products as $product)
                        <tr>
                          <td>{{$product->id}}</td>

                          <td title="view">
                            <a href="{{ route('products.show', $product->id) }}"
                              style="color:#000000;"
                              onmouseover="this.style.color='#10db8c';" 
                             onmouseout="this.style.color='#000000';"  
                            title="View">
                            {{$product->name}}
                            </a>
                            <br>
                            <span style="color:#f9ba48;"> 
                              @for ($i = 1; $i <= 5; $i++)
                              <i class="zmdi {{ $i <= $product->average_rating ? 'zmdi-star' : 'zmdi-star-outline' }}" style="display: inline-block; vertical-align: middle;"></i>
                              @endfor
                              </span>
                          </td>


                          <td>
                            @if($product->product_images->isNotEmpty())
                
                            <img src="{{ asset($product->product_images[0]->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 40px; " />
                        @else
                            <span>No image available</span>
                        @endif
                        </td> 
                        <td>{{$product->subCategory->category->name}} - {{$product->subCategory->name}}</td>
                          <td>{{$product->price}}</td>
                          
                          @if($product->discount)
                          <td>{{$product->discount}}%</td>
                          @else
                          <td></td>
                          @endif

                          <td>{{$product->quantity}}</td>
                         

                          <td>
                            <form action="{{ route('product.toggle-status', ['id' => $product->id, 'type' => 'bestseller']) }}" method="POST">
                              @csrf
                              <div class="form-check form-switch">
                                  <input class="form-check-input" type="checkbox" name="is_bestseller" id="bestseller-{{ $product->id }}" 
                                      {{ $product->is_bestseller === 'true' ? 'checked' : '' }}
                                      onchange="this.form.submit()">
                                  <label class="form-check-label" for="bestseller-{{ $product->id }}">Best Seller</label>
                              </div>
                            </form>
                          </td>
                    
                          
                          <td>
                            <form action="{{ route('product.toggle-status', ['id' => $product->id, 'type' => 'new']) }}" method="POST">
                              @csrf
                              <div class="form-check form-switch">
                                  <input class="form-check-input" type="checkbox" name="is_new" id="new-{{ $product->id }}" 
                                      {{ $product->is_new === 'true' ? 'checked' : '' }}
                                      onchange="this.form.submit()">
                                  <label class="form-check-label" for="new-{{ $product->id }}">New</label>
                              </div>
                            </form>
                          </td>


                          <td>
                            <form action="{{ route('product.toggle-status', ['id' => $product->id, 'type' => 'top_product']) }}" method="POST">
                                @csrf
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="top_product" id="top_product-{{ $product->id }}" 
                                        {{ $product->top_product ? 'checked' : '' }}
                                        onchange="this.form.submit()">
                                    <label class="form-check-label" for="top_product-{{ $product->id }}">Top product</label>
                                </div>
                            </form>
                        </td>


                          <td> 

                          <a href="{{ route('products.edit', $product->id) }}"  title="Edit">
                          <button type="button" class="btn btn-info">
                            <i class="bi bi-pencil"></i>
                          </button>
                          </a>
                          
                         


                          
                          <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;" title="Delete">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger"  onclick="confirmDeletion(event, '{{ route('products.destroy', $product->id) }}')">
                              <i class="bi bi-archive"></i>
                          </button>
                        </form>
                                           
                        </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
          </section>

<!-- Custom Confirmation Modal -->
<div id="confirmationModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <p>Are you sure you want to delete this product?</p>
        <button id="confirmButton" class="btn btn-outline-danger">Delete</button>
        <button id="cancelButton" class="btn btn-outline-secondary">Cancel</button>
    </div>
</div>

<script>
    function confirmDeletion(event, url) {
        event.preventDefault(); // Prevent the default form submission -. تريد منع نموذج من الإرسال عند النقر على زر الإرسال
        var modal = document.getElementById('confirmationModal');
        var confirmButton = document.getElementById('confirmButton');
        var cancelButton = document.getElementById('cancelButton');

        // Show the custom confirmation dialog
        modal.style.display = 'flex';

        // Set up the confirm button to submit the form
        confirmButton.onclick = function () {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            var csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            // "hidden" يُستخدم للإشارة إلى طرق مختلفة لجعل العناصر غير مرئية أو مخفية
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}'; // Laravel CSRF token
            form.appendChild(csrfToken);

            var methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            document.body.appendChild(form);
            form.submit();
        };

        // Set up the cancel button to hide the modal
        cancelButton.onclick = function () {
            modal.style.display = 'none';
        };
    }
</script>



<script>
  function toggleProductStatus(productId, type) {
      fetch(`/product/toggle-status/${productId}/${type}`, {
          method: 'POST',
          headers: {
              'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              console.log(data.message);
          } else {
              console.error(data.message);
          }
      })
      .catch(error => console.error('Error:', error));
  }
  </script>

@endsection