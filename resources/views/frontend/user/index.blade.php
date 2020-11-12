@extends('layout.frontend.layout')

@section('title', 'Thông tin cá nhân khách hàng')

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
                            <li>Xem thông tin cá nhân</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section__info mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center">
                        <div class="border p-5">
                            <div class="section__info-thumb">
                                @if ($row['thumb'] == 'user.png')
                                    <img src="{{ url('images/' . $row['thumb']) }}" alt="{{ $row['fullname'] }}"
                                    class="img-fluid" width="100px">
                                @else
                                <img src="{{ url('uploads/user/' . $row['thumb']) }}" alt="{{ $row['fullname'] }}"
                                class="img-fluid" width="100px">
                                @endif
                                
                            </div>

                            <div class="section__info-fullname mt-3">
                                <h5 class="text-capitalize font-weight-bolder">{{ $row['fullname'] }}</h5>
                            </div>

                            <div class="row mt-4">
                                <div class="col-6">
                                    <div class="section__info-full text-left">
                                        <p class="text-capitalize">Email: {{ $row['email'] }}</p>
                                        <p class="text-capitalize">Số điện thoại: {{ $row['phone'] }}</p>
                                    </div>
                                </div>

                                <div class="col-6 d-flex justify-content-end">
                                    <div class="section__info-full text-left">
                                        <p class="text-capitalize">Trạng thái: @if ($row['status'] == 1)
                                            <span class="badge badge-primary">
                                                Đang họat động
                                            </span>
                                        @endif</p>
                                        <p class="text-capitalize">
                                            Ngày lập tài khoản: {{ date('d-m-Y', strtotime($row['created_at'])) }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-12 text-left">
                                    <p class="text-capitalize">Nơi ở hiện tại: @if ($row['address'] == '')
                                        Chưa cập nhật
                                    @else
                                        {{ $row['address'] }}
                                    @endif</p>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                <a href="{{ route('userEdit', $row['id']) }}" class="btn btn-primary btn-sm mx-1 text-capitalize">
                                    Cập nhật thông tin 
                                </a>
                                
                                <a href="{{ route('userReset', $row['id']) }}" class="btn btn-dark btn-sm mx-1 text-capitalize">
                                    Đổi mật khẩu
                                </a>
                            </div>

                            <div class="row mt-4">
                                <div class="col-6">
                                    <div class="bg-info py-2 text-white">
                                        <p class="text-uppercase">Đơn hàng chưa duyệt</p>
                                        <p>
                                            <span class="badge badge-light">
                                                {{ $listOrderNotSuccess }}
                                            </span>
                                        </p>
                                        <p class="my-2">
                                            <a href="{{ route('userOrderHistory') }}" class="text-capitalize d-inline bg-dark text-white py-2 px-3">Xem tất cả</a>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="bg-info py-2 text-white">
                                        <p class="text-uppercase">Đơn hàng đã duyệt</p>
                                        <p>
                                            <span class="badge badge-light">
                                                {{ $listOrderSuccess }}
                                            </span>
                                        </p>
                                        <p class="my-2">
                                            <a href="{{ route('userOrderHistory') }}" class="text-capitalize d-inline bg-dark text-white py-2 px-3">Xem tất cả</a>
                                        </p>
                                    </div>
                                </div>
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
                        document.location.reload(true);
                    }
                })
            })
        })

    </script>
@endsection
