@extends ('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('strings.backend.property_types_manager')}} <small class="text-muted">{{ __('strings.backend.all_property_types')}}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.property_types.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->
        
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="propery-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('strings.frontend.id')}}</th>
                                <th>{{ __('strings.backend.property_types')}}</th>
                                <th>{{ __('strings.frontend.status')}}</th>
                                <th>{{ __('strings.backend.created_at')}}</th>
                                <th style="width:50px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($property_types as $property_type)
                                <tr>
                                    <td>{{ $property_type->id }}</td>
                                    <td>{{ $property_type->name }}</td>
                                    <td>{{ ucfirst($property_type->status) }}</td>
                                    <td>{{ strftime('%d %b, %Y %H:%M', strtotime($property_type->created_at)) }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Property Types Actions">
                                            <a href="{{ url('/admin/property_types') }}/{{$property_type->id}}/edit" class="btn btn-primary">
                                                <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.edit').'"></i>
                                            </a>
                                            
                                            <a href="{{ url('/admin/property_types') }}/{{$property_type->id}}" 
                                            onclick="return doDelete()" 
                                            data-method="delete"
                                            data-trans-button-cancel="{{__('buttons.general.cancel')}}"
                                            data-trans-button-confirm="{{__('buttons.general.delete')}}"
                                            data-trans-title="{{__('strings.general.delete_confirm')}}"                                            
                                            class="btn btn-danger">{{ __('strings.backend.delete')}}</a>

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
          $('#propery-data-table').DataTable();
        } );
    </script>
@endpush

