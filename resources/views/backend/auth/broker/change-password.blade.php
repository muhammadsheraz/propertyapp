@extends ('backend.layouts.app')

@section ('title', __('labels.backend.access.brokers.management') . ' | ' . __('labels.backend.access.brokers.change_password'))

@section('breadcrumb-links')
    @include('backend.auth.broker.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('PATCH', route('admin.auth.broker.change-password.post', $user))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.brokers.management') }}
                        <small class="text-muted">{{ __('labels.backend.access.brokers.change_password') }}</small>
                    </h4>

                    <div class="small text-muted">
                        {{ __('labels.backend.access.brokers.change_password_for', ['user' => $user->name]) }}
                    </div>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.brokers.password'))->class('col-md-2 form-control-label')->for('password') }}

                        <div class="col-md-10">
                            {{ html()->password('password')
                                ->class('form-control')
                                ->placeholder( __('validation.attributes.backend.access.brokers.password'))
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.brokers.password_confirmation'))->class('col-md-2 form-control-label')->for('password_confirmation') }}

                        <div class="col-md-10">
                            {{ html()->password('password_confirmation')
                                ->class('form-control')
                                ->placeholder( __('validation.attributes.backend.access.brokers.password_confirmation'))
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.broker.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection
