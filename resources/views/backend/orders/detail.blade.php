@extends('layout.backend.layout')

@section('title', 'Xem danh sách đơn hàng')

@section('linkCSS')
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

    <a href="{{ route('adminOrders') }}" class="btn btn-danger border-radius-0 btn-sm text-capitalize">
        <i class="fa fa-arrow-left mr-2" aria-hidden="true"></i>
        Quay lại
    </a>

    <div class="row">
        <div class="col-12">

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
                <p><strong class="text-capitalize">Trạng thái đơn hàng: </strong> <span class="badge badge-primary">
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
                                    <img src="{{ url('uploads/product/' . $item['thumb']) }}" alt="{{ $item['name'] }}"
                                        class="img-fluid" width="100px" height="100px">
                                </td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['qty'] }}</td>
                                <td>{{ number_format($item['qty'] * $item['orderPrice'], 0, ',', '.') }} VNĐ</td>
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

    <!-- end row-->

@endsection

@section('linkJS')

@endsection
