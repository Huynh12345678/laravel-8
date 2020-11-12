<ul class="list-unstyled topnav-menu float-right mb-0">

    <li class="dropdown d-none d-lg-block">
        <a class="nav-link dropdown-toggle mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <img src="{{ url('') }}\assets\images\flags\us.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">English <i class="mdi mdi-chevron-down"></i> </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <img src="{{ url('') }}\assets\images\flags\germany.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">German</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <img src="{{ url('') }}\assets\images\flags\italy.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Italian</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <img src="{{ url('') }}\assets\images\flags\spain.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Spanish</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <img src="{{ url('') }}\assets\images\flags\russia.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Russian</span>
            </a>

        </div>
    </li>

    <li class="dropdown notification-list">
        <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <i class="fe-bell noti-icon"></i>
            <span class="badge badge-danger rounded-circle noti-icon-badge">4</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-lg">

            <!-- item-->
            <div class="dropdown-item noti-title">
                <h5 class="m-0">
                    <span class="float-right">
                        <a href="" class="text-dark">
                            <small>Clear All</small>
                        </a>
                    </span>Notification
                </h5>
            </div>

            <div class="slimscroll noti-scroll">

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                    <div class="notify-icon bg-soft-primary text-primary">
                        <i class="mdi mdi-comment-account-outline"></i>
                    </div>
                    <p class="notify-details">Doug Dukes commented on Admin Dashboard
                        <small class="text-muted">1 min ago</small>
                    </p>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="notify-icon">
                        <img src="{{ url('') }}\assets\images\users\avatar-2.jpg" class="img-fluid rounded-circle" alt=""> </div>
                    <p class="notify-details">Mario Drummond</p>
                    <p class="text-muted mb-0 user-msg">
                        <small>Hi, How are you? What about our next meeting</small>
                    </p>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="notify-icon">
                        <img src="{{ url('') }}\assets\images\users\avatar-4.jpg" class="img-fluid rounded-circle" alt=""> </div>
                    <p class="notify-details">Karen Robinson</p>
                    <p class="text-muted mb-0 user-msg">
                        <small>Wow ! this admin looks good and awesome design</small>
                    </p>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="notify-icon bg-soft-warning text-warning">
                        <i class="mdi mdi-account-plus"></i>
                    </div>
                    <p class="notify-details">New user registered.
                        <small class="text-muted">5 hours ago</small>
                    </p>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="notify-icon bg-info">
                        <i class="mdi mdi-comment-account-outline"></i>
                    </div>
                    <p class="notify-details">Caleb Flakelar commented on Admin
                        <small class="text-muted">4 days ago</small>
                    </p>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="notify-icon bg-secondary">
                        <i class="mdi mdi-heart"></i>
                    </div>
                    <p class="notify-details">Carlos Crouch liked
                        <b>Admin</b>
                        <small class="text-muted">13 days ago</small>
                    </p>
                </a>
            </div>

            <!-- All-->
            <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                View all
                <i class="fi-arrow-right"></i>
            </a>

        </div>
    </li>

    <li class="dropdown notification-list">
        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-circle">
            <span class="pro-user-name ml-1">
                {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i> 
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
            <!-- item-->
            <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">Xin chào !</h6>
            </div>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="remixicon-account-circle-line"></i>
                <span>My Account</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="remixicon-settings-3-line"></i>
                <span>Settings</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="remixicon-wallet-line"></i>
                <span>My Wallet <span class="badge badge-success float-right">3</span> </span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="remixicon-lock-line"></i>
                <span>Lock Screen</span>
            </a>

            <div class="dropdown-divider"></div>

            <!-- item-->
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();
            this.closest('form').submit();">
                <i class="remixicon-logout-box-line"></i>
                <span>Logout</span>
            </a>
            </form>
        </div>
    </li>

</ul>

<!-- LOGO -->
<div class="logo-box">
    <a href="{{ route('adminDashboard') }}" class="logo text-center">
        <span class="logo-lg">
            <img src="{{ url('') }}\assets\images\logo-light.png" alt="" height="20">
            <!-- <span class="logo-lg-text-light">Xeria</span> -->
        </span>
        <span class="logo-sm">
            <!-- <span class="logo-sm-text-dark">X</span> -->
            <img src="{{ url('') }}\assets\images\logo-sm.png" alt="" height="24">
        </span>
    </a>
</div>

<ul class="list-unstyled topnav-menu topnav-menu-left m-0">
    <li>
        <button class="button-menu-mobile waves-effect waves-light">
            <i class="fe-menu"></i>
        </button>
    </li>
</ul>