@extends ('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                   {{ __('strings.frontend.city_management') }} <small class="text-muted">{{ __('strings.frontend.city_management') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.cities.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                <table id="cities-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('strings.frontend.id') }}</th>
                                <th>{{ __('strings.backend.city_name') }}</th>
                                <th>{{ __('strings.backend.district_name') }}</th>
                                <th style="width:50px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities as $city)
                                <tr>
                                    <td>{{ $city->id }}</td>
                                    <td>{{ $city->city_name }}</td>
                                    <td>{{ $city->district_name }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Cities">
                                            <a href="{{ url('/admin/cities') }}/{{$city->id}}/edit" title="{{ __('strings.frontend.edit') }}" class="btn btn-primary">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            
                                            <a href="{{ url('/admin/cities') }}/{{$city->id}}" 
                                                title="{{ __('strings.frontend.delete') }}"
                                                data-method="delete"
                                                data-trans-button-cancel="{{__('buttons.general.cancel')}}"
                                                data-trans-button-confirm="{{__('buttons.general.delete')}}"
                                                data-trans-title="{{__('strings.general.delete_confirm')}}"
                                                class="btn btn-danger delete-city"><i class="fa fa-trash"></i></a>

                                        </div>                                
                                    </td>
                                </tr>
                            @endforeach  
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection

@push('after-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#cities-data-table').DataTable({
                "aaSorting": []
            });
        });
    </script>
@endpush