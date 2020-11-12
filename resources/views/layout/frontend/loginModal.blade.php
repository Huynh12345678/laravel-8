<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header border-0">
            <h5>&nbsp;</h5>
            <a href="javascript:void(0)" data-dismiss="modal">X</a>
        </div>
        <div class="modal-body section__modal" id="dataLogin">
            <h4 class="text-uppercase text-center">@lang('header.login')</h4>

            <form action="{{ route('userPostLogin') }}" id="postLoginForm" method="POST">
                @csrf
                <div class="form-group">
                    <label class="text-capitalize">@lang('header.username')</label>
                    <input type="text" class="form-control" id="usernameLogin" name="usernameLogin">
                    <div class="invalid-feedback usernameLogin"></div>
                </div>

                <div class="form-group">
                    <label class="text-capitalize">@lang('header.password')</label>
                    <input type="password" class="form-control" id="passwordLogin" name="passwordLogin">
                    <div class="invalid-feedback passwordLogin"></div>
                </div>

                <div class="form-group">
                    <button type="submit" class="section__contact-btn">
                        @lang('header.login')
                    </button>
                </div>
            </form>

            <p>
                <a href="{{ route('userForgotPassword') }}" class="text-capitalize" style="text-decoration: underline !important">@lang('header.forgot') ?</a>
            </p>
        </div>
    </div>
</div>
