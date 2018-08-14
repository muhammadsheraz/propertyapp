@extends ('backend.layouts.app')

@section('content')
<form action="{{ url('/admin/districts'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

    @if (isset($model))
        <input type="hidden" name="_method" value="PATCH">
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('strings.backend.districts_management') }}
                        <small class="text-muted">{{ __('strings.backend.add_edit_district') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />   
            <div class="row mt-4">
                <div class="col">
                    
                    <div class="form-group d-none">
                        <label for="id" class="col-sm-3 control-label">{{ __('strings.frontend.id') }}</label>
                        <div class="col-sm-6">
                            <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col col-md-3"><label for="status" class="form-control-label">{{ __('strings.backend.name') }}</label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" name="name" id="name" class="form-control" value="{{$model['name'] or ''}}">
                        </div>
                    </div>
                                                        
                    <div class="form-group row">
                        <div class="col col-md-3"><label for="city_id" class="control-label">{{ __('strings.frontend.city') }}</label></div>
                        <div class="col-9">
                            <select name="city_id" id="city_id" class="form-control">
                                @foreach ($cities as $city)
                                <?php 
                                    if (!empty($model['city_id']) AND $model['city_id'] == $city->id) { 
                                        $selected = 'selected';
                                    } else { 
                                        $selected = '';
                                    }
                                ?>

                                <option value="{{$city->id}}" {{ $selected }}>{{$city->city_name}}</option>
                                
                                @endforeach                      
                            </select>
                        </div>
                    </div>                    

                    <input type="hidden" name="id" id="id" value="{{$model['id'] or ''}}">

                    <div class="form-group row">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus"></i> {{__('strings.backend.save')}}
                            </button> 
                            <a class="btn btn-default" href="{{ url('/admin/districts') }}"><i class="glyphicon glyphicon-chevron-left"></i> {{__('strings.backend.back')}}</a>
                        </div>
                    </div>  



                </div><!--col-->
            </div><!--row--> 
        </div>
    </div>
<form>

@endsection