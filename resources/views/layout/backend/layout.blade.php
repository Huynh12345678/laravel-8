<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Circle - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    @yield('linkCSS')

    @include('layout.backend.head')
</head>

<body>

    <div id="preloader">
        <div id="status">
            <div class="bouncingLoader"><div></div><div></div><div></div></div>
        </div>
    </div>
    
    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <div class="navbar-custom">
            @include('layout.backend.topbar')
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            @include('layout.backend.sidebar')

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">

            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">
                    @yield('content')

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                @include('layout.backend.footer')
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    @include('layout.backend.script')

    @yield('linkJS')
    
</body>

</html>
