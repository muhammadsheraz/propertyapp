@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.access.brokers.management'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.brokers.management') }} <small class="text-muted">{{ __('labels.backend.access.brokers.active') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.auth.broker.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                <table id="broker-data-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>{{ __('labels.backend.access.brokers.table.broker_no') }}</th>
                            <th>{{ __('labels.backend.access.brokers.table.name') }}</th>
                            <th>{{ __('labels.location.city') }}, {{ __('labels.location.district') }}</th>
                            <th>{{ __('strings.frontend.phone') }}</th>
                            <th>{{ __('strings.frontend.mobile') }}</th>
                            <th class="text-center">{{ __('labels.backend.access.brokers.table.properties') }}</th>
                            <th class="text-center">{{ __('labels.general.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{!! $user->broker_no !!}</td>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $user->city_name }}, {{ $user->district_name }}</td>
                                <td>{!! $user->phone_no !!}</td>
                                <td>{!! $user->mobile_no !!}</td>
                                <td class="text-center">{{ $user->properties_count }}</td>
                                <td class="text-center">{!! $user->action_buttons_broker !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
<?php
    $brokersNewGrant = [];
    if (!empty($brokers->count())) { 
        foreach ($brokers as $broker):  
            $brokersNewGrant[$broker->id] = $broker->broker_no . ' : ' . $broker->full_name;
        endforeach; 
    } 
?>
@endsection

@push('after-scripts')
<script type="text/javascript">
    var brokersNewGrantJSON = '{!! json_encode($brokersNewGrant) !!}';
</script>
@endpush

@push('after-scripts')
<script type="text/javascript">
    $(function() {
        $('#broker-data-table').DataTable();
    });
</script>
@endpush
