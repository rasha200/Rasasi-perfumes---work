@extends('layouts.user_side_master')

@section('content')


<div class="container mt-5" style="margin-bottom: 50px;">
    <div class="breadcrumb-trail breadcrumbs">
        <ul class="trail-items breadcrumb">
            <li class="trail-item trail-begin">
                
                <a href="{{ route('home') }}">
                    <span>
                        Home
                    </span>
            </a>
               
            </li>
            <li class="trail-item trail-end active">
                    <span>
                       Profile
                    </span>
            </li>
        </ul>
    </div>
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 col-md-4 mb-4" style="border:1px solid #f1f1f1; padding: 25px 40px;">
            <div class="card p-3">
                <div class="text-center mb-3">
                    <img src="{{asset("landing_page/assets/images/user.svg")}}" alt="User Photo" class="rounded-circle" width="100">
                </div>
                <h4 class="text-center">{{ auth()->user()->Fname }} {{ auth()->user()->Lname }}</h4>
                <p class="text-muted text-center">{{ auth()->user()->email }}</p>
                <hr>
                <ul class="nav flex-column" id="profileTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" href="#profile" data-target="#profile">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="orders-tab" href="#orders" data-target="#orders">Order History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <style>
            #profile:hover {
                box-shadow: 0 0 10px #ddd;
            }
            
            #orders:hover {
                box-shadow: 0 0 10px #ddd;
            }
            
            .col-lg-3.col-md-4.mb-4:hover {
                box-shadow: 0 0 10px #ddd;
            }
            
        </style>

        <!-- Content -->
        <div class="col-lg-9 col-md-8">
            <div class="card p-4">
                <div class="tab-content">
                    <!-- Profile Tab -->
                    <div class="tab-pane show active" id="profile" style="border:1px solid #f1f1f1; padding: 25px 40px;">
                        <h3 class="mb-4" style="margin-left: 15px; margin-bottom: 15px;">My Profile</h3>
                        <form action="{{ route('profile.update') }}" method="POST" class="login"  id="profileForm">
                            @csrf
                            @method('PUT')
                            <div class="col-sm-6">
                             <p class="form-row form-row-wide">
                                <label for="fname" class="text">First Name</label>
                                <input type="text" class="form-control" id="fname" name="Fname" value="{{ auth()->user()->Fname }}" required>
                             </p>
                            </div>

                             <div class="col-sm-6">
                             <p class="form-row form-row-wide">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="Lname" id="lname" value="{{ auth()->user()->Lname }}" required>
                             </p>
                            </div>

                             <div class="col-sm-6">
                             <p class="form-row form-row-wide">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                             </p>
                            </div>

                            <div class="col-sm-6">
                             <p class="form-row form-row-wide">
                                <label for="email" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" value="{{ auth()->user()->mobile ?? '' }}" required>
                             </p>
                            </div>

                            <div class="col-sm-12">
                                <p class="form-row form-row-wide">
                                   <label for="email" class="form-label">Current Password</label>
                                   <input type="password" class="form-control" id="current_password" name="current_password" >
                                </p>
                               </div>

                               <div class="col-sm-6">
                                <p class="form-row form-row-wide">
                                   <label for="email" class="form-label">New Password</label>
                                   <input type="password" class="form-control" id="new_password" name="new_password" >
                                </p>
                               </div>

                               <div class="col-sm-6">
                                <p class="form-row form-row-wide">
                                   <label for="email" class="form-label">Confirm New Password</label>
                                   <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" >
                                </p>
                               </div>
                               <button type="button" onclick="showConfirmModal()" class="button-submit" style="margin-left: 15px;">Save</button>

                            </form>
                        </div>
                        
                        <!-- Confirmation Modal -->
                        <div id="confirmModal" class="custom-modal-overlay" style="display: none;">
                            <div class="success-modal">
                                <div class="modal-header">
                                    <div class="icon-container">
                                        <i class="fa fa-question-circle" style="font-size: 55px;"></i> <!-- Question Icon -->
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <h2>Are you sure?</h2>
                                    <p>Do you really want to update your profile? This action cannot be undone.</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="confirm-btn" onclick="closeConfirmModal()">Cancel</button>
                                    <button class="confirm-btn" onclick="submitForm()">Yes</button>
                                </div>
                            </div>
                        </div>

<script>
 // Show confirmation modal
function showConfirmModal() {
    document.getElementById('confirmModal').style.display = 'flex'; // Flexbox to center the modal
}

