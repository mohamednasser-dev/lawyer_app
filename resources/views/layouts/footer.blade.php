<!-- partial:partials/_footer.html -->
<footer class="footer ">
    <p class="text-muted " style="text-align:left">Copyright © 2020  <strong>TE-Solution</strong>  All rights
        reserved</p> 
</footer>
 
</div>
</div>
<!-- core:js -->
<script src="{{url('/assets/vendors/core/core.js')}}"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="{{url('/assets/vendors/chartjs/Chart.min.js')}}"></script>
<script src="{{url('/assets/vendors/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{url('/assets/vendors/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{url('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('/assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{url('/assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
@yield('custom-plugin')

<!-- end plugin js for this page -->
<!-- inject:js -->
<script src="{{url('/assets/vendors/feather-icons/feather.min.js')}}"></script>
<script src="{{url('/assets/js/template.js')}}"></script>
<!-- endinject -->
<script src="{{url('/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{url('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{url('/assets/js/data-table.js')}}"></script>

<!-- custom js for this page -->
<script src="{{url('/assets/js/dashboard.js')}}"></script>
<script src="{{url('/plugins/toastr/toastr.js') }}"></script>
@yield('custom-scripts')

<!-- end custom js for this page -->
</body>

<!-- Mirrored from www.nobleui.com/html/template/demo_4/dashboard-one.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 25 Sep 2020 17:40:54 GMT -->
</html>
