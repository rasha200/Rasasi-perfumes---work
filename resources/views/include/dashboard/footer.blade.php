  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>Pukka nich</span></strong>. All Rights Reserved
    </div>
   
</footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center" style="background-color: #10db8c; "><i class="bi bi-arrow-up-short" style=" color:black;"></i></a>

  
  <!-- Vendor JS Files -->
  <script src="{{asset("assets/vendor/apexcharts/apexcharts.min.js")}}"></script>
  <script src="{{asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
  <script src="{{asset("assets/vendor/chart.js/chart.umd.js")}}"></script>
  <script src="{{asset("assets/vendor/echarts/echarts.min.js")}}"></script>
  <script src="{{asset("assets/vendor/quill/quill.js")}}"></script>
  <script src="{{asset("assets/vendor/simple-datatables/simple-datatables.js")}}"></script>
  <script src="{{asset("assets/vendor/tinymce/tinymce.min.js")}}"></script>
  <script src="{{asset("assets/vendor/php-email-form/validate.js")}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset("assets/js/main.js")}}"></script>
 
 <!-- Loading spinner -->
 <script>
    window.addEventListener('load', function () {
        // Hide the spinner when the page is fully loaded
        document.getElementById('pageLoader').style.display = 'none';
    });

    // Show the spinner when the page starts loading
    window.addEventListener('beforeunload', function () {
        document.getElementById('pageLoader').style.display = 'block';
    });

    document.addEventListener('DOMContentLoaded', function () {
        // This event is fired when the DOM is fully loaded, but images may still be loading.
        // Ensure the spinner is hidden when the DOM content is loaded.
        document.getElementById('pageLoader').style.display = 'none';
    });
</script>


</body>

</html>