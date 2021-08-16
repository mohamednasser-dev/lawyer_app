<!-- start: HEAD -->
@include('layouts.header')
<!-- end: HEAD -->
<!-- partial:partials/_sidebar.html -->
@include('layouts.navbar')
<!-- partial -->

<div class="page-wrapper">

    <!-- partial:partials/_navbar.html -->
@include('layouts.topbar')
<!-- partial -->

    <div class="page-content">
        @include('layouts.errors')
        @yield('content')
    </div>

    <!-- partial:partials/_footer.html -->

    <!-- partial -->
@include('layouts.footer')

