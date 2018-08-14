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
    <title><?php !empty($page->title) ? $page->title :  app_name(); ?></title>
    <meta name="description" content="@yield('meta_description', 'Omenkul - Super Admin')">
    <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
    @yield('meta')

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    @stack('before-styles')
    
    {!! style('css/normalize.css') !!}
    {!! style('css/bootstrap.min.css') !!}
    {!! style('css/font-awesome.min.css') !!}
    {!! style('css/themify-icons.css') !!}
    {!! style('css/flag-icon.min.css') !!}
    {!! style('css/cs-skin-elastic.css') !!}
    {!! style('scss/style.css') !!}
    {!! style('css/lib/vector-map/jqvmap.min.css') !!}

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    @stack('after-styles')
</head>
<body class="bg-dark">
    @include('includes.partials.logged-in-as')
    @include('frontend.includes.nav')    
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="/">
                        <img class="align-content" style="width:232px; height:auto;" alt="" src="{{URL::asset('images/logo.png')}}">
                    </a>
                </div>
                
                @include('includes.partials.messages')
                @yield('content')
            </div>
        </div>
    </div>

    @stack('before-scripts')

    {!! script('js/vendor/jquery-2.1.4.min.js') !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    {!! script('js/plugins.js') !!}
    {!! script('js/main.js') !!}

    @stack('after-scripts')


</body>
</html>
