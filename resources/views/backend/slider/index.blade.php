@extends('layout.backend.layout')

@section('title', 'Xem danh sách Slider')

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
                        <li class="breadcrumb-item"><a href="javascript: void(0);" class="text-capitalize">Slider</a></li>
                        <li class="breadcrumb-item active text-capitalize">Xem danh sách</li>
                    </ol>
                </div>
                <h4 class="page-title text-uppercase">Danh sách Slider</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <a href="{{ route('adminSliderAdd') }}" class="btn btn-primary waves-effect waves-light mb-4"><i
        class="remixicon-add-fill mr-2"></i> Thêm mới</a>

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
                                <th>Tiêu đề Slider</th>
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
                                        @if ($item['thumb'] == 'default.jpg')
                                            <img src="{{ url('uploads/' . $item['thumb']) }}" width="100px" class="img-fluid"
                                                alt="{{ $item['name'] }}">
                                        @else
                                            <img src="{{ url('uploads/slider/' . $item['thumb']) }}" width="100px"
                                                class="img-fluid" alt="{{ $item['name'] }}">
                                        @endif
                                    </td>
                                    <td class="text-capitalize">{{ $item['name'] }}</td>
                                    <td>
                                        @if ($item['status'] == 1)
                                            <a href="{{ route('adminSliderStatus', $item['id']) }}"
                                                class="btn btn-primary w-sm waves-effect waves-light">
                                                <i class="mdi mdi-check-underline-circle-outline"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('adminSliderStatus', $item['id']) }}"
                                                class="btn btn-danger w-sm waves-effect waves-light">
                                                <i class="mdi mdi-cancel"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $item['created_at'] }}</td>
                                    <td>
                                        <a href="{{ route('adminSliderEdit', $item['id']) }}"
                                            class="btn btn-warning btn-rounded waves-effect waves-light">
                                            <i class="remixicon-pencil-line"></i>
                                        </a>

                                        <a href="{{ route('adminSliderDelete', $item['id']) }}"
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
