@extends('layouts.user_side_master')

@section('content')
<div>
    <div class="fullwidth-template">
   
{{--include hero_section start--}}
@include("include/landing_page/hero_section")
{{--include hero_section end--}}


{{--include flash-sale start--}}
@include("include/landing_page/first_section(discount)")
{{--include flash-sale end--}}



{{--include secound_section(static_categories) start--}}
@include("include/landing_page/secound_section(static_categories)")
{{--include secound_section(static_categories) end--}}


{{--include third_section(bestseller) start--}}
@include("include/landing_page/third_section(bestseller)")
{{--include third_section(bestseller) end--}}

 

{{--include fourth_section(static_category) start--}}
@include("include/landing_page/fourth_section(static_category_perfume)")
{{--include fourth_section(static_category) end--}}
       
      
{{--include fifth_section(new_products) start--}}
@include("include/landing_page/fifth_section(new_products)")
{{--include fifth_section(new_products) end--}}

       


    </div>
</div>


{{--include sixth_section(instgram) start--}}
@include("include/landing_page/sixth_section(instgram)")
{{--include sixth_section(instgram) end--}}



  <!------------------------- Success & error modal ------------------------------>

@if (Session::get('success'))
<div id="customModal" class="custom-modal-overlay">
    <div class="custom-modal">
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

        // Set the modal title and message
        var isSuccess = '{{ Session::get("success") }}' ? true : false;
        $('#modalTitle').text(isSuccess ? 'Success' : 'Error');
        $('#modalMessage').text('{{ Session::get("success") ?? Session::get("error") }}');
    });

    // Close the modal when the user clicks "OK"
    $('.close-modal-btn').click(function() {
        $('#customModal').fadeOut();
    });
</script>
@endif

@endsection