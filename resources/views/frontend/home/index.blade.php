@extends('layout.frontend.layout')

@section('title', 'Trang chủ')

@section('linkCSS')
    <link rel="stylesheet" href="{{ url('') }}/css/toastr.min.css">
@endsection

@section('metaSeo')
    <meta name="title" content="Circle: Thế giới SHOPPING, Chợ Online Mua Bán Giá Tốt Bảo Trợ FPT" />
    <meta name="keywords" content="" />
    <meta name="description"
        content="Circle – Mua gì cũng có, giá khỏi phải lo ✅ SHOPPING ONLINE Mua Bán Thời Trang Nam Nữ, Thế Giới Di Động - LAPTOP ✨ Khuyến Mãi Hấp Dẫn ✨ Miễn Phí Vận Chuyển ✨ Sàn TMĐT tập đoàn FPT ✅ Mua Bán Online, Mua Hàng Đảm Bảo Chất Lượng ✅ Giá Rẻ Từ Shop Uy tín" />
    <meta name="url" content="{{ route('userProductShop') }}">
    <meta name="og:title" content="Circle: Thế giới SHOPPING, Chợ Online Mua Bán Giá Tốt Bảo Trợ FPT"" />
            <meta name=" og:url" content="{{ route('userProductShop') }}" />
    <meta name="og:keywords" content="" />
    <meta name="og:description"
        content="Circle – Mua gì cũng có, giá khỏi phải lo ✅ SHOPPING ONLINE Mua Bán Thời Trang Nam Nữ, Thế Giới Di Động - LAPTOP ✨ Khuyến Mãi Hấp Dẫn ✨ Miễn Phí Vận Chuyển ✨ Sàn TMĐT tập đoàn FPT ✅ Mua Bán Online, Mua Hàng Đảm Bảo Chất Lượng ✅ Giá Rẻ Từ Shop Uy tín" />
@endsection

@section('content')
    <!-- slider -->
    <section class="section mt-4">
        <div class="section__slider">
            @include('layout.frontend.slider')
        </div>
    </section>
    <!-- end slider -->

    <!-- product slider -->
    <section class="section">
        <div class="section__product">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @include('layout.frontend.nav-tabs')
                    </div>
                </div>

                @foreach ($listProductByCatalog as $row)
                    @php
                    $listCat = $mcatalog->catalogByProduct($row['id']);
                    $listProductByCat = $mproduct->productByCat($listCat);
                    @endphp

                    @if (count($listProductByCat))
                        <div class="row mt-5">
                            <div class="col-12">
                                <h5 class="section__product-title mb-3">{{ $row['name'] }}</h5>

                                <!-- Swiper -->
                                <div class="swiper-container swiper-product">
                                    <div class="swiper-wrapper">
                                        @foreach ($listProductByCat as $item)
                                            <div class="swiper-slide">
                                                <div class="section__product-container">
                                                    <div class="section__product-container-thumb position-relative">
                                                        <a href="{{ route('userProductDetail', $item['slug']) }}">
                                                            <img src="{{ url('uploads/product/' . $item['thumb']) }}"
                                                                class="img-fluid" alt="{{ $item['name'] }}" />
                                                        </a>

                                                        @if ($item['sale'] > 0)
                                                            <div class="section__product-container-info-price-sale">
                                                                -{{ $item['sale'] }}%
                                                            </div>
                                                        @endif

                                                        <div class="section__product-container-hover">
                                                            <ul class="list-unstyled d-flex">
                                                                <li>
                                                                    <a href="javascript:void(0)"
                                                                        class="section__product-container-quickview"
                                                                        data-toggle="modal" data-target="#dataModal"
                                                                        data-id="{{ $item['id'] }}">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0)"
                                                                        class="section__product-container-addToCart"
                                                                        data-id="{{ $item['id'] }}">
                                                                        <i class="fa fa-shopping-bag"
                                                                            aria-hidden="true"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="section__product-container-info">
                                                        <div class="section__product-container-info-name">
                                                            <a href="{{ route('userProductDetail', $item['slug']) }}">
                                                                {{ $item['name'] }} - {{ $item['sku'] }}
                                                            </a>
                                                        </div>

                                                        <div class="section__product-container-info-star">
                                                            <div class="text-warning">
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            </div>
                                                        </div>

                                                        <p class="text-muted">Lượt xem: {{ $item['view'] }}</p>

                                                        @if ($item['sale'] > 0)
                                                            <div class="section__product-container-info-price">
                                                                <div class="section__product-container-info-price-buy">
                                                                    {{ number_format($item['price'] - $item['price'] * ($item['sale'] / 100), 0, ',', '.') }}
                                                                    VNĐ
                                                                </div>

                                                                <div class="section__product-container-info-price-root">
                                                                    {{ number_format($item['price'], 0, ',', '.') }} VNĐ
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="section__product-container-info-price">
                                                                <div class="section__product-container-info-price-buy">
                                                                    {{ number_format($item['price'], 0, ',', '.') }} VNĐ
                                                                </div>

                                                                <div class="section__product-container-info-price-buy"
                                                                    style="opacity: 0">
                                                                    {{ number_format($item['price'], 0, ',', '.') }} VNĐ
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Add Arrows -->
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                                <!-- end Swiper -->
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- end product slider -->
@endsection

