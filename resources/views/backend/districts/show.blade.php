@extends ('backend.layouts.app')

@section('content')



<h2 class="page-header">District</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        View District    </div>

    <div class="panel-body">
                

        <form action="{{ url('/districts') }}" method="POST" class="form-horizontal">

        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">{{ __('strings.frontend.id') }}</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">{{ __('strings.backend.name') }}</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="name" class="form-control" value="{{$model['name'] or ''}}" readonly="readonly">
            </div>
        </div>
        
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a class="btn btn-default" href="{{ url('/districts') }}"><i class="glyphicon glyphicon-chevron-left"></i> {{ __('strings.backend.back') }}</a>
            </div>
        </div>


        </form>

    </div>
</div>







@endsection