@extends('layout.backend.layout')

@section('title', 'Xem danh sách đơn hàng')

@section('linkCSS')
    <!-- third party css -->
    <link href="{{ url('') }}\assets\libs\datatables\dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
    <link href="{{ url('') }}\assets\libs\datatables\responsive.bootstrap4.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Circle</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);" class="text-capitalize">đơn hàng</a></li>
                        <li class="breadcrumb-item active text-capitalize">Xem danh sách</li>
                    </ol>
                </div>
                <h4 class="page-title text-uppercase">Danh sách đơn hàng</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <a href="{{ route('adminOrdersSave') }}" class="btn btn-primary waves-effect waves-light mb-4"><i
        class="remixicon-add-fill mr-2"></i> Danh sách đơn hàng đã lưu</a>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all mr-2"></i>
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    <h4 class="header-title">Danh sách</h4>

                    <table id="basic-datatable" class="table dt-responsive nowrap">
                        <thead>
                            <tr class="text-capitalize">
                                <th>#</th>
                                <th>Thông tin người đặt</th>
                                <th>Thông tin đơn hàng</th>
                                <th>Trạng thái</th>
                                <th>Thao tác đơn hàng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($list as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td class="text-capitalize">
                                        <ul class="m-0 list-unstyled">
                                            <li class="text-truncate" style="width: 150px">Họ Tên: {{ $item['fullname'] }}</li>
                                            <li class="text-truncate" style="width: 150px">Email: {{ $item['email'] }}</li>
                                            <li class="text-truncate" style="width: 150px">Phone: {{ $item['phone'] }}</li>
                                            <li class="text-truncate" style="width: 150px">
                                            Giới tính: @php
                                                if($item['gender'] == 2) {
                                                    echo 'Nam';
                                                } else if ($item['gender'] == 1) {
                                                    echo 'Nữ';
                                                } else {
                                                    echo 'Khác';
                                                }
                                            @endphp
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="m-0 list-unstyled">
                                            <li class="text-truncate" style="width: 200px">Coupon: {{ number_format($item['coupon'], 0, ',', '.') }} VNĐ</li>
                                            <li class="text-truncate" style="width: 200px">Ngày đặt: {{ $item['orderdate'] }}</li>
                                            <li class="text-truncate" style="width: 200px">Code: #{{ $item['ordercode'] }}</li>
                                            <li class="text-truncate" style="width: 200px">Đơn giá: {{ number_format($item['money'], 0, ',', '.') }} VNĐ</li>
                                        </ul>
                                    </td>
                                    <td>
                                        @php if ($item['orderStatus'] == 1) {
                                            echo 'Chưa duyệt.';
                                        } else if ($item['orderStatus'] == 2) {
                                            echo 'Đang giao hàng.';
                                        } else if ($item['orderStatus'] == 3) {
                                            echo 'Đã hoàn thành.';
                                        } else if ($item['orderStatus'] == 4) {
                                            echo 'Khách hàng đã huỳ.';
                                        } else if ($item['orderStatus'] == 5) {
                                            echo 'ADMIN đẫ huỷ.';
                                        } @endphp
                                    </td>
                                    <td>
                                        @if ($item['orderStatus'] == 1)
                                            <a onclick="return confirm('Bạn xác nhận đơn hàng này đã duyệt và bắt đầu giao hàng?');" href="{{ route('adminOrdersStatus', $item['orderId']) }}" class="badge badge-light-warning">
                                                Duyệt đơn
                                            </a>                                        
                                        @endif

                                        @if ($item['orderStatus'] == 2)
                                        <a onclick="return confirm('Bạn xác nhận đơn hàng đã giao hàng và thanh toán thành công?');" href="{{ route('adminOrdersStatus', $item['orderId']) }}" class="badge badge-light-success">
                                            Hoàn thành đơn
                                        </a>                                      
                                        @endif                                                          

                                        @if ($item['orderStatus'] == 1 || $item['orderStatus'] == 2)
                                        <a onclick="return confirm('Thao tác này sẽ huỷ đơn hàng? Bạn có muốn tiếp tục không?');" href="{{ route('adminOrdersCancel', $item['orderId']) }}" class="badge badge-light-danger">
                                            Huỷ đơn
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('adminOrdersDetail', $item['orderId']) }}"
                                            class="btn btn-dark btn-rounded waves-effect waves-light">
                                            <i class="remixicon-eye-line"></i>
                                        </a>

                                        <a href="{{ route('adminOrdersChangeSave', $item['orderId']) }}"
                                            onclick="return confirm('Bạn có chắc chắn muốn lưu đơn hàng này không ?')"
                                            class="btn btn-info btn-rounded waves-effect waves-light">
                                            <i class="remixicon-save-line"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->

@endsection

@section('linkJS')
    <script src="{{ url('') }}\assets\libs\datatables\jquery.dataTables.min.js"></script>
    <script src="{{ url('') }}\assets\libs\datatables\dataTables.bootstrap4.js"></script>
    <script src="{{ url('') }}\assets\libs\datatables\dataTables.responsive.min.js"></script>
    <!-- Datatables init -->
    <script src="{{ url('') }}\assets\js\pages\datatables.init.js"></script>
@endsection
