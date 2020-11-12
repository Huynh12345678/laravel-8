@extends('layout.frontend.layout')

@section('title', 'Liên hệ')

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
                            <li>Liên hệ</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section mt-5">
        <div class="section__contact">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3898.7469931594505!2d109.19320581435744!3d12.26539333329949!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3170678c61b8f251%3A0x115f6f97f1af1d7c!2sTh%C3%A1p%20Po%20Nagar!5e0!3m2!1svi!2s!4v1603264644186!5m2!1svi!2s"
                            width="100%" height="450" frameborder="0" style="border: 0" allowfullscreen=""
                            aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-6">
                        <h2>Thông tin liên hệ</h2>

                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Officiis qui a perspiciatis sed veritatis magnam, fuga eos,
                            suscipit voluptas laborum dolorem excepturi cumque dolor ullam
                            deserunt, harum officia rem! Autem. Lorem ipsum dolor sit amet
                            consectetur adipisicing elit. Officiis qui a perspiciatis sed
                            veritatis magnam, fuga eos, suscipit voluptas laborum dolorem
                            excepturi cumque dolor ullam deserunt, harum officia rem! Autem.
                        </p>
                    </div>

                    <div class="col-md-6 mt-4 mt-md-0">
                        <h2>Bạn muốn hỗ trợ gì ?</h2>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-check-all mr-2"></i>
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{ route('userPostContact') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="text-capitalize">Họ và tên</label>
                                <input type="text" value="{{ old('name') }}" name="name"
                                    class="form-control @error('name') is-invalid @enderror" />

                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="text-capitalize">Email</label>
                                <input type="text" value="{{ old('email') }}" name="email"
                                    class="form-control @error('email') is-invalid @enderror" />

                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="text-capitalize">Số điện thoại</label>
                                <input type="text" value="{{ old('phone') }}" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror" />

                                @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="text-capitalize">Tiêu đề</label>
                                <select class="custom-select @error('title') is-invalid @enderror" name="title">
                                    <option value="" selected>[--- Chọn tiêu đề ---]</option>
                                    <option value="1" {{ old('title') == 1 ? 'selected' : '' }}>Hỏi đáp</option>
                                    <option value="2" {{ old('title') == 2 ? 'selected' : '' }}>Hỗ trợ</option>
                                    <option value="3" {{ old('title') == 3 ? 'selected' : '' }}>Tư vấn</option>
                                </select>

                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="text-capitalize">Nội dung</label>
                                <textarea class="form-control @error('body') is-invalid @enderror" name="body" cols="30"
                                    rows="10">
                                {{ old('body') }}
                                </textarea>

                                @error('body')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="section__contact-btn">
                                    Gửi liên hệ
                                </button>
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

            // Register
            $(document).on('submit', '#postRegisterForm', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('userPostRegister') }}",
                    type: "post",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.errors) {
                            if (response.errors.fullname) {
                                $('#fullname').addClass('is-invalid');
                                $('.invalid-feedback.fullname').html(response.errors.fullname);
                            } else {
                                $('#fullname').removeClass('is-invalid');
                                $('#fullname').addClass('is-valid');
                                $('.invalid-feedback.fullname').html('');
                            }

                            if (response.errors.email) {
                                $('#email').addClass('is-invalid');
                                $('.invalid-feedback.email').html(response.errors.email);
                            } else {
                                $('#email').removeClass('is-invalid');
                                $('#email').addClass('is-valid');
                                $('.invalid-feedback.email').html('');
                            }

                            if (response.errors.phone) {
                                $('#phone').addClass('is-invalid');
                                $('.invalid-feedback.phone').html(response.errors.phone);
                            } else {
                                $('#phone').removeClass('is-invalid');
                                $('#phone').addClass('is-valid');
                                $('.invalid-feedback.phone').html('');
                            }

                            if (response.errors.username) {
                                $('#username').addClass('is-invalid');
                                $('.invalid-feedback.username').html(response.errors.username);
                            } else {
                                $('#username').removeClass('is-invalid');
                                $('#username').addClass('is-valid');
                                $('.invalid-feedback.username').html('');
                            }

                            if (response.errors.password) {
                                $('#password').addClass('is-invalid');
                                $('.invalid-feedback.password').html(response.errors.password);
                            } else {
                                $('#password').removeClass('is-invalid');
                                $('#password').addClass('is-valid');
                                $('.invalid-feedback.password').html('');
                            }
                        } else {
                            Command: toastr["success"](
                                "Đăng ký thành công! Bây giờ bạn có thể đăng nhập.")
                            showToastr();

                            $('#fullname').addClass('is-valid');
                            $('#fullname').removeClass('is-invalid');
                            $('.invalid-feedback.fullname').html('');

                            $('#email').addClass('is-valid');
                            $('#email').removeClass('is-invalid');
                            $('.invalid-feedback.email').html('');

                            $('#phone').addClass('is-valid');
                            $('#phone').removeClass('is-invalid');
                            $('.invalid-feedback.phone').html('');

                            $('#username').addClass('is-valid');
                            $('#username').removeClass('is-invalid');
                            $('.invalid-feedback.username').html('');

                            $('#password').addClass('is-valid');
                            $('#password').removeClass('is-invalid');
                            $('.invalid-feedback.password').html('');

                            $('#dataRegister').modal('hide');
                            $('#dataLogin').modal('show');
                        }
                    }
                })
            })

            // Login
            $(document).on('submit', '#postLoginForm', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('userPostLogin') }}",
                    type: "post",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.error) {
                            if (response.error.usernameLogin) {
                                $('#usernameLogin').addClass('is-invalid');
                                $('.invalid-feedback.usernameLogin').html(response.error.usernameLogin);
                            } else {
                                $('#usernameLogin').removeClass('is-invalid');
                                $('#usernameLogin').addClass('is-valid');
                                $('.invalid-feedback.usernameLogin').html('');
                            }

                            if (response.error.passwordLogin) {
                                $('#passwordLogin').addClass('is-invalid');
                                $('.invalid-feedback.passwordLogin').html(response.error.passwordLogin);
                            } else {
                                $('#passwordLogin').removeClass('is-invalid');
                                $('#passwordLogin').addClass('is-valid');
                                $('.invalid-feedback.passwordLogin').html('');
                            }
                        } else {
                            if(response.danger) {
                                Command: toastr["error"](
                                response.danger)
                                showToastr();
                            }

                            if(response.success) {
                                Command: toastr["success"](
                                response.success)
                                showToastr();
                            }

                            $('#dataLogin').modal('hide');
                            showLogin();
                            showLoginName();
                        }
                    }
                })
            })

            // Login
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
                    }
                })
            })
        })

    </script>
@endsection