// Close the confirmation modal
function closeConfirmModal() {
    document.getElementById('confirmModal').style.display = 'none'; // Hide the modal
}

// Submit the form when confirmed
function submitForm() {
    document.getElementById('profileForm').submit(); // Ensure the form is being submitted
}

</script>

                    <!-- Orders Tab -->
                    <div class="tab-pane" id="orders" style="border:1px solid #f1f1f1; padding: 25px 40px;">
                        <h3 class="mb-4">Order History</h3>
                        @if ($orders->isNotEmpty())
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $index => $order)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                            <td>{{ number_format($order->total_price, 2) }} JOD</td>
                                            <td>
                                                <span 
                                                class="badge" 
                                                style="background-color: 
                                                {{ $order->order_status == 'Pending' ? '#FFA500' : 
                                                ($order->order_status == 'Processing' ? '#007BFF' : 
                                                ($order->order_status == 'Completed' ? '#28A745' : '#000')) }};
                                                color: white; 
                                                padding: 5px 10px; 
                                                border-radius: 5px;">
                                                  {{ $order->order_status }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="#" 
                                                class="btn btn-sm btn-primary view-order"
                                                data-id="{{ $order->id }}"
                                                data-date="{{ $order->created_at->format('Y-m-d') }}"
                                                data-total-price="{{ number_format($order->total_price, 2) }}"
                                                data-status="{{ $order->order_status }}"
                                                data-products="{{ json_encode($order->orderDetails->map(function ($detail) {
                                                     return [
                                                         'product' => $detail->product->name,
                                                         'quantity' => $detail->quantity,
                                                         'price' => $detail->price,
                                                         'discount' => $detail->discount,
                                                         'total' => $detail->total_price,
                                                     ];
                                                 })) }}"
                                                style="background-color:#900A07;">
                                                   View
                                                </a>
                                              </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Your order history will be displayed here.</p>
                        @endif
                    </div>

<!-- Custom Order Details Modal -->
<div id="orderDetailsModal" class="custom-modal-overlay" style="display: none;">
    <div class="custom-modal">
        <h2>Order Details</h2>
        
    <div class="order-info">
        <p><strong>Order ID:</strong> <span id="orderId"></span></p>
        <p><strong>Order Date:</strong> <span id="orderDate"></span></p>
        <p><strong>Status:</strong> <span id="orderStatus"></span></p>
    </div>

        <div class="modal-header" style="padding: 0px;">
           
        </div>

        
        <div class="modal-body">
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="orderDetailsTableBody"></tbody>

                
            </table>
            <p class="total-price"><strong>Total Price:</strong> <span id="totalPrice"></span> JOD</p>
        </div>
        <div class="modal-footer">
            <button class="close-modal-btn">Close</button>
        </div>
    </div>
</div>


