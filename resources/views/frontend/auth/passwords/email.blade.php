@extends('frontend.layouts.login')

@section('title', app_name() . ' | '.__('labels.frontend.passwords.reset_password_box_title'))

@section('content')

    <div class="login-form">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        {{ html()->form('POST', route('frontend.auth.password.email.post'))->open() }}        
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                {{ html()->email('email')
                    ->class('form-control')
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--form-group-->
            <button type="submit" class="btn btn-primary btn-flat m-b-15">{{__('labels.frontend.passwords.send_password_reset_link_button')}}</button>
        {{ html()->form()->close() }}
    </div> 
@endsection
