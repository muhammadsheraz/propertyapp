@extends ('backend.layouts.app')

@section('content')



<h2 class="page-header"> {{__('strings.frontend.city')}}</h2>

<div class="panel panel-default">
    <div class="panel-heading">{{__('strings.frontend.view_city')}}</div>

    <div class="panel-body">
        <form action="{{ url('/cities') }}" method="POST" class="form-horizontal">
    
        <div class="form-group">
            <label for="id" class="col-sm-3 control-label"> {{__('strings.frontend.id')}}</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="city_name" class="col-sm-3 control-label">{{__('strings.backend.city_name')}}</label>
            <div class="col-sm-6">
                <input type="text" name="city_name" id="city_name" class="form-control" value="{{$model['city_name'] or ''}}" readonly="readonly">
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a class="btn btn-default" href="{{ url('/cities') }}"><i class="glyphicon glyphicon-chevron-left"></i>  {{__('strings.backend.back')}}</a>
            </div>
        </div>
        </form>
    </div>
</div>







@endsection