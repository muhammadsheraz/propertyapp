@extends ('backend.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                   {{ __('strings.backend.districts_management') }} <small class="text-muted">{{ __('strings.backend.all_districts') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.districts.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
            <div class="table-responsive">
                <table id="district-data-table" class="table table-striped table-bordered">
                    
                        <thead>
                            <tr>
                                <th>{{ __('strings.frontend.id') }}</th>
                                <th>{{ __('strings.backend.district_name') }}</th>
                                <th>{{ __('strings.backend.city_name') }}</th>
                                <th style="width:50px"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($districts as $district)
                            <tr>
                                <td>{{ $district->id }}</td>
                                <td>{{ $district->name }}</td>
                                <td>{{ $district->city_name }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="districts">
                                        <a href="{{ url('/admin/districts') }}/{{$district->id}}/edit" 
                                        title="{{ __('strings.frontend.edit') }}"
                                        class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        
                                        <a href="{{ url('/admin/districts') }}/{{$district->id}}"
                                            title="{{ __('strings.backend.delete') }}"
                                            data-method="delete"
                                            data-trans-button-cancel="{{__('buttons.general.cancel')}}"
                                            data-trans-button-confirm="{{__('buttons.general.delete')}}"
                                            data-trans-title="{{__('strings.general.delete_confirm')}}"
                                            class="btn btn-danger"><i class="fa fa-trash"></i></a>

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
          $('#district-data-table').DataTable({
              "aaSorting": []
          });
        } );
    </script>

@endpush