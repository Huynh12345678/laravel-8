@extends('layout.frontend.layout')

@section('title', 'Cập nhật thông tin khách hàng')

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
                            <li>Cập nhật thông tin khách hàng</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section__useredit mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('userPostEdit', $row['id']) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="thumbOld" value="{{ $row['thumb'] }} ">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-capitalize">Họ và tên</label>
                                        <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') ? old('fullname') : $row['fullname'] }}">

                                        @error('fullname')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-capitalize">Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ? old('email') : $row['email'] }}">

                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-capitalize">Số điện thoại</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ? old('phone') : $row['phone'] }}">

                                        @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-capitalize">Trạng thái</label>
                                        <input type="text" class="form-control" name="status" value="@if ($row['status'] == 1) Đang hoạt động @endif" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-capitalize">Nơi ở hiện tại</label>
                                <textarea name="address" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror">{{ old('address') ? old('address') : $row['address'] }}</textarea>

                                @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="text-capitalize">Giới tính</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="2" name="gender" {{ $row['gender'] == 2 ? 'checked' : '' }}>
                                        Nam
                                      </label>
                                    </div>
    
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="1" name="gender" {{ $row['gender'] == 1 ? 'checked' : '' }}>
                                            Nữ
                                      </label>
                                    </div>
    
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="0" name="gender" {{ $row['gender'] == 0 ? 'checked' : '' }}>
                                            Khác
                                      </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-8">
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" name="thumb" id="file" onchange="previewImages()">
                                        <label class="custom-file-label">Chọn Ảnh...</label>
                                    </div>
                                </div>

                                <div class="col-md-4 d-flex justify-content-end">
                                    @if ($row['thumb'] == 'user.png')
                                    <img src="{{ url('images/user.png') }}" class="imagesPreview img-fluid" alt="Default User">    
                                    @else
                                    <img src="{{ url('uploads/user/'.$row['thumb']) }}" class="imagesPreview img-fluid" alt="{{ $row['fullname'] }}">
                                    @endif
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Cập Nhật</button>
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

        // uploads file
        function previewImages() {
            const file = document.querySelector('#file');
            const label = document.querySelector('.custom-file-label');
            const imagesPreview = document.querySelector('.imagesPreview');

            label.textContent = file.files[0].name;

            const fileName = new FileReader();
            fileName.readAsDataURL(file.files[0]);

            fileName.onload = function(e) {
                imagesPreview.src = e.target.result;
            }
        }
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
