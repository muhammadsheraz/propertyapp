@extends ('backend.layouts.app')

@section('content')

<form action="{{ url('/admin/property_types'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

    @if (isset($model))
        <input type="hidden" name="_method" value="PATCH">
    @endif

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('strings.backend.property_types_manager')}}
                        <small class="text-muted">{{ __('strings.backend.add_edit_property_types')}}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />   
            <div class="row mt-4">
                <div class="col">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <?php foreach (array_keys(config('locale.languages_omenkul')) as $lang): ?>
                            <li class="nav-item">
                                <a class="nav-link" 
                                id="{{$lang}}-tab" 
                                data-toggle="tab" 
                                data-lang="{{$lang}}" 
                                href="#lang-{{$lang}}" 
                                role="tab" 
                                aria-controls="{{$lang}}" 
                                aria-selected="true">

                                    <?php echo array_get(config('locale.languages_names'), $lang); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content pl-3 p-1" id="myTabContent">
                        <?php foreach (array_keys(config('locale.languages_omenkul')) as $lang): ?>
                            <div class="tab-pane fade show" id="lang-{{$lang}}" role="tabpanel" aria-labelledby="{{$lang}}-tab">
                                <?php if ($lang != 'en') { ?>
                                    <div class="form-group row">
                                        <div class="col col-md-3"><label for="name_{{$lang}}" class="form-control-label">{{ __('strings.backend.property_type')}} - <?php echo array_get(config('locale.languages_names'), $lang); ?></label></div>

                                        <div class="col-12 col-md-9">
                                            <input type="text" name="name_{{$lang}}" id="name_{{$lang}}" class="form-control name" value="{{ $model["name_$lang"] or ''}}">
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group row">
                                        <div class="col col-md-3"><label for="name" class="form-control-label">{{ __('strings.backend.property_type')}}</label></div>

                                        <div class="col-12 col-md-9">
                                            <input type="text" name="name" id="name" class="form-control name" value="{{$model['name'] or ''}}">
                                        </div>
                                    </div>
                                <?php } ?> 
                            </div>
                        <?php endforeach; ?>
                    </div>   

                    <div class="form-group d-none">
                        <label for="id" class="col-sm-3 control-label">Id</label>
                        <div class="col-sm-6">
                            <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">
                        </div>
                    </div>

                    <input type="hidden" name="id" id="id" value="{{$model['id'] or ''}}">

                    <div class="form-group row">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus"></i> Save
                            </button> 
                            <a class="btn btn-default" href="{{ url('/admin/property_types') }}"><i class="glyphicon glyphicon-chevron-left"></i> {{ __('strings.backend.back')}}</a>
                        </div>
                    </div>
                </div><!--col-->
            </div><!--row--> 
        </div>
    </div>
<form>
@endsection

@push('after-scripts')
<script>
    $(function () {
        $('#en-tab').addClass('active').tab('show');        

        $('#myTab a').on('click',function (e) {
            e.preventDefault();
            var prevTab = $(this).closest('#myTab').find('a.active');
            var newTab = $(this);

            var prevLang = prevTab.attr('data-lang');
            var newLang = newTab.attr('data-lang');
            var trString = '';

            // Setting Name
            if ($('#lang-' + prevLang).find('input.name').val() !== '') {
                $('#myTabContent').find('[id^="lang-"]').not('#lang-' + prevLang).each(function () {
                    if ($(this).find('input.name').val() === '') {
                        // Getting Translated Text
                        trString = $('#lang-' + prevLang).find('input.name').val();

                        $(this).find('input.name').val(trString);
                    }
                })
            }
        });

        $('#myTab').hide();
    })
</script>
@endpush