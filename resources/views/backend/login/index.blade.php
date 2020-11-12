<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Minton - Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('') }}\assets\images\favicon.ico">

    <!-- App css -->
    <link href="{{ url('') }}\assets\css\bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{ url('') }}\assets\css\icons.min.css" rel="stylesheet" type="text/css">
    <link href="{{ url('') }}\assets\css\app.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <a href="{{ url('') }}">
                                    <span><img src="{{ url('') }}/images/logo.jpg" alt="" height="22"></span>
                                </a>
                                <p class="text-muted mb-4 mt-3 text-capitalize">Đăng nhập để xác nhận vào trang quản
                                    trị.</p>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="emailaddress">Email</label>
                                    <input class="form-control" type="email" name="email" placeholder="Enter your email"
                                        value="{{ old('value') }}">

                                    @error('email')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" name="password"
                                        placeholder="Enter your password">
                                    @error('password')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="remember" id="checkbox-signin" checked="">
                                        <label class="custom-control-label" for="checkbox-signin">Nhớ mật khẩu</label>
                                    </div>
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block text-capitalize" type="submit"> Đăng nhập
                                    </button>
                                </div>

                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor js -->
    <script src="{{ url('') }}\assets\js\vendor.min.js"></script>

    <!-- App js -->
    <script src="{{ url('') }}\assets\js\app.min.js"></script>

</body>

</html>
