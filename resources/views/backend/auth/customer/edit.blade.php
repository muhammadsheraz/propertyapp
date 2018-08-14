@extends ('backend.layouts.app')

@section ('title', __('labels.backend.access.brokers.management') . ' | ' . __('labels.backend.access.brokers.edit'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($user, 'PATCH', route('admin.auth.broker.update', $user->id))->class('form-horizontal')
->attribute('enctype', 'multipart/form-data')
->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.brokers.management') }}
                        <small class="text-muted">{{ __('labels.backend.access.brokers.edit') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        <div class="col-md-2">
                            {{ html()->label(__('validation.attributes.backend.access.brokers.first_name'))->class('form-control-label')->for('first_name') }}                           
                        </div>
                        <div class="col-md-3">
                            {{ html()->text('first_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.brokers.first_name'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}                            
                        </div>
                        <div class="col-md-2">
                        {{ html()->label(__('validation.attributes.backend.access.brokers.last_name'))->class('form-control-label')->for('last_name') }}
                        </div>
                        <div class="col-md-3">
                            {{ html()->text('last_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.brokers.last_name'))
                                ->attribute('maxlength', 191)
                                ->required()}}                            
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <div class="col-md-2">
                            {{ html()->label(__('validation.attributes.backend.access.brokers.email'))->class('form-control-label')->for('email') }}
                        </div>
                        <div class="col-md-3">
                            {{ html()->email('email')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.brokers.email'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}                           
                        </div>
                        
                    </div><!--form-group-->

                    <div class="form-group row">
                        <div class="col-md-2">
                            {{ html()->label(__('validation.attributes.backend.access.brokers.district'))->class('form-control-label')->for('district_id') }}
                        </div>
                        <div class="col-md-3">
                            <select name="district_id" id="district_id" class="form-control select2" required>
                                @foreach ($districts as $district)
                                    <?php 
                                        if ($district->id == $user->district_id) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option class="" value="{{ $district->id }}" data-city-id="{{ $district->city_id }}" <?php echo $selected ?>>{{ $district->name }}</option>
                                @endforeach
                            </select>                          
                        </div>                            
                        <div class="col-2">
                            {{ html()->label(__('validation.attributes.backend.access.brokers.city'))->class('form-control-label')->for('city_id') }}
                        </div>
                        <div class="col-md-3">
                            <select name="city_id" id="city_id" class="form-control select2" required>
                                @foreach ($cities as $city)
                                    <?php 
                                        if ($city->id == $user->city_id) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>                                
                                    <option class="" value="{{ $city->id }}" <?php echo $selected; ?>>{{ $city->city_name }}</option>
                                @endforeach
                            </select>                          
                        </div>                            
                    </div><!--form-group-->

                    <div class="form-group row">
                        <div class="col-md-2">
                            {{ html()->label(__('validation.attributes.backend.access.brokers.company_name'))->class('form-control-label')->for('company_name') }}
                        </div>
                        <div class="col-md-3">
                            {{ html()->text('company_name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.brokers.company_name'))
                                    ->attribute('maxlength', 75) }}                       
                        </div>                          
                        <div class="col-md-2">
                        {{ html()->label(__('validation.attributes.backend.access.brokers.tax_no'))->class('form-control-label')->for('tax_no') }}
                        </div>
                        <div class="col-md-3">
                            {{ html()->text('tax_no')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.brokers.tax_no'))
                                ->attribute('maxlength', 75) }}                 
                        </div>                          
                    </div><!--form-group-->

                    <div class="form-group row">
                        <div class="col-md-2">
                            {{ html()->label(__('validation.attributes.backend.access.brokers.phone_no'))->class('form-control-label')->for('phone_no') }}                                
                        </div>
                        <div class="col-md-3">
                            {{ html()->text('phone_no')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.brokers.phone_no'))
                                ->attribute('maxlength', 75)->required() }}                    
                        </div>  
                        <div class="col-md-2">
                            {{ html()->label(__('validation.attributes.backend.access.brokers.mobile_no'))->class('form-control-label')->for('mobile_no') }}                                
                        </div>
                        <div class="col-md-3">
                            {{ html()->text('mobile_no')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.brokers.mobile_no'))
                                ->attribute('maxlength', 75)->required() }}                    
                        </div>  
                    </div><!--form-group-->
                    <div class="form-group row">
                        <div class="col-md-2">
                            {{ html()->label(__('validation.attributes.backend.access.brokers.nearest_landmark'))->class('form-control-label')->for('phone_no') }}                                
                        </div>
                        <div class="col-md-3">
                            {{ 
                                html()->text('nearest_landmark')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.brokers.nearest_landmark'))
                            }}                    
                        </div>


                        {{ html()->label(__('validation.attributes.backend.access.brokers.active'))->class('col-md-1 form-control-label')->for('active') }}

                        <div class="col-md-1">
                            <label class="switch switch-3d switch-primary">
                                {{ html()->checkbox('active', !empty($user->active), '1')->class('switch-input broker-status-switch') }}
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div><!--col-->

                        <div class="col-md-1">
                            {{ html()->label(__('validation.attributes.frontend.contract_confirmed'))->class('form-control-label')->for('contract_confirmed') }}
                        </div>
                        
                        <div class="col-md-1">
                            <label class="switch switch-3d switch-primary">
                                {{ html()->checkbox('contract_confirmed', !empty($user->contract_confirmed), '1')->class('switch-input broker-contract-switch') }}
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div><!--col-->                        


                    </div>                    
                    <div class="form-group row d-none">
                            {{ html()->label(__('validation.attributes.backend.access.brokers.timezone'))->class('col-md-2 form-control-label')->for('timezone') }}

                            <div class="col-md-10">
                                <select name="timezone" id="timezone" class="form-control" >
                                    @foreach (timezone_identifiers_list() as $timezone)
                                        <option value="{{ $timezone }}" {{ $timezone == config('app.timezone') ? 'selected' : '' }} {{ $timezone == old('timezone') ? ' selected' : '' }}>{{ $timezone }}</option>
                                    @endforeach
                                </select>
                            </div><!--col-->
                        </div><!--form-group-->

                    <div class="form-group row d-none">
                        {{ html()->label(__('validation.attributes.backend.access.brokers.active'))->class('col-md-2 form-control-label')->for('active') }}

                        <div class="col-md-10">
                            <label class="switch switch-3d switch-primary">
                                {{ html()->checkbox('active', !empty($user->active), '1')->class('switch-input broker-status-switch') }}
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row d-none">
                        <div class="col-md-2">
                            {{ html()->label(__('validation.attributes.frontend.contract_confirmed'))->class('form-control-label')->for('contract_confirmed') }}
                        </div>
                        
                        <div class="col-md-1">
                            <label class="switch switch-3d switch-primary">
                                {{ html()->checkbox('contract_confirmed', !empty($user->contract_confirmed), '1')->class('switch-input broker-contract-switch') }}
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div><!--col-->
                        <?php if (!empty($user->contract_file)) { ?>
                        <div class="col-md-1">
                            {{ html()->label(__('validation.attributes.frontend.contract_file'))->class('form-control-label')->for('contract_confirmed') }}
                        </div>
                        <div class="col-md-4">
                            <a href="{{url("/admin/auth/broker/$user->id/download_contract_file")}}" target="_blank" title="{{ __('strings.download_this_file')}}">
                                {{ basename($user->contract_file) }}
                            </a>
                        </div><!--col-->
                        <?php } ?>
                    </div><!--form-group-->


                    <div class="form-group row d-none">
                        {{ html()->label(__('validation.attributes.backend.access.brokers.confirmed'))->class('col-md-2 form-control-label')->for('confirmed') }}

                        <div class="col-md-10">
                            <label class="switch switch-3d switch-primary">
                                {{ html()->checkbox('confirmed', !empty($user->confirmed), '1')->class('switch-input') }}
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row d-none">
                        {{ html()->label('Abilities')->class('col-md-2 form-control-label') }}

                        <div class="table-responsive col-md-10">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="d-none">{{ __('labels.backend.access.brokers.table.roles') }}</th>
                                        <th>{{ __('labels.backend.access.brokers.table.permissions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="d-none">
                                            @if ($roles->count())
                                                @foreach($roles as $role)
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="checkbox">
                                                                {{ html()->label(
                                                                        html()->checkbox('roles[]', in_array($role->name, $userRoles), $role->name)
                                                                              ->class('switch-input')
                                                                              ->id('role-'.$role->id)
                                                                        . '<span class="switch-label"></span><span class="switch-handle"></span>')
                                                                    ->class('switch switch-sm switch-3d switch-primary')
                                                                    ->for('role-'.$role->id) }}
                                                                {{ html()->label(ucwords($role->name))->for('role-'.$role->id) }}
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            @if ($role->id != 1)
                                                                @if ($role->permissions->count())
                                                                    @foreach ($role->permissions as $permission)
                                                                        <i class="fa fa-dot-circle-o"></i> {{ ucwords($permission->name) }}
                                                                    @endforeach
                                                                @else
                                                                    {{ __('labels.general.none') }}
                                                                @endif
                                                            @else
                                                                {{ __('labels.backend.access.brokers.all_permissions') }}
                                                            @endif
                                                        </div>
                                                    </div><!--card-->
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                        <!-- html()->checkbox('permissions[]', in_array($permission->name, $userPermissions), $permission->name)
                                                                      ->class('switch-input')
                                                                      ->id('permission-'.$permission->id) -->
                                            @if ($permissions->count())
                                                @foreach($permissions as $permission)
                                                    <div class="checkbox">
                                                        {{ html()->label(
                                                                html()->checkbox('permissions[]', true, $permission->name)
                                                                      ->class('switch-input')
                                                                      ->id('permission-'.$permission->id)
                                                                      
                                                                . '<span class="switch-label"></span><span class="switch-handle"></span>')
                                                            ->class('switch switch-sm switch-3d switch-primary')
                                                            ->for('permission-'.$permission->id) }}
                                                        {{ html()->label(ucwords($permission->name))->for('permission-'.$permission->id) }}
                                                    </div>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row  d-none">
                        {{ html()->label('Profile Photo')->class('col-md-2 form-control-label') }}
                        <div class="col-md-10">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th width="50%"></th>
                                        <th width="50%">{{ __('labels.backend.access.brokers.table.change_profile_photo') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="col-md-6 col-lg-6">
                                                <img src="{{ $user->picture }}" class="user-profile-image" />
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <input type="hidden" name="avatar_type" value="gravatar" />
                                                <input type="hidden" name="avatar_type" value="storage" checked/>
                                            </div>
                                            {{ html()->file('profile_photo')->class('form-control') }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!--col-->
                    </div><!--form-group-->  

                    <div class="form-group row">
                        {{ html()->label(__('labels.general.commission_sale'))->class('col-md-2 form-control-label') }}

                        <div class="col-md-10">
                            <div class="form-group row">
                                <div class="col-md-2">
                                    {{ html()->label(__('labels.general.commission_from_landlord'))->class('form-control-label') }}
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="number" name="commission_sale_landlord" value="{{ $user->commission_sale_landlord }}"  class="form-control" />
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
                                        <input type="number" name="commission_sale_buyer" value="{{ $user->commission_sale_buyer }}" class="form-control" required />
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
                                    {{ html()->label(__('strings.backend.one_month_rent'))->class('form-control-label') }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-10 d-none">
                            <div class="form-group row">
                                <div class="col-md-2">
                                    {{ html()->label(__('labels.general.commission_from_landlord'))->class('form-control-label') }}
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="number" name="commission_rent_landlord" value="{{ $user->commission_rent_landlord}}" class="form-control" required />
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {{ html()->label(__('labels.general.commission_from_tenant'))->class('form-control-label') }}
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="number" name="commission_rent_tenant" value="{{ $user->commission_rent_tenant}}" class="form-control" required />
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div><!--col-->
                    </div><!--form-group-->   
                    <div class="form-group row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    {{ html()->label(__('labels.general.property_limit'))->class('form-control-label') }}
                                    <input type="number" name="property_limit" value="{{ $user->property_limit }}" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div><!--col-->                                                        
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection

@push('after-scripts')
    <script>
        $(function() {
            $('#district_id').change(function () {
                city_id = $(this).find(':selected').attr('data-city-id');
                $('#city_id').val(city_id).change();
            });

            <?php if (isset($showtab)) { ?>
            <?php } ?>
        })

    </script>
@endpush

