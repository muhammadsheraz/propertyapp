@extends ('backend.layouts.app')

@section('content')
<form action="{{ url('/admin/pages'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

    @if (isset($model))
        <input type="hidden" name="_method" value="PATCH">
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('strings.backend.pages_management')}}
                        <small class="text-muted">{{ __('strings.backend.add_edit_page')}}</small>
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
                                            <div class="col col-md-3"><label for="status" class="form-control-label">{{ __('strings.frontend.title')}}</label></div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" name="title_{{$lang}}" id="title_{{$lang}}" class="form-control title" value="{{$model["title_$lang"] or ''}}">
                                                <?php if (!empty($model['slug'])) { ?>
                                                    <span class="help-block">{{ __('strings.backend.preview_page')}} <a class="text-info" target="_blank" href="{{ get_page_url($model) }}">{{ get_page_url($model) }}</a></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col col-md-3"><label for="content" class="form-control-label">{{ __('strings.backend.content')}}</label></div>
                                            <div class="col-12 col-md-9">
                                                <textarea name="content_{{$lang}}" id="content_{{$lang}}" class="form-control content text-editor">{{$model["content_$lang"] or ''}}</textarea>
                                            </div>
                                        </div>   
                                        <div class="form-group row">
                                            <div class="col col-md-3"><label for="meta_description_{{$lang}}" class="form-control-label">{{ __('strings.frontend.meta_description')}}</label></div>
                                            <div class="col-12 col-md-9">
                                                <textarea name="meta_description_{{$lang}}" id="meta_description_{{$lang}}" class="form-control meta_description">{{$model["meta_description_$lang"] or ''}}</textarea>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group row">
                                            <div class="col col-md-3"><label for="meta_keywords_{{$lang}}" class="form-control-label">{{ __('strings.frontend.meta_keywords')}}</label></div>
                                            <div class="col-12 col-md-9">
                                                <textarea name="meta_keywords_{{$lang}}" id="meta_keywords_{{$lang}}" class="form-control meta_keywords">{{$model["meta_keywords_$lang"] or ''}}</textarea>
                                            </div>
                                        </div>                                                                             
                            <?php } else { ?>
                                    <div class="form-group row">
                                        <div class="col col-md-3"><label for="status" class="form-control-label">{{ __('strings.frontend.title')}}</label></div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" name="title" id="title" class="form-control title" value="{{$model['title'] or ''}}">
                                            <?php if (!empty($model['slug'])) { ?>
                                                <span class="help-block">{{ __('strings.backend.preview_page')}} <a class="text-info" target="_blank" href="{{ get_page_url($model) }}">{{ get_page_url($model) }}</a></span>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col col-md-3"><label for="content" class="form-control-label">{{ __('strings.backend.content')}}</label></div>
                                        <div class="col-12 col-md-9">
                                            <textarea name="content" id="content" class="form-control text-editor content">{{$model['content'] or ''}}</textarea>
                                        </div>
                                    </div>     
                                    <div class="form-group row">
                                                <div class="col col-md-3"><label for="meta_description" class="form-control-label">{{ __('strings.frontend.meta_description')}}</label></div>
                                                <div class="col-12 col-md-9">
                                            <textarea name="meta_description" id="meta_description" class="form-control meta_description">{{$model['meta_description'] or ''}}</textarea>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group row">
                                                <div class="col col-md-3"><label for="meta_keywords" class="form-control-label">{{ __('strings.frontend.meta_keywords')}}</label></div>
                                                <div class="col-12 col-md-9">
                                            <textarea name="meta_keywords" id="meta_keywords" class="form-control meta_keywords">{{$model['meta_keywords'] or ''}}</textarea>
                                        </div>
                                    </div>                                                                   
                            <?php } ?>
                        </div>
                        <?php endforeach; ?>
                    </div>




            <div class="form-group d-none">
                <label for="id" class="col-sm-3 control-label">{{ __('strings.frontend.id')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">
                </div>
            </div>
            <?php 
                $d_none = '';
                if (!empty($model['is_default'])) {
                    $d_none = 'd-none';
                }
            ?>

            <div class="form-group row {{ $d_none }}">
                <div class="col col-md-3"><label for="slug" class="form-control-label">{{ __('strings.backend.slug')}}</label></div>
                <div class="col-12 col-md-9">
                    <input type="text" name="slug" id="slug" class="form-control" value="{{$model['slug'] or ''}}">
                </div>
            </div>

            <div class="form-group row">
                        <div class="col col-md-3"><label for="page_image" class="form-control-label">{{ __('strings.backend.image')}}</label></div>
                        <div class="col-12 col-md-9">
                    <input type="file" name="page_image" id="page_image" class="form-control" value="{{$model['page_image'] or ''}}">
                </div>
            </div>


            <?php if (!empty($page_images->id)) { ?>
            <div class="form-group row">
                <div class="col col-md-3"></div>
                <div class="col-12 col-md-9">
                    <div class="row">
                            <div class="col-md-4 image-container">
                                <?php $class_featured = !empty($page_images->is_featured) ? 'featured-image' : '' ?>
                                <img name="page_image_{{$page_images->id}}" src="{{$page_images->image_url}}" class="{{ $class_featured }}" alt="" title="">
                                <span>
                                    <a href="#" 
                                        title="Remove Image" 
                                        class="remove-image" 
                                        data-url="{{ url('/admin/pages/remove_image/') }}" 
                                        data-image-id="{{$page_images->id}}">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </span>
                            </div>
                        </div><!--form-group-->
                    </div>
                </div>
                <?php } ?>


            <div class="form-group row">
                        <div class="col col-md-3"><label for="meta_title" class="form-control-label">{{ __('strings.frontend.meta_title')}}</label></div>
                        <div class="col-12 col-md-9">
                    <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{$model['meta_title'] or ''}}">
                </div>
            </div>

            <div class="form-group row">
                        <div class="col col-md-3"><label for="status" class="form-control-label">{{ __('strings.frontend.status')}}</label></div>
                        <div class="col-12 col-md-9">
                    <?php 
                        if (!empty($model['id'])) {
                            if (!empty($model['status'])) {
                                $checked = 'checked'; 
                            } else {
                                $checked = '';
                            }
                        } else {
                            $checked = 'checked';
                        }
                    ?>

                    <label class="switch switch-3d switch-primary">
                        <input type="checkbox" name="status" id="status" class="switch-input" value="1" <?php echo $checked; ?>>
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </label>
                </div>
            </div>


            <!-- ////////////////////////////////// -->
                                                        
                    

                    <input type="hidden" name="id" id="id" value="{{$model['id'] or ''}}">

                    <div class="form-group row">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus"></i> {{ __('strings.backend.save') }}
                            </button> 
                            <a class="btn btn-default" href="{{ url('/admin/pages') }}"><i class="glyphicon glyphicon-chevron-left"></i> {{ __('strings.backend.back')}}</a>
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
            $('.text-editor').summernote({
               
            });

           $('.remove-image').click(function () {
                var imageContainer = $(this).closest('.image-container');

                $.ajax({
                    url: $(this).attr('data-url'),
                    method: 'POST',
                    dataType: 'json',
                    data: { 
                        image_id: $(this).attr('data-image-id'), 
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        imageContainer.fadeOut('slow');
                        alert(data.message);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error(errorThrown);
                    }
                });
           });

            $('#en-tab').addClass('active').tab('show');    

            $('#myTab a').on('click',function (e) {
                e.preventDefault();
                var prevTab = $(this).closest('#myTab').find('a.active');
                var newTab = $(this);

                var prevLang = prevTab.attr('data-lang');
                var newLang = newTab.attr('data-lang');
                var trString = '';

                // Setting Title
                // if ($('#lang-' + prevLang).find('input.title').val() !== '') {
                //     $('#myTabContent').find('[id^="lang-"]').not('#lang-' + prevLang).each(function () {
                //         if ($(this).find('input.title').val() === '') {
                //             // Getting Translated Text
                //             trString = $('#lang-' + prevLang).find('input.title').val();

                //             $(this).find('input.title').val(trString);
                //         }
                //     })
                // }

                // Setting Content
                // if (! $('#lang-' + prevLang).find('.content').summernote('isEmpty')) {
                //     $('#myTabContent').find('[id^="lang-"]').not('#lang-' + prevLang).each(function () {
                //         if ($(this).find('.content').summernote('isEmpty')) {
                //             // Getting Translated Text
                //             trString = $('#lang-' + prevLang).find('.content').summernote('code');

                //             $(this).find('.content').summernote('code', trString);
                //         } 
                //     })
                // }

                // Setting Meta Description
                // if ($('#lang-' + prevLang).find('.meta_description').val() !== '') {
                //     $('#myTabContent').find('[id^="lang-"]').not('#lang-' + prevLang).each(function () {
                //         if ($(this).find('.meta_description').val() === '') {
                //             // Getting Translated Text
                //             trString = $('#lang-' + prevLang).find('.meta_description').val();

                //             $(this).find('.meta_description').val(trString);
                //         } 
                //     })
                // }

                // Setting Meta Keywords
                // if ($('#lang-' + prevLang).find('.meta_keywords').val() !== '') {
                //     $('#myTabContent').find('[id^="lang-"]').not('#lang-' + prevLang).each(function () {
                //         if ($(this).find('.meta_keywords').val() === '') {
                //             // Getting Translated Text
                //             trString = $('#lang-' + prevLang).find('.meta_keywords').val();

                //             $(this).find('.meta_keywords').val(trString);
                //         } 
                //     })
                // }
            });  

            // $('#myTab').hide();
        });        

    </script>
@endpush