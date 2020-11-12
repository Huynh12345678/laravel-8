 <!-- header top -->
 <div class="header__top">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-left">
                <p class="header__top-support mb-3 mb-md-0">
                    @lang('header.support'): 038 9747 179
                </p>
            </div>
            <div class="col-md-6">
                <ul
                    class="list-unstyled d-flex flex-wrap justify-content-md-end dropdown justify-content-center">
                    <li class="header__top-item position-relative">
                        <a href="javascript:void(0)" class="header__top-link dropdown-toggle"
                            data-toggle="dropdown">
                            @lang('header.language')
                        </a>

                        <ul class="dropdown-menu list-unstyled">
                            <li>
                                <a href="{!! route('changeLanguage', ['en']) !!}" class="dropdown-menu-link">
                                    English
                                </a>
                            </li>

                            <li>
                                <a href="{!! route('changeLanguage', ['vi']) !!}" class="dropdown-menu-link">
                                    Vietnamese
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="header__top-item position-relative">
                        <a href="javascript:void(0)" class="header__top-link dropdown-toggle"
                            data-toggle="dropdown" id="userLoginName">
                            @lang('header.account')
                        </a>

                        <ul class="dropdown-menu list-unstyled" id="userLogin">
                            
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end header top -->

<!-- header mid -->
<div class="header__mid">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-3 col-6 order-lg-0 order-0">
                <a href="{{ url('') }}">
                    <img src="{{ url('') }}/images/logo.jpg" class="img-fluid" alt="Logo" />
                </a>
            </div>

            <div class="col-lg-8 col-12 order-lg-1 order-2 d-lg-block d-none">
                <div class="header__mid-form">
                    <form action="{{ route('userSearch') }}" class="position-relative" method="GET">
                        <input type="text" class="form-control header__mid-form-input autocomplete"
                            placeholder="@lang('header.search')..." name="s" id="autocomplete" />
                        <button type="submit" class="header__mid-form-btn">
                            Search
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-1 col-6 order-lg-2 order-1">
                <div class="header__mid-cart">
                    <div class="header__mid-cart-thumb d-flex justify-content-end position-relative">
                        <img src="{{ url('')}}/images/cart.png" class="img-fluid header__mid-cart-open" alt="My Cart" />

                        <div class="header__mid-cart-quantity" id="header__mid-cart-quantity"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end header mid -->

<!-- header menu -->
<div class="header__menu">
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-lg-block d-none">
                <ul class="list-unstyled d-flex flex-wrap justify-content-center">
                    <li class="header__menu-item">
                        <a href="{{ route('userHome') }}" class="header__menu-link">
                            @lang('header.home')
                        </a>
                    </li>
                    <li class="header__menu-item">
                        <a href="{{ route('userProductShop') }}" class="header__menu-link">
                            @lang('header.product')
                        </a>
                    </li>
                    <li class="header__menu-item">
                        <a href="{{ route('userAbout') }}" class="header__menu-link">
                            @lang('header.about')
                        </a>
                    </li>
                    <li class="header__menu-item">
                        <a href="{{ route('userContact') }}" class="header__menu-link"> 
                            @lang('header.contact')    
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-12 d-lg-none d-block">
                <div class="header__menu-mobile">
                    <i class="fa fa-bars header__menu-mobile-open" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end header menu -->