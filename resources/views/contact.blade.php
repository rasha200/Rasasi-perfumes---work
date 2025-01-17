@extends('layouts.user_side_master')

@section('content')

<div class="main-content main-content-contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
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
                            Contact us
                        </li>
                    </ul>
                </div>
            </div>
        </div>

      
        <div class="row">
            <div class="content-area content-contact col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="site-main">
                    <h3 class="custom_blog_title">Contact us</h3>
                </div>
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
    </div>
    <div class="page-main-content">
        <div class="google-map" style="height: 200px;"></div> 
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-contact" style="height: 680px;">
                        <div class="col-lg-8 no-padding">
                            <div class="form-message">
                                <h2 class="title">
                                    Send us a Message!
                                </h2>
                                <form action="{{ route('contact.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>
                                                <span class="form-label">First Name <span style="color:red;">*</span></span>
                                                <input type="text" name="Fname" size="40" class="form-control form-control-name" value="{{ old('Fname') }}" required>
                                            </p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p>
                                                <span class="form-label">Last Name<span style="color:red;">*</span></span>
                                                <input type="text" name="Lname" size="40" class="form-control form-control-name" value="{{ old('Lname') }}" required>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>
                                                <span class="form-label">Phone <span style="color:red;">*</span></span>
                                                <input type="text" name="mobile" class="form-control form-control-phone" value="{{ old('mobile') }}" required>
                                            </p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p>
                                                <span class="form-label">Your Email <span style="color:red;">*</span></span>
                                                <input type="email" name="email" size="40" class="form-control form-control-email" value="{{ old('email') }}" required>
                                            </p>
                                        </div>
                                    </div>
                                    <p>
                                        <span class="form-label">Subject <span style="color:red;">*</span></span>
                                        <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required>
                                    </p>
                                    <p>
                                        <span class="form-label">Your Message <span style="color:red;">*</span></span>
                                        <textarea name="message" cols="40" rows="9" class="form-control your-textarea" value="{{ old('message') }}" required></textarea>
                                    </p>
                                    <p>
                                        <input type="submit" value="SEND MESSAGE" class="form-control-submit button-submit">
                                    </p>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 no-padding">
                            <div class="form-contact-information" style="height: 680px;">
                                <form action="#" class="stelina-contact-info">
                                    <h2 class="title">
                                        Contact information
                                    </h2>
                                    <div class="info">
                                        <div class="item address">
												<span class="icon">

												</span>
                                            <span class="text">
                                                Jordan - Aqaba												</span>
                                        </div>
                                        <div class="item phone">
												<span class="icon">

												</span>
                                            <span class="text">
                                                +962797282485
												</span>
                                        </div>
                                        <div class="item email">
												<span class="icon">

												</span>
                                            <span class="text">
                                                Mohammad.morad1990@gmail.com
												</span>
                                        </div>
                                    </div>
                                    <div class="socials">
                                        <a href="https://www.facebook.com/profile.php?id=100063661684576&mibextid=ZbWKwL" class="social-item" target="_blank">
												<span class="icon fa fa-facebook">

												</span>
                                        </a>
                                        <a href="https://wa.me/962797282485" class="social-item" target="_blank">
												<span class="icon fa fa-whatsapp">

												</span>
                                        </a>
                                        <a href="https://www.instagram.com/aqaba_niche/" class="social-item" target="_blank">
												<span class="icon fa fa-instagram">

												</span>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!------------------------- Success & error modal ------------------------------>
 @if (session('success'))
    <div id="customModal" class="custom-modal-overlay">
        <div class="custom-modal">
            <div class="modal-header">
                <div class="icon-container">
                    <i class="fa fa-check-circle success-icon"></i> <!-- Success icon -->
                </div>
            </div>
            <div class="modal-body">
                <h2>Successfully</h2>
                <p id="modalMessage">{{ session('success') }}</p>
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




@endsection
