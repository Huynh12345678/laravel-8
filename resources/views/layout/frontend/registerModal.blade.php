<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header border-0">
            <h5>&nbsp;</h5>
            <a href="javascript:void(0)" data-dismiss="modal">X</a>
        </div>
        <div class="modal-body section__modal" id="dataRegister">
            <h4 class="text-uppercase text-center">@lang('header.register')</h4>

            <form action="{{ route('userPostRegister') }}" id="postRegisterForm" method="POST">
                @csrf
                <div class="form-group">
                    <label class="text-capitalize">@lang('header.fullname')</label>
                    <input type="text" class="form-control" id="fullname" name="fullname">
                    <div class="invalid-feedback fullname"></div>
                </div>

                <div class="form-group">
                    <label class="text-capitalize">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                    <div class="invalid-feedback email"></div>
                </div>

                <div class="form-group">
                    <label class="text-capitalize">@lang('header.phone')</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                    <div class="invalid-feedback phone"></div>
                </div>

                <div class="form-group">
                    <label class="text-capitalize">@lang('header.username')</label>
                    <input type="text" class="form-control" id="username" name="username">
                    <div class="invalid-feedback username"></div>
                </div>

                <div class="form-group">
                    <label class="text-capitalize">@lang('header.password')</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="invalid-feedback password"></div>
                </div>

                <div class="form-group">
                    <button type="submit" class="section__contact-btn">
                        @lang('header.register')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
