@extends('layout.backend.layout')

@section('title', 'Xem danh sách thùng rác sản phẩm')

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
                        <li class="breadcrumb-item"><a href="javascript: void(0);" class="text-capitalize"> sản phẩm </a></li>
                        <li class="breadcrumb-item active text-capitalize">Xem thùng rác</li>
                    </ol>
                </div>
                <h4 class="page-title text-uppercase">Danh sách thùng rác sản phẩm</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <a href="{{ route('adminProduct') }}" class="btn btn-danger waves-effect waves-light mb-4"><i
        class="remixicon-delete-back-2-line mr-2"></i> Quay Lại</a>

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
                                <th></th>
                                <th>Thông tin sản phẩm</th>
                                <th>Ngày tạo</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($list as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        @if ($item['thumb'] == 'default.jpg')
                                            <img src="{{ url('uploads/' . $item['thumb']) }}" width="100px" class="img-fluid"
                                                alt="{{ $item['name'] }}">
                                        @else
                                            <img src="{{ url('uploads/product/' . $item['thumb']) }}" width="100px"
                                                class="img-fluid" alt="{{ $item['name'] }}">
                                        @endif
                                    </td>
                                    <td>
                                        <ul class="m-0 list-unstyled">
                                            <li class="text-truncate" style="width: 200px">{{ $item->name }}</li>
                                            <li>Khuyến mãi: {{ $item->sale }}%</li>
                                            <li>Giá gốc: {{ number_format($item->price, 0 , ",", ".") }} VNĐ</li>
                                            <li>Lượt xem: {{ $item->view }}</li>
                                            <li>Số lượng: {{ $item->quantity }}</li>
                                            <li>Đã bán: {{ $item->number_buy }}</li>
                                        </ul>
                                    </td>
                                    <td>{{ $item['created_at'] }}</td>
                                    <td>
                                        <a href="{{ route('adminProductRestore', $item['id']) }}"
                                            onclick="return confirm('Bạn có chắc chắn muốn khôi phục không ?')"
                                            class="btn btn-warning btn-rounded waves-effect waves-light">
                                            <i class="remixicon-repeat-line"></i>
                                        </a>

                                        <a href="{{ route('adminProductDelete', $item['id']) }}"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn không ?')"
                                            class="btn btn-danger btn-rounded waves-effect waves-light">
                                            <i class="remixicon-delete-bin-line"></i>
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
