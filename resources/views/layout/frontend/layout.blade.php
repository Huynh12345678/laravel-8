<!DOCTYPE html>
<html lang="en">

<head>
    <title>Circle - @yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- meta --}}
    @yield('metaSeo')
    @include('layout.frontend.head')
    @yield('linkCSS')
</head>

<body>
    <!-- header -->
    <div class="header">
        @include('layout.frontend.header')
    </div>
    <!-- end header -->

    {{-- content --}}
    @yield('content')
    {{-- end content --}}
    
    <footer class="footer">
        @include('layout.frontend.footer')
    </footer>

    <!-- cart siderbar -->
    <section class="section">
        @include('layout.frontend.cart-sidebar')
    </section>
    <!-- end cart -->

    <!-- menu siderbar -->
    <section class="section">
        @include('layout.frontend.menu-sidebar')
    </section>
    <!-- end menu -->

    <!-- modal -->
    <div class="modal fade section" id="dataModal">
        @include('layout.frontend.modal')
    </div>
    <!-- end modal -->

     <!-- modal register -->
    <div class="modal fade section" id="dataRegister">
        @include('layout.frontend.registerModal')
    </div>
    <!-- end modal register -->

    <!-- modal login -->
    <div class="modal fade section" id="dataLogin">
        @include('layout.frontend.loginModal')
    </div>
    <!-- end modal login -->

    <!-- overplay -->
    <section class="overplay"></section>
    <!-- end overplay -->

    @include('layout.frontend.script')
    @yield('linkJS')
    @include('layout.frontend.search')
    @yield('linkFunctionCallAjax')
    @yield('linkAjax')

    {{-- error checkout --}}
    @if (session('error'))
    <script>
        toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-bottom-left",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
        }
        Command: toastr["error"]("{{ session('error') }}");
    </script>
    @endif
</body>

</html>
