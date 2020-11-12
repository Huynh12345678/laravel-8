@extends('layout.backend.layout')

@section('title', 'Chi tiết liên hệ')

@section('linkCSS')
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a class="text-capitalize" href="javascript: void(0);">Circle</a></li>
                        <li class="breadcrumb-item"><a class="text-capitalize" href="javascript: void(0);">LIên hệ</a></li>
                        <li class="breadcrumb-item active text-capitalize">Chi tiết</li>
                    </ol>
                </div>
                <h4 class="page-title text-uppercase">Chi tiết liên hệ</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <a href="{{ route('adminContact') }}" class="btn btn-danger waves-effect waves-light mb-4"><i
            class="remixicon-delete-back-2-line mr-2"></i> Quay Lại</a>

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title text-capitalize mb-3">Chi tiết</h4>

                <form action="{{ route('adminPostContact', $row['id']) }}" method="POST">
                    @csrf

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="text-capitalize">Họ và tên</label>
                                <input type="text" value="{{ $row['name'] }}" class="form-control" name="name" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="text-capitalize">Email</label>
                                <input type="text" value="{{ $row['email'] }}" class="form-control" name="email" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="text-capitalize">Số điện thoại</label>
                                <input type="text" value="{{ $row['phone'] }}" class="form-control" name="phone" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="text-capitalize">Tiêu đề</label>
                                <input type="text" value=" @php
                                if($row['title'] == 1) {
                                    echo 'Hỏi đáp';
                                } else if($row['title'] == 2) {
                                    echo 'Hỗ trợ';
                                } else if ($row['title'] == 3) {
                                    echo 'Tư vấn';
                                }
                            @endphp" class="form-control" name="title" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="text-capitalize">Nội dung liên hệ</label>
                        <textarea name="body" cols="30" rows="10" class="form-control" readonly>{{ $row['body'] }}</textarea>
                    </div>

                    <div class="form-group mt-5 mb-3">
                        <label class="text-capitalize">Trả lời liên hệ</label>
                        <textarea name="reply" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1 text-capitalize">
                                Trả lời
                            </button>
                        </div>
                    </div>
                </form>

            </div> <!-- end card-box-->

        </div>
        <!-- end col -->
    </div>
@endsection

@section('linkJS')
@endsection
