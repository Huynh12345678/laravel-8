<div class="section__sidebar">
    <div class="section__sidebar-header d-flex justify-content-between">
        <div class="text-uppercase section__sidebar-header-name">
             @lang('home.cart-title') 
        </div>
        <div class="section__sidebar-header-times">X</div>
    </div>

    <div class="section__sidebar-content">
        <ul class="list-unstyled" id="cart-data">
            
        </ul>
    </div>

    <div class="section__sidebar-footer pt-3">
        <div class="section__sidebar-footer-total" id="cart-total">
            
        </div>
    </div>

    <div class="section__sidebar-redirect">
        <a href="{{ route('userCart') }}" class="section__sidebar-redirect-btn">
            @lang('home.cart-view') 
        </a>

        <a href="{{ route('userCheckout') }}" class="section__sidebar-redirect-btn">
            @lang('home.cart-checkout') 
        </a>
    </div>
</div>