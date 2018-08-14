@extends ('backend.layouts.app')

@section('content')


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                   {{ __('strings.backend.pages_management')}} <small class="text-muted">{{ __('strings.backend.all_pages')}}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.pages.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
            <div class="table-responsive">
                <table id="pages-data-table" class="table table-striped table-bordered">
              <thead>
                <tr>
                    <th>{{ __('strings.frontend.id')}}</th>
                    <th>{{ __('strings.frontend.title')}}</th>
                    <th>{{ __('strings.backend.slug')}}</th>
                    <th>{{ __('strings.frontend.status')}}</th>
                    <th>{{ __('strings.backend.created_at')}}</th>
                    <th style="width:50px"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <td>{{ $page->id }}</td>
                        <td>{{ $page->title }}</td>
                        <td>{{ $page->slug }}</td>
                        <td>{!! !empty($page->status) ? 'Active' : 'Inactive' !!}</td>
                        <td>{!! strftime('%d %b, %Y %H:%M', strtotime($page->created_at)) !!}</td>

                        <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Pages Actions">
                                <a href="{{ url('/admin/pages') }}/{{$page->id}}/edit" 
                                title="{{ __('strings.frontend.edit') }}"
                                class="btn btn-primary">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <?php if (empty($page->is_default)) { ?>
                                    <a href="{{ url('/admin/pages') }}/{{$page->id}}" 
                                    title="{{ __('strings.backend.delete') }}"
                                    onclick="return doDelete()" 
                                    data-method="delete"
                                    data-trans-button-cancel="{{__('buttons.general.cancel')}}"
                                    data-trans-button-confirm="{{__('buttons.general.delete')}}"
                                    data-trans-title="{{__('strings.general.delete_confirm')}}"                                       
                                    class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <?php } ?>
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
        var theGrid = null;
        $(document).ready(function(){
            $('#pages-data-table').DataTable();
            
            function doDelete(id) {
                if(confirm('You really want to delete this record?')) {
                    $.ajax({ url: '{{ url('/admin/pages') }}/' + id, type: 'DELETE'}).success(function() {
                        theGrid.ajax.reload();
                    });
                }
                return false;
            }
        });
    </script>
@endpush