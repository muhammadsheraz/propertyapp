@extends ('backend.layouts.app')

@section ('title', __('labels.backend.access.brokers.management') . ' | ' . __('labels.backend.access.brokers.create'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    {{ 
        html()->form('POST', route('admin.auth.broker.store'))
            ->class('form-horizontal')
            ->attribute('enctype', 'multipart/form-data')
            ->attribute('id', 'broker_form')
            ->open() 
    }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            {{ __('labels.backend.access.brokers.management') }}
                            <small class="text-muted">{{ __('labels.backend.access.brokers.create') }}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr />

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            <div class="col-md-3">
                                {{ html()->label(__('validation.attributes.backend.access.brokers.first_name'))->class('form-control-label')->for('first_name') }}    
                                {{ html()->text('first_name')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}                            
                            </div>
                            <div class="col-md-3">
                            {{ html()->label(__('validation.attributes.backend.access.brokers.last_name'))->class('form-control-label')->for('last_name') }}
                            
                                {{ html()->text('last_name')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)
                                    ->required()}}                            
                            </div>
                            <div class="col-md-3">
                                {{ html()->label(__('validation.attributes.backend.access.brokers.city'))->class('form-control-label')->for('city_id') }}
                                <select name="city_id" id="city_id" class="form-control select2" required>
                                    @foreach ($cities as $city)
                                        <option class="" value="{{ $city->id }}">{{ $city->city_name }}</option>
                                    @endforeach
                                </select>                          
                            </div> 
                            <div class="col-md-3">
                                {{ html()->label(__('validation.attributes.backend.access.brokers.district'))->class('form-control-label')->for('district_id') }}
                                <select name="district_id" id="district_id" class="form-control select2" required>
                                    @foreach ($districts as $district)
                                        <option class="" value="{{ $district->id }}" data-city-id="{{ $district->city_id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>                          
                            </div>                           
                        </div><!--form-group-->

                        <div class="form-group row">                            

                            <div class="col-md-3">
                                {{ html()->label(__('validation.attributes.backend.access.brokers.email'))->class('form-control-label')->for('email') }}
                                {{ html()->email('email')
                                        ->class('form-control')
                                        ->attribute('maxlength', 191)
                                        ->required() }}                           
                            </div>                            
                            <div class="col-md-3">
                                {{ html()->label(__('validation.attributes.backend.access.brokers.password'))->class('form-control-label')->for('password') }}
                                {{ html()->password('password')
                                    ->class('form-control')
                                    ->required() }}
                            </div>  
                            <div class="col-md-3">
                                {{ html()->label(__('validation.attributes.backend.access.brokers.password_confirmation'))->class('form-control-label')->for('password_confirmation') }}
                                {{ html()->password('password_confirmation')
                                    ->class('form-control')
                                    ->required() }}
                            </div>

                            <div class="col-md-3">
                                    <label class="form-control-label">{{ __('labels.backend.access.brokers.table.profile_photo') }}</label>
                                                    <input type="hidden" name="avatar_type" value="gravatar" />
                                                    <input type="hidden" name="avatar_type" value="storage" checked/>
                                                
                                                {{ html()->file('profile_photo')->class('form-control') }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            <div class="col-md-3">
                                {{ html()->label(__('validation.attributes.backend.access.brokers.company_name'))->class('form-control-label')->for('company_name') }}
                                {{ html()->text('company_name')
                                        ->class('form-control')
                                        ->attribute('maxlength', 75) }}                       
                            </div>                          
                            <div class="col-md-3">
                            {{ html()->label(__('validation.attributes.backend.access.brokers.tax_no'))->class('form-control-label')->for('tax_no') }}
                                {{ html()->text('tax_no')
                                    ->class('form-control')
                                    ->attribute('maxlength', 75) }}                 
                            </div>                 
                            <div class="col-md-3">
                                {{ html()->label(__('validation.attributes.backend.access.brokers.phone_no'))->class('form-control-label')->for('phone_no') }}    
                                {{ html()->text('phone_no')
                                    ->type('number')
                                    ->class('form-control')
                                    ->attribute('maxlength', 75)->required() }}                    
                            </div>  
                            <div class="col-md-3">
                                {{ html()->label(__('validation.attributes.backend.access.brokers.mobile_no'))->class('form-control-label')->for('mobile_no') }}      
                                {{ html()->text('mobile_no')
                                    ->type('number')
                                    ->class('form-control')
                                    ->attribute('maxlength', 75)->required() }}                    
                            </div>  
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
                                    {{ html()->checkbox('active', false, '1')->class('switch-input') }}
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row d-none">
                            {{ html()->label(__('validation.attributes.backend.access.brokers.confirmed'))->class('col-md-2 form-control-label')->for('confirmed') }}

                            <div class="col-md-10">
                                <label class="switch switch-3d switch-primary">
                                    {{ html()->checkbox('confirmed', false, '1')->class('switch-input') }}
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div><!--col-->
                        </div><!--form-group-->

                        @if (! config('access.brokers.requires_approval'))
                            <div class="form-group row d-none">
                                {{ html()->label(__('validation.attributes.backend.access.brokers.send_confirmation_email') . '<br/>' . '<small>' .  __('strings.backend.access.brokers.if_confirmed_off') . '</small>')->class('col-md-2 form-control-label')->for('confirmation_email') }}

                                <div class="col-md-10">
                                    <label class="switch switch-3d switch-primary">
                                        {{ html()->checkbox('confirmation_email', true, '1')->class('switch-input') }}
                                        <span class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                </div><!--col-->
                            </div><!--form-group-->
                        @endif

                        <div class="form-group row d-none">
                            {{ html()->label('Abilities')->class('col-md-2 form-control-label') }}

                            <div class="col-md-10">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th style="display:none;">{{ __('labels.backend.access.brokers.table.roles') }}</th>
                                            <th>{{ __('labels.backend.access.brokers.table.permissions') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td style="display:none;">
                                                @if ($roles->count())
                                                    @foreach($roles as $role)
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <div class="checkbox">
                                                                    {{ html()->label(
                                                                            html()->checkbox('roles[]', $role->id == 2, $role->name)
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
                                                                    <?php $rolePermissions = []; ?>
                                                                    @if ($role->permissions->count())
                                                                        @foreach ($role->permissions as $permission)
                                                                            <?php $rolePermissions[] = $permission->name; ?>
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
                                                @if ($permissions->count())
                                                    @foreach($permissions as $permission)
                                                        <div class="checkbox">
                                                            {{ html()->label(
                                                                    html()->checkbox('permissions[]', in_array($permission->name, $rolePermissions), $permission->name)
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
                                </div>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        
                        <div class="col-md-3">
                                {{ html()->label(__('validation.attributes.backend.access.brokers.nearest_landmark'))->class('form-control-label')->for('phone_no') }}
                                {{ 
                                    html()->text('nearest_landmark')
                                    ->class('form-control')
                                }}                    
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <strong>{{ html()->label(__('labels.general.commission_sale'))->class('form-control-label') }}</strong>
                                    </div>                    
                                    <div class="col-md-6">
                                        {{ html()->label(__('labels.general.commission_from_landlord'))->class('form-control-label') }}
                                        <input type="number" name="commission_sale_landlord" value="" class="form-control" required />
                                    </div>
                                    <div class="col-md-6">
                                        {{ html()->label(__('labels.general.commission_from_buyer'))->class('form-control-label') }}
                                        <input type="number" name="commission_sale_buyer" value="" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <strong>{{ html()->label(__('labels.general.commission_rent'))->class('form-control-label') }}</strong>
                                    </div>
                                    <div class="col-md-6">
                                        {{ html()->label(__('labels.general.commission_from_landlord'))->class('form-control-label') }}
                                        <input type="number" name="commission_rent_landlord" value="" class="form-control" required />
                                    </div>
                                    <div class="col-md-6">
                                        {{ html()->label(__('labels.general.commission_from_tenant'))->class('form-control-label') }}
                                        <input type="number" name="commission_rent_tenant" value="" class="form-control" required />
                                    </div>                            
                                </div><!--col-->
                            </div><!--form-group-->                      
                        
                    </div><!--col-->
                    <div class="form-group row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    {{ html()->label(__('labels.general.property_limit'))->class('form-control-label') }}
                                    <input type="number" name="property_limit" value="" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection

@push('after-scripts')
    <script type="text/javascript">
        $('#district_id').change(function () {
            city_id = $(this).find(':selected').attr('data-city-id');
            $('#city_id').val(city_id).change();
        });

        $('#district_id').find(':first-child').prop('selected',true).change();

        $(function () {
            $('#broker_form').validate();
        })
    </script>
@endpush