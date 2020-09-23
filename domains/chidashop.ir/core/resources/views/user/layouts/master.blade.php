
<!DOCTYPE html>
    @include('user.layouts.header')
<body>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header Container ================================================== -->
    @include('user.layouts.header-menu')
    <!-- Header Container / End ============================================ -->

        <!-- Content ================================================== -->
        @yield('user-content')
        <!-- Content / End ============================================ -->

    @include('user.layouts.footer')
</div>
<!-- Wrapper / End -->


<!-- Scripts -->
    @include('user.layouts.script')
<!-- Scripts / End -->

</body>

</html>
