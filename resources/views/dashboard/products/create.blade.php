@extends('layouts.dashboard_master')



@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">

  <div class="pagetitle" style="margin-top: 30px;">
    <h1><i class="bi bi-bag "></i> Add new product</h1>
  </div>
   
</div>

@if ($errors->any())
<div class="alert alert-danger">
<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
</div>
@endif


<div class="card">
  <div class="card-body">
    
    <h5 class="card-title"></h5>
                   
                    <form class="row g-3" action="{{ route('products.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}" required>
                      </div>

                      <div class="col-12">
                        <label for="image" class="form-label">Choose product images</label>
                        <input type="file" name="image[]" id="image" class="form-control" multiple/>
                      </div>


                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Small Description</label>
                        <input type="text" class="form-control" id="small_description" placeholder="Small Description" name="small_description" value="{{ old('small_description') }}" required>
                      </div>

                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Description</label>
                        <textarea class="form-control" id="description" placeholder="Description" name="description" required>{{ old('description') }}</textarea>
                      </div>

                      <div class="col-12">
                        <label for="exampleInputEmail3">Old price</label>
                        <input type="text" class="form-control" id="old_price" placeholder="Old price" name="old_price" value="{{ old('old_price') }}" >
                      </div>

                      <div class="col-12">
                        <label for="exampleInputEmail3">Price</label>
                        <input type="text" class="form-control" id="price" placeholder="Price" name="price" value="{{ old('price') }}" required>
                      </div>

                      <div class="col-12">
                        <label for="exampleInputEmail3">Discount (%)</label>
                        <input type="number" class="form-control" id="old_price" placeholder="Discount" name="discount" value="{{ old('discount', $product->discount ?? '') }}" min="0" max="100" >
                      </div>
                     

                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" placeholder="Quantity" name="quantity" value="{{ old('quantity') }}" min="1" step="1">
                      </div>
                     

                      <div class="col-12">
                        <label for="exampleSelectGender" class="form-label">Brand</label>

                        <select class="form-control form-control-sm" id="subCategory_id" name="subCategory_id">
                            @foreach ($SubCategories as $SubCategory)
                            <option value="{{$SubCategory->id}}" {{ old('subCategory_id') == $SubCategory->id ? 'selected' : '' }} >{{ $SubCategory->category->name ?? 'No Category' }} - {{$SubCategory->name}} </option>
                            @endforeach
                        </select>

                      </div>

                      <div class="text-center">
                      <button type="submit" class="btn btn-info">Create</button>
                      <a href="{{route('products.index')}}" class="btn btn-secondary">Cancel</a>
                      </div>
                    </form>
                  </div>
                </div>
@endsection