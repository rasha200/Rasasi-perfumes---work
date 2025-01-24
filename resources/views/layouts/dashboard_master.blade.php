<!-- include first start -->
@include("include/dashboard/first")
<!-- include first end -->


<!-- include nav bar start -->
@include("include/dashboard/navbar")
<!-- include nav bar end -->

<main id="main" class="main">

<!-- include side bar start -->
@include("include/dashboard/sidebar")
<!-- include side bar end -->


<!-- Loading spinner -->
<div id="pageLoader" style="position: fixed; top: 50%; left: 55%; transform: translate(-50%, -50%); z-index: 9999; display: none;">
    <div class="spinner-border text-danger" style="width: 50px; height: 50px;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>



@yield("content")


</main><!-- End #main -->

<!-- include footer start -->
 @include("include/dashboard/footer")
<!-- include footer end -->
