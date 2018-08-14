@extends('frontend.layouts.register')

@section('title', app_name() . ' | '.__('labels.frontend.auth.register_box_title'))

@section('content')
    <div class="login-form">
        {{ html()->form('POST', route('frontend.auth.register.post'))->open() }}
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }}

                {{ html()->text('first_name')
                    ->class('form-control')
                    ->attribute('maxlength', 191) }}
            </div><!--col-->
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}

                {{ html()->text('last_name')
                    ->class('form-control')
                    ->attribute('maxlength', 191) }}
            </div><!--form-group-->
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                {{ html()->email('email')
                    ->class('form-control')
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.phone_no'))->for('phone_no') }}

                {{ html()->text('phone_no')
                    ->type('number')
                    ->class('form-control')
                    ->attribute('maxlength', 20)
                    ->required() }}
            </div><!--form-group-->
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.mobile_no'))->for('mobile_no') }}

                {{ html()->text('mobile_no')
                    ->type('number')
                    ->class('form-control')
                    ->attribute('maxlength', 20)
                    ->required() }}
            </div><!--form-group-->
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

                {{ html()->password('password')
                    ->class('form-control')
                    ->required() }}
            </div><!--form-group-->
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}

                {{ html()->password('password_confirmation')
                    ->class('form-control')
                    ->required() }}
            </div><!--form-group-->

            @if (config('access.captcha.registration'))
            <div class="form-group">
                {{ html()->label(__('validation.attributes.captcha'))->for('captcha') }}
                <label class=""><img src="{{ Captcha::url() }}" class="captcha-image" /></label>
                <input type="text"id="captcha" class="form-control" name="captcha">
            </div>
            @endif
            
        {{ form_submit(__('labels.frontend.auth.register_button')) }}
        <div class="social-login-content" style="display:none;">
            <div class="social-button">
                <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Sign in with facebook</button>
                <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Sign in with twitter</button>
            </div>
        </div>
        <div class="register-link m-t-15 text-center">
            <p>Already have account ? <a href="{{ route('frontend.auth.login') }}">{{ __('navs.frontend.login') }}</a></p>
        </div>
        {{ html()->form()->close() }}
    </div>
@endsection

@push('after-scripts')

@endpush
