<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th>{{ __('labels.frontend.user.profile.avatar') }}</th>
            <td><img src="{{ $logged_in_user->picture }}" class="user-profile-image" /></td>
        </tr>     
    </table>
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th>{{ __('labels.frontend.user.profile.name') }}</th>
            <td>{{ $logged_in_user->name }}</td>

            <th>{{ __('labels.frontend.user.profile.email') }}</th>
            <td>{{ $logged_in_user->email }}</td>
        </tr>
        <tr>
            <th>{{ __('validation.attributes.backend.access.brokers.company_name') }}</th>
            <td>{{ $logged_in_user->company_name }}</td>

            <th>{{ __('validation.attributes.backend.access.brokers.tax_no') }}</th>
            <td>{{ $logged_in_user->tax_no }}</td>
        </tr> 
        <tr>
            <th>{{ __('validation.attributes.backend.access.brokers.phone_no') }}</th>
            <td>{{ $logged_in_user->phone_no }}</td>

            <th>{{ __('validation.attributes.backend.access.brokers.mobile_no') }}</th>
            <td>{{ $logged_in_user->mobile_no }}</td>
        </tr> 
        <tr>
            <th colspan="4">{{ __('labels.general.commission_sale') }}</th>
        </tr>
        <tr>
            <th>{{ __('labels.general.commission_from_landlord') }}</th>
            <td>{{ $logged_in_user->commission_sale_landlord }} %</td>

            <th>{{ __('labels.general.commission_from_buyer') }}</th>
            <td>{{ $logged_in_user->commission_sale_buyer }} %</td>
        </tr> 
        <tr>
            <th colspan="4">{{ __('labels.general.commission_rent') }}</th>
        </tr>               
        <tr>
            <th>{{ __('labels.general.commission_from_landlord') }}</th>
            <td>{{ html()->label(__('strings.backend.one_month_rent'))->class('form-control-label') }}</td>

            <th>{{ __('labels.general.commission_from_tenant') }}</th>
            <td>{{ html()->label(__('strings.backend.one_month_rent'))->class('form-control-label') }}</td>
        </tr>         

        <?php if ($logged_in_user->contract_file != '') { ?>        
            <tr class="d-none">
                <th>{{ __('validation.attributes.frontend.contract') }}</th>
                <td>
                    <a href="{{Storage::url($logged_in_user->contract_file)}}" target="_blank" title="{{ __('strings.backend.download_contract_file') }}">
                        {{ basename($logged_in_user->contract_file) }}
                    </a>
                    <?php if (!$logged_in_user->contract_confirmed) { ?>
                        <span class="help-block"> [ {{__('strings.backend.being_reviewed_by_admin')}} ]</span>                        
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>               
    </table>    
</div>