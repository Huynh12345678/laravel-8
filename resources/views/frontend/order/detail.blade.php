@extends('layout.frontend.layout')

@section('title')
    Đơn hàng #{{ $row['ordercode'] }}
@endsection

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
                            <li>Đơn hàng #{{ $row['ordercode'] }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section__orderdetail mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="mt-4">
                            <a href="{{ route('userOrderHistory') }}"
                                class="btn btn-danger border-radius-0 btn-sm text-capitalize">
                                <i class="fa fa-arrow-left mr-2" aria-hidden="true"></i>
                                Quay lại
                            </a>
                        </div>

                        <div class="float-sm-left mt-4">
                            <address>
                                <strong class="text-capitalize">Thông tin khách hàng</strong><br>
                                Họ và tên: <span class="text-capitalize">{{ $row['fullname'] }}</span><br>
                                Email: {{ $row['email'] }}<br>
                                Địa chỉ giao hàng: {{ $row['orderAddress'] }}<br>
                                <abbr title="Phone">Phone Number:</abbr> 0{{ $row['phone'] }} <br>
                                Tỉnh/Thành phố: <span class="text-capitalize"> {{ $row['provinceName'] }} </span> <br>
                                Quận/Huyện: <span class="text-capitalize">{{ $row['districtName'] }}</span>
                            </address>
                        </div>
                        <div class="mt-4 text-sm-right">
                            <p><strong class="text-capitalize">Ngày đặt hàng: </strong> {{ $row['orderdate'] }}</p>
                            <p><strong class="text-capitalize">Trạng thái đơn hàng: </strong> <span
                                    class="badge badge-primary">
                                    @php if ($row['orderStatus'] == 1) {
                                        echo 'Chưa duyệt.';
                                    } else if ($row['orderStatus'] == 2) {
                                    echo 'Đã duyệt và đang giao hàng.';
                                    } else if ($row['orderStatus'] == 3) {
                                    echo 'Đã giao hàng và thanh toán thành công.';
                                    } else if ($row['orderStatus'] == 4) {
                                    echo 'Khách hàng đã huỳ.';
                                    } else if ($row['orderStatus'] == 5) {
                                    echo 'ADMIN đẫ huỷ.';
                                    }
                                    @endphp</span></p>
                            <p><strong class="text-capitalize">Mã đơn hàng: </strong> #{{ $row['ordercode'] }}</p>
                        </div>
                    </div><!-- end col -->
                </div>

                <div class="row mt-4">
                    <div class="col-12">

                        <div class="table-responsive">
                            <table class="table table-nowrap">
                                <thead>
                                    <tr class="text-capitalize">
                                        <th>#</th>
                                        <th></th>
                                        <th>Tên sản phẩm</th>
                                        <th>SL</th>
                                        <th>Tổng cộng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listProduct as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <img src="{{ url('uploads/product/' .$item['thumb']) }}" alt="{{ $item['name'] }}" class="img-fluid" width="100px" height="100px">
                                        </td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['qty'] }}</td>
                                        <td>{{ number_format(($item['qty'] * $item['orderPrice']), 0, ',', '.') }} VNĐ</td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <div class="text-right mt-4">
                            <p><b>Tổng Cộng:</b> {{ number_format($total, 0, ',', '.') }} VNĐ</p>
                            <p><b>Mã giảm giá:</b> {{ number_format($row['coupon'], 0, ',', '.') }} VNĐ</p>
                            <p><b>Phí Vận Chuyển:</b> 50.000 VNĐ</p>
                            <hr>
                            <h3>{{ number_format($total + 50000 - $row['coupon'], 0, ',', '.') }} VNĐ</h3>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-print-none">
                    <div class="float-right">
                        <a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light"><i
                                class="fa fa-print"></i></a>
                    </div>
                    <div class="clearfix"></div>
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
