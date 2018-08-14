{{ html()->modelForm($logged_in_user, 'PATCH', route('admin.profile.update'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.avatar'))->for('avatar') }}

                <div>
                    <input type="radio" name="avatar_type" value="gravatar" {{ $logged_in_user->avatar_type == 'gravatar' ? 'checked' : '' }} /> {{ __('strings.frontend.gravatar') }}
                    <input type="radio" name="avatar_type" value="storage" {{ $logged_in_user->avatar_type == 'storage' ? 'checked' : '' }} /> {{ __('strings.frontend.upload') }}

                    @foreach ($logged_in_user->providers as $provider)
                        @if (strlen($provider->avatar))
                            <input type="radio" name="avatar_type" value="{{ $provider->provider }}" {{ $logged_in_user->avatar_type == $provider->provider ? 'checked' : '' }} /> {{ ucfirst($provider->provider) }}
                        @endif
                    @endforeach
                </div>
            </div><!--form-group-->

            <div class="form-group hidden" id="avatar_location">
                {{ html()->file('avatar_location')->class('form-control') }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <?php if (auth()->user()->hasRole('broker') AND $logged_in_user->contract_file == '') { ?>
    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.contract'))->for('contract') }}

                {{ html()->file('contract_file')->class('form-control') }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
    <?php } ?>

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }}

                {{ html()->text('first_name')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.first_name'))
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--form-group-->
        </div><!--col-->
    
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}

                {{ html()->text('last_name')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.last_name'))
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="form-group row">
        {{ html()->label(__('labels.general.commission_sale'))->class('col-md-2 form-control-label') }}

        <div class="col-md-10">
            <div class="form-group row">
                <div class="col-md-2">
                    {{ html()->label(__('labels.general.commission_from_landlord'))->class('form-control-label') }}
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="number" name="commission_sale_landlord" value="{{ $logged_in_user->commission_sale_landlord }}"  class="form-control" />
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>                                        
                    </div>
                </div>
                <div class="col-md-2">
                    {{ html()->label(__('labels.general.commission_from_buyer'))->class('form-control-label') }}
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="number" name="commission_sale_buyer" value="{{ $logged_in_user->commission_sale_buyer }}" class="form-control" required />
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>                                        
                    </div>                                
                </div>
            </div>
        </div><!--col-->
    </div><!--form-group--> 
    
    <div class="form-group row">
        {{ html()->label(__('labels.general.commission_rent'))->class('col-md-2 form-control-label') }}

        <div class="col-md-10">
            <div class="form-group row">
                <div class="col-md-2">
                    {{ html()->label(__('labels.general.commission_from_landlord'))->class('form-control-label') }}
                </div>
                <div class="col-md-3">
                    {{ html()->label(__('strings.backend.one_month_rent'))->class('form-control-label') }}
                </div>
                <div class="col-md-2">
                    {{ html()->label(__('labels.general.commission_from_tenant'))->class('form-control-label') }}
                </div>
                <div class="col-md-3">
                    {{ html()->label(__('strings.backend.one_month_rent'))->class('form-control-label') }}
                </div>
            </div>
        </div><!--col-->
    </div><!--form-group-->     

    @if ($logged_in_user->canChangeEmail())
        <div class="row">
            <div class="col">
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> {{  __('strings.frontend.user.change_email_notice') }}
                </div>

                <div class="form-group">
                    {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                    {{ html()->email('email')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.frontend.email'))
                        ->attribute('maxlength', 191)
                        ->required() }}
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->
    @endif

    <div class="row d-none">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.timezone'))->for('timezone') }}

                <select name="timezone" id="timezone" class="form-control" required="required">
                    @foreach (timezone_identifiers_list() as $timezone)
                        <option value="{{ $timezone }}" {{ $timezone == $logged_in_user->timezone ? 'selected' : '' }} {{ $timezone == old('timezone') ? ' selected' : '' }}>{{ $timezone }}</option>
                    @endforeach
                </select>
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group mb-0 clearfix">
                {{ form_submit(__('labels.general.buttons.update')) }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
{{ html()->closeModelForm() }}

@push('after-scripts')
    <script>
        $(function() {
            var avatar_location = $("#avatar_location");

            if ($('input[name=avatar_type]:checked').val() === 'storage') {
                avatar_location.show();
            } else {
                avatar_location.hide();
            }

            $('input[name=avatar_type]').change(function() {
                if ($(this).val() === 'storage') {
                    avatar_location.show();
                } else {
                    avatar_location.hide();
                }
            });
        });
    </script>
@endpush