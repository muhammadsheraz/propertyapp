<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.access.users.tabs.content.overview.avatar') }}</th>
                <td><img src="{{ $user->picture }}" class="user-profile-image" /></td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.access.users.tabs.content.overview.name') }}</th>
                <td>{{ $user->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.access.users.tabs.content.overview.email') }}</th>
                <td>{{ $user->email }}</td>
            </tr>
            <?php if ($user->contract_file != '') { ?>        
                <tr>
                    <th>{{ __('validation.attributes.frontend.contract_confirmed') }}</th>
                    <td>
                        <a href="{{url("/admin/auth/broker/$user->id/download_contract_file")}}" target="_blank" title="{{ __('strings.download_this_file')}}">
                            {{ basename($user->contract_file) }}
                        </a>
                        <?php if (!$user->contract_confirmed) { ?>
                            <span class="help-block"> [ {{ __('strings.under_review_by_admin')}} ]</span>                        
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>            

            <tr>
                <th>{{ __('labels.backend.access.users.tabs.content.overview.status') }}</th>
                <td>{!! $user->status_label !!}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->