<style>

    .total-price {
        text-align: right;
        margin-top: 20px;  /* Optional: Adjusts space from the table */
        font-weight: bold; /* Optional: Makes the total price text bolder */
    }
    
    .order-info {
        display: flex;
        justify-content: space-between;
        gap: 20px;  /* Optional, for spacing between the elements */
        margin-bottom: 0px;  /* Space below the info */
        margin-top: 17px;
    }
    
    .order-info p {
        margin: 0; /* Remove default margin */
        flex: 1;   /* Optional: makes the p elements take equal width */
    }
    
    /* Style for modal overlay */
    .custom-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);  /* Darken background */
        display: flex;
        justify-content: center;
        align-items: center;  /* Centers the modal vertically and horizontally */
        z-index: 1000;
        display: none;  /* Hide initially */
    }
    
    /* Style for modal */
    .custom-modal {
        background: white;
        border-radius: 8px;
        width: 70%;  /* Adjust this for modal width */
        max-width: 900px;  /* Set a maximum width */
        max-height: 80vh;  /* Restrict the modal's height to 80% of the viewport */
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        position: relative;
    }
    
    /* Make the modal body scrollable if content is too large */
    .custom-modal .modal-body {
        overflow-y: auto;
        max-height: calc(80vh - 120px);  /* Adjust based on modal header/footer height */
    }
    
    /* Style for modal header */
    .custom-modal .modal-header {
        padding: 15px;
        border-bottom: 1px solid #ddd;
        font-size: 24px;
     
        font-weight: bold;
    }
    
    /* Style for modal footer */
    .custom-modal .modal-footer {
        padding: 10px;
        border-top: 1px solid #ddd;
        text-align: right;
    }
    
    /* Style for the close button */
    .custom-modal .close-modal-btn {
        background-color: #900A07;
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        border-radius: 5px;
    }
    .custom-modal .close-modal-btn:hover {
        background-color: #7a0805;
    }

    



    
    
        
        </style>
    

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Event listener for the 'View' button
    document.querySelectorAll('.view-order').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();  // Prevent default behavior of link

            // Get order data from data-* attributes
            const orderId = this.getAttribute('data-id');
            const orderDate = this.getAttribute('data-date');
            const totalPrice = this.getAttribute('data-total-price');
            const orderStatus = this.getAttribute('data-status');
            const products = JSON.parse(this.getAttribute('data-products'));

            // Populate modal fields
            document.getElementById('orderId').textContent = orderId;
            document.getElementById('orderDate').textContent = orderDate;
            document.getElementById('totalPrice').textContent = totalPrice;
            document.getElementById('orderStatus').textContent = orderStatus;

            // Populate product details in the table
            const orderDetailsTableBody = document.getElementById('orderDetailsTableBody');
            orderDetailsTableBody.innerHTML = '';  // Clear previous data

            products.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${product.product}</td>
                    <td>${product.quantity}</td>
                    <td>${product.price} JOD</td>
                    <td>${product.discount}%</td>  <!-- Display discount here -->
                    <td>${product.total} JOD</td>
                `;
                orderDetailsTableBody.appendChild(row);
            });

            // Show the modal (no display:none, will trigger fadeIn)
            document.getElementById('orderDetailsModal').style.display = 'flex';  // Changed to 'flex' to show as a flex container
        });
    });

    // Close the modal when the user clicks "Close"
    document.querySelector('.close-modal-btn').addEventListener('click', function () {
        document.getElementById('orderDetailsModal').style.display = 'none';
    });

    // Close modal if clicked outside of it
    window.addEventListener('click', function(event) {
        if (event.target === document.getElementById('orderDetailsModal')) {
            document.getElementById('orderDetailsModal').style.display = 'none';
        }
    });
});


</script>





                </div>
            </div>
        </div>
    </div>
</div>



  <!------------------------- Success & error modal ------------------------------>

  

@if (Session::get('success') )
    <div id="customModal" class="custom-modal-overlay">
        <div class="success-modal">
            <div class="modal-header">
                <div class="icon-container">
                    <i class="fa fa-check-circle success-icon"></i> <!-- Success icon -->
                </div>
            </div>
            <div class="modal-body">
                <h2> Successfully </h2>
                <p id="modalMessage">{{ Session::get('success') }}</p>
            </div>
            <div class="modal-footer">
                <button class="close-modal-btn">OK</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Show the modal
            $('#customModal').fadeIn();
  
            // Refresh the page and clear the session when the user clicks "OK"
            $('.close-modal-btn').click(function() {
                $('#customModal').fadeOut();
                
                // Refresh the page
                location.reload(); // This will cause the page to reload and the session will be cleared
            });
        });
    </script>
@endif



<!-- Script -->
<script>
    $(document).ready(function () {
        // Ensure smooth tab switching
        $('a[data-target]').on('click', function (e) {
            e.preventDefault();

            // Get the target div ID
            const target = $(this).data('target');

            // Hide all sections and remove active classes
            $('.tab-pane').removeClass('show active');
            $('a[data-target]').removeClass('active');

            // Show the clicked section and add active class
            $(target).addClass('show active');
            $(this).addClass('active');
        });

        // Set default active section on page load
        $('#profile').addClass('show active');
        $('#profile-tab').addClass('active');
    });
</script>


<style>
    .custom-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center; /* Centers horizontally */
    align-items: center;     /* Centers vertically */
    z-index: 9999;
}

/* Modal Container */
.success-modal {
    background-color: #fff;
    border-radius: 10px;
    width: 100%;
    max-width: 500px; /* Max width to ensure it doesn't overflow on smaller screens */
    padding: 30px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    position: relative; /* Added relative positioning to keep the modal inside the overlay */
}

/* Modal Title */
.success-modal .modal-header h2 {
    font-size: 24px;
    margin-bottom: 20px;
    font-weight: bold;
}

/* Modal Body */
.success-modal .modal-body p {
    font-size: 16px;
    margin-bottom: 30px;
}

/* Modal Footer with button */
.success-modal .modal-footer {
    text-align: center;
}

.success-modal .modal-footer .close-modal-btn {
    padding: 10px 20px;
    background-color: #900A07;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

.success-modal .modal-footer .close-modal-btn:hover {
    background-color: #900A07;
}
</style>




@endsection
