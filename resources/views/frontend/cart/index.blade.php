@extends('layout.frontend.layout')

@section('title', 'Trang giỏ hàng')

@section('linkCSS')
    <link rel="stylesheet" href="{{ url('') }}/css/toastr.min.css">
@endsection

@section('content')
    <section class="section">
        <div class="section__breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ul class="d-flex flex-wrap list-unstyled">
                            <li>
                                <a href="{{ url('') }}"> Trang chủ </a>
                            </li>
                            <li>Giỏ hàng</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section mt-5">
        <div class="section__cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section__cart">
                            <h5>@lang('home.cart-title')</h5>
                        </div>

                        <div class="table-responsive">
                            <table class="table text-center table-bordered mb-0 table-nowrap">
                                <thead class="thead-light text-capitalize">
                                    <tr>
                                        <th></th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng cộng</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody class="text-nowrap" id="cart-table">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end cart table -->

    <section class="section mt-5">
        <div class="section__cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section__cart-border">
                            <div class="section__cart-border-header">
                                <h6 class="m-0">Mã giảm giá</h6>
                            </div>

                            <div class="section__cart-border-content">
                                <p class="text-capitalize mb-1">
                                    Nhập mã giảm giá vào ô dưới đây (nếu có)
                                </p>
                                <p class="text-capitalize mb-3">
                                    Mỗi đơn hàng chỉ được nhập 1 mã giảm giá
                                </p>
                                <input type="text" class="form-control mb-2 useCoupon" />
                                <p class="text-danger mb-2 resultCoupon"></p>
                                <a href="javascript:void(0)" class="section__cart-border-content-btn">
                                    Apply Coupon
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mt-4 mt-md-0">
                        <div class="section__cart-border">
                            <div class="section__cart-border-header">
                                <h6 class="m-0">Đơn hàng</h6>
                            </div>

                            <div class="section__cart-border-content" id="cart-order">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

        function showCartTable() {
            $.ajax({
                url: "{{ route('userShowCartTable') }}",
                type: "post",
                success: function(data) {
                    $('#cart-table').html(data);
                }
            })
        }

        function showCartOrder() {
            $.ajax({
                url: "{{ route('userShowCartOrder') }}",
                type: "post",
                success: function(data) {
                    $('#cart-order').html(data);
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
        showCartTable();
        showCartOrder();
        showLogin();
        showLoginName();
    </script>
@endsection

@section('linkAjax')
    <script>
        $(function() {

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
                        showCartOrder();

                        Command: toastr["success"]("Xóa thành công sản phẩm khỏi giỏ hàng!")
                        showToastr();
                        showCartTable();
                    }
                })
            })

            $(document).on("click", ".qtyBtn.plus", function() {

                var id = $(this).prev().attr('data-id');
                var sl = $(this).prev().val();

                $.ajax({
                    url: "{{ route('userUpdateCart') }}",
                    type: "post",
                    data: {
                        id: id,
                        sl: sl
                    },
                    success: function(data) {
                        showCartTotal();
                        showCartTable();
                        showCartSidebar();
                        showCartOrder();

                        Command: toastr["success"]("Cập nhật số lượng sản phẩm thành công!");
                        showToastr();
                    }
                });
            })

            $(document).on("click", ".qtyBtn.minus", function() {

                var id = $(this).next().attr('data-id');
                var sl = $(this).next().val();

                $.ajax({
                    url: "{{ route('userUpdateCart') }}",
                    type: "post",
                    data: {
                        id: id,
                        sl: sl
                    },
                    success: function(data) {
                        showCartTotal();
                        showCartTable();
                        showCartSidebar();
                        showCartOrder();

                        Command: toastr["success"]("Cập nhật số lượng sản phẩm thành công!");
                        showToastr();
                    }
                });
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
                                $('.invalid-feedback.usernameLogin').html(response.error
                                    .usernameLogin);
                            } else {
                                $('#usernameLogin').removeClass('is-invalid');
                                $('#usernameLogin').addClass('is-valid');
                                $('.invalid-feedback.usernameLogin').html('');
                            }

                            if (response.error.passwordLogin) {
                                $('#passwordLogin').addClass('is-invalid');
                                $('.invalid-feedback.passwordLogin').html(response.error
                                    .passwordLogin);
                            } else {
                                $('#passwordLogin').removeClass('is-invalid');
                                $('#passwordLogin').addClass('is-valid');
                                $('.invalid-feedback.passwordLogin').html('');
                            }
                        } else {
                            if (response.danger) {
                                Command: toastr["error"](
                                    response.danger)
                                showToastr();
                            }

                            if (response.success) {
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

            // coupon
            $(document).on('click', '.section__cart-border-content-btn', function() {
                var coupon = $('.useCoupon').val();
                
                $.ajax({
                    url: "{{ route('userShowCoupon') }}",
                    type: "post",
                    data: {
                        coupon: coupon
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('.resultCoupon').html(data);
                        showCartOrder();
                    }
                })
            })
        })

    </script>
@endsection
