@extends('layout.frontend.layout')

@section('title', 'Lịch sử đặt hàng')

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
                            <li>Xem lịch sử đặt hàng</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section__order section__cart mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="mb-3">
                            <h5>Danh sách đơn hàng chưa duyệt</h5>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table text-center table-bordered mb-0 table-nowrap">
                                <thead class="thead-light text-capitalize">
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày đặt hàng</th>
                                        <th>Đơn giá</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="text-nowrap">

                                    @foreach ($listOrderSuccess as $item)
                                    <tr>
                                        <td>
                                            #{{ $item['ordercode'] }}
                                        </td>
                                        <td>
                                            {{ $item['orderdate'] }}
                                        </td>
                                        <td>
                                            {{ number_format($item['money'], 0, ',', '.') }} VNĐ
                                        </td>
                                        <td>
                                            @if ($item['status'] == 1)
                                                Chưa duyệt
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('userOrderDetail', $item['id']) }}" class="btn btn-success btn-sm text-white">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>

                                            <a href="{{ route('userOrderRemove', $item['id']) }}" class="btn btn-danger btn-sm text-white" onclick="return confirm('Bạn có chắc chắn sẽ hủy đơn hàng này không ?')">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>    
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        
                        <div class="my-3">
                            <h5>Danh sách đơn hàng đã duyệt</h5>
                        </div>

                        <div class="table-responsive">
                            <table class="table text-center table-bordered mb-0 table-nowrap">
                                <thead class="thead-light text-capitalize">
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày đặt hàng</th>
                                        <th>Đơn giá</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="text-nowrap">

                                    @foreach ($listOrderNotSuccess as $item)
                                    <tr>
                                        <td>
                                            #{{ $item['ordercode'] }}
                                        </td>
                                        <td>
                                            {{ $item['orderdate'] }}
                                        </td>
                                        <td>
                                            {{ number_format($item['money'], 0, ',', '.') }} VNĐ
                                        </td>
                                        <td>
                                            @php if ($item['status'] == 2) {
                                                echo 'Đã duyệt và đang giao hàng.';
                                            } else if ($item['status'] == 3) {
                                                echo 'Đã giao hàng và thanh toán thành công.';
                                            } else if ($item['status'] == 4) {
                                                echo 'Khách hàng đã huỳ.';
                                            } else if ($item['status'] == 5) {
                                                echo 'ADMIN đẫ huỷ.';
                                            }
                                            @endphp
                                        </td>
                                        <td>
                                            <a href="{{ route('userOrderDetail', $item['id']) }}" class="tn btn-success btn-sm text-white">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>    
                                    @endforeach

                                </tbody>
                            </table>
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
