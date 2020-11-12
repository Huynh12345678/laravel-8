@extends('layout.backend.layout')

@section('title', 'Xem danh sách khách hàng')

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
                        <li class="breadcrumb-item"><a href="javascript: void(0);" class="text-capitalize">Khách hàng</a></li>
                        <li class="breadcrumb-item active text-capitalize">Xem danh sách</li>
                    </ol>
                </div>
                <h4 class="page-title text-uppercase">Danh sách khách hàng</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

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
                                <th>Thông tin khách hàng</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($list as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        @if ($item['thumb'] == 'user.png')
                                            <img src="{{ url('images/user.png') }}" class="img-fluid" width="50px" alt="{{ $item['fullname'] }}">
                                        @else
                                            <img src="{{ url('uploads/user/'.$item['thumb']) }}" class="img-fluid" width="50px" alt="{{ $item['fullname'] }}">
                                        @endif
                                    </td>
                                    <td class="text-capitalize">
                                        <ul class="m-0 list-unstyled">
                                            <li class="text-truncate" style="width: 200px">Họ Tên: {{ $item['fullname'] }}</li>
                                            <li class="text-truncate" style="width: 200px">Email: {{ $item['email'] }}</li>
                                            <li class="text-truncate" style="width: 200px">Phone: {{ $item['phone'] }}</li>
                                            <li class="text-truncate" style="width: 200px">Địa chỉ: {{ $item['address'] ? $item['address'] : 'Chưa cập nhật' }}</li>
                                        </ul>
                                    </td>
                                    <td>
                                        @if ($item['status'] == 1)
                                            Đang hoạt động

                                            <a href="{{ route('adminUserStatus', $item['id']) }}" class="badge badge-dark">Khóa</a>
                                        @else
                                            Đang khóa

                                            <a href="{{ route('adminUserStatus', $item['id']) }}" class="badge badge-dark">Mở khóa</a>
                                        @endif
                                    </td>
                                    <td>{{ $item['created_at'] }}</td>
                                    <td>
                                        <a href="{{ route('adminUserDelete', $item['id']) }}"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa khách hàng này không ?')"
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
