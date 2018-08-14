@extends('frontend.layouts.login')

@section('title', app_name() . ' | '.__('labels.frontend.auth.login_box_title'))

@section('content')
    <div class="login-form">
        {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
        <div class="form-group d-none">
            {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}
            {{ html()->email('email')
                ->class('form-control')
                ->attribute('maxlength', 191) }}
        </div>
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.phone_no'))->for('phone_no') }}

            {{ html()->text('phone_no')->class('form-control') }}
        </div>
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

            {{ html()->password('password')
                ->class('form-control')
                ->required() }}
        </div>
        <div class="checkbox">
            <label>
                {{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
            </label>
            <label class="pull-right">
                <a href="{{ route('frontend.auth.password.reset') }}">{{ __('labels.frontend.passwords.forgot_password') }}</a>
            </label>

        </div>

        @if (config('access.captcha.login') AND $use_captcha)
            <div class="form-group">
                {{ html()->label(__('validation.attributes.captcha'))->for('captcha') }}
                <label class=""><img src="{{ Captcha::url() }}" class="captcha-image" /></label>
                <input type="text"id="captcha" class="form-control" name="captcha">
            </div>
        @endif        
            {{ form_submit(__('labels.frontend.auth.login_button')) }}
        <div class="social-login-content d-none">
            <div class="social-button">
                <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Sign in with facebook</button>
                <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Sign in with twitter</button>
            </div>
        </div>
        <div class="register-link m-t-15 text-center d-none">
            <p>Don't have account ? <a href="{{ route('frontend.auth.register') }}">{{ __('navs.frontend.register') }}</a></p>
        </div>
        <br>
        <br>
        <br>
        {{ html()->form()->close() }}
    </div>
@endsection


@push('after-scripts')

@endpush