@extends('layouts.dashboard_master')


@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

  <div class="pagetitle" style="margin-top: 30px;">
    <h1><i class="bi bi-cart "></i> Order-number ({{ $order->id }}) </h1>
  </div>
  
        
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


<div class="card">
<div class="card-body" style="border: 1px solid #e7dee9;">
        
        <p align="center" style="margin-top: 50px;"><strong></strong> </p>

   

        


        <div class="accordion" id="accordionFlushExample" style="margin-bottom:30px;">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
               User Information
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body"><strong>User name:</strong> {{$order->user->Fname}} {{$order->user->Lname}}</div>
              <div class="accordion-body"><strong>Email:</strong> {{ $order->email }}</div>
              <div class="accordion-body"><strong>Mobile number:</strong> {{ $order->mobile }}</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                Location
              </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body"><strong>City:</strong> {{ $order->city }} </div>
              <div class="accordion-body"><strong>Street:</strong>  {{ $order->street }} </div>
              <div class="accordion-body"><strong>Building number:</strong>   {{ $order->building_number }}</div>

            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                Order information
              </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
              
              <div class="accordion-body"> <strong>Order status:</strong>   <span 
                class="badge" 
                style="background-color: 
                    {{ $order->order_status == 'Pending' ? '#FFA500' : 
                       ($order->order_status == 'Processing' ? '#007BFF' : 
                       ($order->order_status == 'Completed' ? '#28A745' : '#000')) }};
                    color: white; 
                    padding: 5px 10px; 
                    border-radius: 5px;"
            >
                {{ $order->order_status }}
            </span> </div>
              <div class="accordion-body"><strong>Note:</strong>  {{ $order->note }} </div>
              <div class="accordion-body"><strong>Total price:</strong>  {{ $order->total_price }} JOD</div>
            </div>
          </div>
        </div><!-- End Accordion without outline borders -->




        <table class="table datatable" >
            <thead>
              <tr>
                <th>Id</th>
                <th>Product name</th>
                <th>Image</th>
                <th>Brand</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Total price</th>
               
              </tr>
            </thead>
            <tbody>
              @foreach($orderDetails as $orderDetail)
              <tr>
                <td>{{$orderDetail->id}}</td>

                <td> {{$orderDetail->product->name}} </td>

                <td>
                  @if($orderDetail->product->product_images->isNotEmpty())
      
                  <img src="{{ asset($orderDetail->product->product_images[0]->image) }}"  style="width: 50px; height: 40px; " />
              @else
                  <span>No image available</span>
              @endif
              </td> 

                <td>{{$orderDetail->product->subCategory->category->name}} - {{$orderDetail->product->subCategory->name}}</td> 

                <td>{{$orderDetail->quantity}}</td>
                
                <td>{{$orderDetail->price}} JOD</td>

                <td>{{$orderDetail->discount}}%</td>

                <td>{{$orderDetail->total_price}} JOD</td>

              </tr>
              @endforeach
            </tbody>
          </table>

       
          <div class="text-center">
            <!-- Set to Processing Button -->
            <form id="processingForm" action="{{ route('order.update', $order->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('PUT')
                <input type="hidden" name="order_status" value="Processing">
                <button type="button" class="btn btn-dark btn-fw" style="margin-right: 15px; margin-top:30px;" 
                        data-bs-toggle="modal" data-bs-target="#confirmModal" data-status="Processing">Set to Processing</button>
            </form>
        
            <!-- Set to Completed Button -->
            <form id="completedForm" action="{{ route('order.update', $order->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('PUT')
                <input type="hidden" name="order_status" value="Completed">
                <button type="button" class="btn btn-info btn-fw" style="margin-right: 15px; margin-top:30px;" 
                        data-bs-toggle="modal" data-bs-target="#confirmModal" data-status="Completed">Set to Completed</button>
            </form>
        
            <a href="{{ route('order.index') }}" class="btn btn-secondary btn-fw" style="margin-top:30px;">Back to list</a>
        </div>
        




<!----------Confirm Modal --------------------->

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- Center the modal -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Confirm Order Status Change</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to change the order status?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <!-- The button will change dynamically -->
        <button type="button" id="confirmButton" class="btn btn-fw" data-bs-dismiss="modal" style="background-color: #6c757d;">Confirm</button>
      </div>
    </div>
  </div>
</div>



<script>
  document.querySelectorAll('button[data-bs-toggle="modal"]').forEach(button => {
      button.addEventListener('click', function() {
          // Get the status (Processing or Completed)
          var status = this.getAttribute('data-status');  

          // Get the class (btn-dark or btn-info) of the clicked button
          var buttonClass = this.classList.value;  

          // Get the form related to the clicked button
          var form = document.getElementById(status.toLowerCase() + 'Form');
          form.querySelector('input[name="order_status"]').value = status;

          // Update the modal's confirm button class to match the clicked button
          var confirmButton = document.getElementById('confirmButton');
          confirmButton.className = buttonClass;  // Set the same class as the clicked button

          // Update the text of the confirm button
          confirmButton.textContent = "Confirm " + status;  // Update text to match the status

          // Set up the confirm button to submit the form when clicked
          confirmButton.onclick = function() {
              form.submit();
          };
      });
  });
</script>



@endsection