@section('linkJS')
    <script src="{{ url('') }}/js/toastr.min.js"></script>
@endsection

@section('linkFunctionCallAjax')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function showCartSidebar() {
            $.ajax({
                url: "{{ route('userShowCartSidebar') }}",
                type: "post",
                success: function(data) {
                    $('#cart-data').html(data);
                }
            })
        }

        function showCartQuantity() {
            $.ajax({
                url: "{{ route('userShowCartQuantity') }}",
                type: "post",
                success: function(data) {
                    $('#header__mid-cart-quantity').html(data);
                }
            })
        }

        function showCartTotal() {
            $.ajax({
                url: "{{ route('userShowCartTotal') }}",
                type: "post",
                success: function(data) {
                    $('#cart-total').html(data);
                }
            })
        }

        function showLogin() {
            $.ajax({
                url: "{{ route('userShowLogin') }}",
                type: "post",
                success: function(data) {
                    $('#userLogin').html(data);
                }
            })
        }

        function showLoginName() {
            $.ajax({
                url: "{{ route('userShowLoginName') }}",
                type: "post",
                success: function(data) {
                    $('#userLoginName').html(data);
                }
            })
        }

        function showToastr() {
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
        }

        showCartSidebar();
        showCartQuantity();
        showCartTotal();
        showLogin();
        showLoginName();

        @if (session('login'))
        function checkLogin() {
            Command: toastr["error"]("{{ session('login') }}")
            showToastr();
        }
        checkLogin();
        @endif
    </script>
@endsection

