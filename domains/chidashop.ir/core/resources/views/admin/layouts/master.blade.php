
<!DOCTYPE html>
@section('admin-header')
@include('admin.layouts.header')
@show

<body>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header Container ================================================== -->
    @include('admin.layouts.header-menu')
    <!-- Header Container / End ============================================ -->

    <!-- Dashboard -->
    <div id="dashboard">

        <!-- Responsive Navigation Trigger -->
    @include('admin.layouts.sidebar')
    <!-- Navigation / End -->


        <!-- Content ================================================== -->
        <div class="dashboard-content">
        @yield('admin-content')

        <!-- Copyrights -->
            @include('admin.layouts.footer')

        </div>
        <!-- Content / End ============================================ -->

    </div>
    <!-- Dashboard / End -->

</div>
<!-- Wrapper / End -->


<!-- Scripts -->
@section('admin-script')
    @include('admin.layouts.script')
@show
<!-- Scripts / End -->

</body>

</html>
