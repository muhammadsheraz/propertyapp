@extends ('backend.layouts.app')

@section('content')
<form action="{{ url('/admin/settings'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
    {{ csrf_field() }}

    @if (isset($model))
        <input type="hidden" name="_method" value="PATCH">
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Application Settings
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />   

            <div class="form-group row">
            <div class="col col-md-3"><label for="application_title" class="form-control-label">Application Title</label></div>
             <div class="col-12 col-md-6">
                    <input type="text" name="application_title" id="application_title" class="form-control" value="{{$model['application_title'] or ''}}">
                </div>
            </div>            
            <div class="form-group row">
                <div class="col col-md-3"><label for="currency_sign" class="form-control-label">Currency Symbol</label></div>
                <div class="col-12 col-md-2">
                    <?php echo Form::select('currency_sign', get_currency_symbols(), $model['currency_sign'], ['id' => 'currency_sign','class' => 'form-control']); ?>
                </div>
            </div>            
            <div class="form-group row">
            <div class="col col-md-3"><label for="invalid_login_threshold" class="form-control-label">Invalid Login Threshold</label></div>
             <div class="col-12 col-md-2">
                    <input type="number" name="invalid_login_threshold" id="invalid_login_threshold" class="form-control" value="{{$model['invalid_login_threshold'] or ''}}">
                </div>
            </div>            

            <div class="form-group row">
                <div class="col col-md-3"><label for="broker_contract_file" class="form-control-label">Broker Contract File</label></div>
                <div class="col col-md-3">
                    <input type="file" name="broker_contract_file" id="broker_contract_file" class="form-control" value="{{$model['broker_contract_file'] or ''}}">
                </div>
                <?php if (!empty($model['broker_contract_file'])) { ?>
                    <div class="col col-md-4 image-container">
                        Download Broker Contract File:  <a href="{{Storage::url($model['broker_contract_file'])}}" title="{{ __('strings.download_this_file') }}"><?php echo basename($model['broker_contract_file'])?></a>
                        <span>
                            <a href="#" 
                                title="Remove Contract" 
                                class="remove-contract" 
                                data-url="{{ url('/admin/settings/remove_contract/') }}" 
                                <i class="fa fa-times"></i>
                            </a>
                        </span>
                    </div>
                <?php } ?>
            </div>                                                       
                    

                    <input type="hidden" name="id" id="id" value="{{$model['id'] or ''}}">

                    <div class="form-group row">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus"></i> Save
                            </button> 
                            <a class="btn btn-default" href="{{ url('/admin/') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                        </div>
                    </div>  



                </div><!--col-->
            </div><!--row--> 
        </div>
    </div>
<form>

@endsection


@push('after-scripts')
    <script type="text/javascript">
        $(function () {
           $('.remove-contract').click(function () {
                var imageContainer = $(this).closest('.image-container');

                $.ajax({
                    url: $(this).attr('data-url'),
                    method: 'POST',
                    dataType: 'json',
                    data: { 
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        imageContainer.fadeOut('slow');
                        alert(data.message);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                    }
                });
           });
        });
    </script>
@endpush