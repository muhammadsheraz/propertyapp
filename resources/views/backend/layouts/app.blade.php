<!DOCTYPE html>
@langrtl
    <html lang="{{ app()->getLocale() }}" dir="rtl">
@else
    <html lang="{{ app()->getLocale() }}">
@endlangrtl
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', 'Omenkul - Super Admin')">
    <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
    @yield('meta')

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')
    
    {!! style('css/normalize.css') !!}
    {!! style('css/bootstrap.min.css') !!}
    {!! style('css/font-awesome.min.css') !!}
    {!! style('css/themify-icons.css') !!}
    {!! style('css/flag-icon.min.css') !!}
    {!! style('css/cs-skin-elastic.css') !!}
    {!! style('scss/style.css') !!}
    {!! style('css/lib/vector-map/jqvmap.min.css') !!}
    {!! style('css/lightgallery.css') !!}
    
    {!! style('js/lib/fileupload/css/jquery.fileupload.css') !!}
    {!! style('js/lib/fileupload/css/jquery.fileupload-ui.css') !!}
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css">
    
    {!! style('css/lib/datatable/dataTables.bootstrap.min.css') !!}

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->

    {!! style('js/lib/smartwizard/dist/css/smart_wizard.css') !!}
    {!! style('js/lib/smartwizard/dist/css/smart_wizard_theme_dots.css') !!}

    {!! style('js/lib/alertifyjs/css/alertify.min.css') !!}
    {!! style('js/lib/alertifyjs/css/themes/semantic.min.css') !!}
    
    @stack('after-styles')
</head>

<body class="{{ config('backend.body_classes') }}">

    <!-- Left Panel -->
        @include('backend.includes.sidebar')
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        @include('backend.includes.header')
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('strings.backend.dashboard.title')}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">{{ __('strings.backend.dashboard.title')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.partials.messages')
        @yield('content')
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <!-- Scripts -->
    @stack('before-scripts')
    {!! script('js/vendor/jquery-2.1.4.min.js') !!}

    {!! script('js/main.js') !!}
    {!! script(mix('js/backend.js')) !!}

    {!! script('js/lib/data-table/datatables.min.js') !!}
    {!! script('js/lib/data-table/dataTables.bootstrap.min.js') !!}
    {!! script('js/lib/data-table/dataTables.buttons.min.js') !!}
    {!! script('js/lib/data-table/buttons.bootstrap.min.js') !!}
    {!! script('js/lib/data-table/jszip.min.js') !!}
    {!! script('js/lib/data-table/pdfmake.min.js') !!}
    {!! script('js/lib/data-table/vfs_fonts.js') !!}
    {!! script('js/lib/data-table/buttons.html5.min.js') !!}
    {!! script('js/lib/data-table/buttons.print.min.js') !!}
    {!! script('js/lib/data-table/buttons.colVis.min.js') !!}
    {!! script('js/lib/data-table/datatables-init.js') !!}
    {!! script('/front/js/lightgallery-all.min.js') !!}
    {!! script('js/jquery.colorbox-min.js') !!}
    
    <!-- The File Upload processing -->
    {!! script('js/lib/fileupload/js/vendor/jquery.ui.widget.js') !!}
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    
    
    {!! script('js/lib/fileupload/js/jquery.iframe-transport.js') !!}
    {!! script('js/lib/fileupload/js/jquery.fileupload.js') !!}
    {!! script('js/lib/fileupload/js/jquery.fileupload-process.js') !!}
    {!! script('js/lib/fileupload/js/jquery.fileupload-image.js') !!}
    {!! script('js/lib/fileupload/js/jquery.fileupload-audio.js') !!}
    {!! script('js/lib/fileupload/js/jquery.fileupload-video.js') !!}
    {!! script('js/lib/fileupload/js/jquery.fileupload-validate.js') !!}
    {!! script('js/lib/fileupload/js/jquery.fileupload-ui.js') !!}
    <!-- The File Upload processing plugin -->
    
    {!! script('js/lib/smartwizard/dist/js/jquery.smartWizard.min.js') !!}
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>    
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    
    {!! script('js/lib/jquery-validate/jquery.validate.min.js') !!}

    <?php 
        switch (app()->getLocale()) {
            case 'tr':
                echo script('js/lib/jquery-validate/localization/messages_tr.min.js');
                break;
            case 'ar':
                echo script('js/lib/jquery-validate/localization/messages_ar.min.js');
                break;
            case 'ru':
                echo script('js/lib/jquery-validate/localization/messages_ru.min.js');
                break;
            case 'de':
                echo script('js/lib/jquery-validate/localization/messages_de.min.js');
                break;
            default:
                # code...
                break;
        }
    ?>

    {!! script('js/jquery.blockUI.js') !!}
    <!-- Alertify JS -->
    {!! script('js/lib/alertifyjs/alertify.min.js') !!}
    <!-- Alertify JS -->
    {!! script('js/popper.min.js') !!}    
    
    {!! script('js/lib/moment/moment-with-locales.min.js') !!}
    
    <script type="text/javascript">
        // Datatables Defaults
        $.extend( true, $.fn.dataTable.defaults, {
            "language": {
                "url": "<?php echo url('js/lib/data-table/i18n/' . get_datatable_lang(app()->getLocale())); ?>"
            } 
        } );
    </script>

    @stack('after-scripts')
    <script type="text/javascript">
        $('.select2').select2();

        $(function () {
            $('.notification-dropdown-item').on('click', function (e) {
                e.preventDefault();
                ajaxUrl = '<?php echo url('/admin/ajax/set_session_value'); ?>';

                $.ajax({
                    type: 'POST',
                    data: {
                        _session_key: "notification_id",
                        _session_value: $(this).attr('data-notification-id'),
                        _token: "{{ csrf_token() }}"
                    },
                    beforeSend: function (jqXHR, settings) {
                        $.blockUI({ css: { 
                            border: 'none', 
                            padding: '15px', 
                            backgroundColor: '#000', 
                            '-webkit-border-radius': '10px', 
                            '-moz-border-radius': '10px', 
                            opacity: .5, 
                            color: '#fff' 
                        } }); 
                    },  
                    complete: function (jqXHR, textStatus) {
                        $.unblockUI();
                    },                                         
                    context: $(this),
                    url: ajaxUrl,
                    dataType: 'json',                   
                    success: function (data, textStatus, jqXHR) {
                        location.href = $(this).attr('href');
                    }
                })
            });

            $('.messageLink').on('click', function (e) {
                e.preventDefault();
                ajaxUrl = '<?php echo url('/admin/ajax/set_session_value'); ?>';

                $.ajax({
                    type: 'POST',
                    data: {
                        _session_key: "_customer_id",
                        _session_value: $(this).attr('data-customer-id'),
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    beforeSend: function (jqXHR, settings) {
                        $.blockUI({ css: { 
                            border: 'none', 
                            padding: '15px', 
                            backgroundColor: '#000', 
                            '-webkit-border-radius': '10px', 
                            '-moz-border-radius': '10px', 
                            opacity: .5, 
                            color: '#fff' 
                        } }); 
                    },  
                    complete: function (jqXHR, textStatus) {
                        //$.unblockUI();
                    },                                         
                    context: $(this),
                    url: ajaxUrl,
                    dataType: 'json',                   
                    success: function (data, textStatus, jqXHR) {
                        location.href = $(this).attr('href');
                    }
                })
            });             
        });
    </script>    
</body>
</html>