@section('linkAjax')
    <script>
        $(function() {
            $('.section__product-container-quickview').on('click', function() {
                var id = $(this).attr('data-id');

                $.ajax({
                    url: "{{ route('userModal') }}",
                    type: "post",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        $('#data').html(data);
                        $('#dataModal').modal('show');
                    }
                })
            })

            $(document).on('click', '.section__product-container-addToCart', function() {
                var id = $(this).attr('data-id');

                $.ajax({
                    url: "{{ route('userCartAdd') }}",
                    type: "post",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        $('.section__sidebar').addClass('active');
                        $('.overplay').addClass('active');
                        showCartSidebar();
                        showCartQuantity();
                        showCartTotal();

                        Command: toastr["success"]("Thêm sản phẩm vào giỏ hàng thành công!")
                        showToastr();
                    }
                })
            })

            $(document).on('click', '.section__sidebar-content-removeCart', function() {
                var id = $(this).attr('data-id');

                $.ajax({
                    url: "{{ route('userRemoveCart') }}",
                    type: "post",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        showCartSidebar();
                        showCartQuantity();
                        showCartTotal();

                        Command: toastr["success"]("Xóa thành công sản phẩm khỏi giỏ hàng!")
                        showToastr();
                    }
                })
            })

            // Register
            $(document).on('submit', '#postRegisterForm', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('userPostRegister') }}",
                    type: "post",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.errors) {
                            if (response.errors.fullname) {
                                $('#fullname').addClass('is-invalid');
                                $('.invalid-feedback.fullname').html(response.errors.fullname);
                            } else {
                                $('#fullname').removeClass('is-invalid');
                                $('#fullname').addClass('is-valid');
                                $('.invalid-feedback.fullname').html('');
                            }

                            if (response.errors.email) {
                                $('#email').addClass('is-invalid');
                                $('.invalid-feedback.email').html(response.errors.email);
                            } else {
                                $('#email').removeClass('is-invalid');
                                $('#email').addClass('is-valid');
                                $('.invalid-feedback.email').html('');
                            }

                            if (response.errors.phone) {
                                $('#phone').addClass('is-invalid');
                                $('.invalid-feedback.phone').html(response.errors.phone);
                            } else {
                                $('#phone').removeClass('is-invalid');
                                $('#phone').addClass('is-valid');
                                $('.invalid-feedback.phone').html('');
                            }

                            if (response.errors.username) {
                                $('#username').addClass('is-invalid');
                                $('.invalid-feedback.username').html(response.errors.username);
                            } else {
                                $('#username').removeClass('is-invalid');
                                $('#username').addClass('is-valid');
                                $('.invalid-feedback.username').html('');
                            }

                            if (response.errors.password) {
                                $('#password').addClass('is-invalid');
                                $('.invalid-feedback.password').html(response.errors.password);
                            } else {
                                $('#password').removeClass('is-invalid');
                                $('#password').addClass('is-valid');
                                $('.invalid-feedback.password').html('');
                            }
                        } else {
                            Command: toastr["success"](
                                "Đăng ký thành công! Bây giờ bạn có thể đăng nhập.")
                            showToastr();

                            $('#fullname').addClass('is-valid');
                            $('#fullname').removeClass('is-invalid');
                            $('.invalid-feedback.fullname').html('');

                            $('#email').addClass('is-valid');
                            $('#email').removeClass('is-invalid');
                            $('.invalid-feedback.email').html('');

                            $('#phone').addClass('is-valid');
                            $('#phone').removeClass('is-invalid');
                            $('.invalid-feedback.phone').html('');

                            $('#username').addClass('is-valid');
                            $('#username').removeClass('is-invalid');
                            $('.invalid-feedback.username').html('');

                            $('#password').addClass('is-valid');
                            $('#password').removeClass('is-invalid');
                            $('.invalid-feedback.password').html('');

                            $('#dataRegister').modal('hide');
                            $('#dataLogin').modal('show');
                        }
                    }
                })
            })

            // Login
            $(document).on('submit', '#postLoginForm', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('userPostLogin') }}",
                    type: "post",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.error) {
                            if (response.error.usernameLogin) {
                                $('#usernameLogin').addClass('is-invalid');
                                $('.invalid-feedback.usernameLogin').html(response.error.usernameLogin);
                            } else {
                                $('#usernameLogin').removeClass('is-invalid');
                                $('#usernameLogin').addClass('is-valid');
                                $('.invalid-feedback.usernameLogin').html('');
                            }

                            if (response.error.passwordLogin) {
                                $('#passwordLogin').addClass('is-invalid');
                                $('.invalid-feedback.passwordLogin').html(response.error.passwordLogin);
                            } else {
                                $('#passwordLogin').removeClass('is-invalid');
                                $('#passwordLogin').addClass('is-valid');
                                $('.invalid-feedback.passwordLogin').html('');
                            }
                        } else {
                            if(response.danger) {
                                Command: toastr["error"](
                                response.danger)
                                showToastr();
                            }

                            if(response.success) {
                                Command: toastr["success"](
                                response.success)
                                showToastr();
                            }

                            $('#dataLogin').modal('hide');
                            showLogin();
                            showLoginName();
                        }
                    }
                })
            })

            // Logout
            $(document).on('click', '#postLogout', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('userPostLogout') }}",
                    type: "post",
                    success: function(data) {
                        Command: toastr["success"]('Đăng xuất thành công!')
                        showToastr();
                        showLogin();
                        showLoginName();
                    }
                })
            })
        })

    </script>
@endsection
