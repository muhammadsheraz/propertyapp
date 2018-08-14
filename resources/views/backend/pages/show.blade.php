@extends ('backend.layouts.app')

@section('content')



<h2 class="page-header">{{ __('strings.backend.page')}}</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        {{ __('strings.backend.view_page')}}    </div>

    <div class="panel-body">
                

        <form action="{{ url('/admin/pages') }}" method="POST" class="form-horizontal">


                
        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">{{ __('strings.frontend.id')}}</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">{{ __('strings.frontend.title')}}</label>
            <div class="col-sm-6">
                <input type="text" name="title" id="title" class="form-control" value="{{$model['title'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="content" class="col-sm-3 control-label">{{ __('strings.backend.content{{ __('strings.backend.property_types_manager')}}')}}</label>
            <div class="col-sm-6">
                <input type="text" name="content" id="content" class="form-control" value="{{$model['content'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="slug" class="col-sm-3 control-label">{{ __('strings.backend.slug')}}</label>
            <div class="col-sm-6">
                <input type="text" name="slug" id="slug" class="form-control" value="{{$model['slug'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="image" class="col-sm-3 control-label">{{ __('strings.backend.image')}}</label>
            <div class="col-sm-6">
                <input type="text" name="image" id="image" class="form-control" value="{{$model['image'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="meta_title" class="col-sm-3 control-label">{{ __('strings.frontend.meta_title')}}</label>
            <div class="col-sm-6">
                <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{$model['meta_title'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="meta_description" class="col-sm-3 control-label">{{ __('strings.frontend.meta_description')}}</label>
            <div class="col-sm-6">
                <input type="text" name="meta_description" id="meta_description" class="form-control" value="{{$model['meta_description'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="meta_keyword" class="col-sm-3 control-label">{{ __('strings.frontend.meta_keyword')}}</label>
            <div class="col-sm-6">
                <input type="text" name="meta_keyword" id="meta_keyword" class="form-control" value="{{$model['meta_keyword'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="status" class="col-sm-3 control-label">{{ __('strings.frontend.status')}}</label>
            <div class="col-sm-6">
                <input type="text" name="status" id="status" class="form-control" value="{{$model['status'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="created_by" class="col-sm-3 control-label">{{ __('strings.backend.created_by')}}</label>
            <div class="col-sm-6">
                <input type="text" name="created_by" id="created_by" class="form-control" value="{{$model['created_by'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="created_at" class="col-sm-3 control-label">{{ __('strings.backend.created_at')}}</label>
            <div class="col-sm-6">
                <input type="text" name="created_at" id="created_at" class="form-control" value="{{$model['created_at'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="modified_at" class="col-sm-3 control-label">Modified At</label>
            <div class="col-sm-6">
                <input type="text" name="modified_at" id="modified_at" class="form-control" value="{{$model['modified_at'] or ''}}" readonly="readonly">
            </div>
        </div>
        
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a class="btn btn-default" href="{{ url('/admin/pages') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            </div>
        </div>


        </form>

    </div>
</div>







@endsection