<div class="section__menu">
    <div class="section__menu-header d-flex justify-content-between">
        <div class="text-uppercase section__menu-header-name">menu</div>
        <div class="section__menu-header-times">X</div>
    </div>

    <div class="section__menu-content">
        <ul class="list-unstyled">
            <li class="section__menu-content-item">
                <form action="" class="position-relative">
                    <input type="text" class="form-control section__menu-content-input"
                        placeholder="Search..." />
                    <button type="submit" class="section__menu-content-btn">
                        Search
                    </button>
                </form>
            </li>
            <li class="section__menu-content-item pt-4">
                <a href="{{ route('userHome') }}">
                    @lang('header.home')
                </a>
            </li>
            <li class="section__menu-content-item">
                <a href="{{ route('userProductShop') }}">
                    @lang('header.product')
                </a>
            </li>
            <li class="section__menu-content-item">
                <a href="{{ route('userAbout') }}">
                    @lang('header.about')
                </a>
            </li>
            <li class="section__menu-content-item">
                <a href="{{ route('userContact') }}"> 
                    @lang('header.contact')    
                </a>
            </li>
        </ul>
    </div>
</div>