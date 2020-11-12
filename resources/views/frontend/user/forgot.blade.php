@extends('layout.frontend.layout')

@section('title', 'Quên mật khẩu')

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
                            <li>Quên mật khẩu</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section__forgot mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">

                        @if (session('danger'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa fa-times mr-2"></i>
                                {{ session('danger') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa fa-check-circle mr-2"></i>
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif

                        <p class="font-weight-bolder text-capitalize">
                            Lưu ý: Nhập email thành viên mà bạn đã sử dụng để đăng ký.
                        </p>

                        <form action="{{ route('userPostForgotPassword') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="text-capitalize">Nhập Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email">

                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary text-capitalize">Tiếp tục</button>
                            </div>
                        </form>
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

                        Command: toastr["success"]("Xóa thành công sản phẩm khỏi giỏ hàng!")
                        showToastr();
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
