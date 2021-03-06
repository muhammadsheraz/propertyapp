<!DOCTYPE html>
@langrtl
    <html lang="{{ app()->getLocale() }}" dir="rtl" prefix="og: http://ogp.me/ns#">
@else
    <html lang="{{ app()->getLocale() }}" dir="ltr" prefix="og: http://ogp.me/ns#">
@endlangrtl
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', 'Omenkul')">
    <meta name="keywords" content="@yield('meta_keywords', 'Omenkul')">

    <meta property="og:url" content="@yield('share_url', url('/'))" />
    <meta property="og:title" content="@yield('share_title', 'Omenkul')" />
    <meta property="og:description" content="@yield('share_description', 'The best way to find your home With industry-leading tools and the savviest pros in the business, our mission is to ethically and honestly serve our clients so that they can achieve the dream of home')" />
    <meta property="og:type" content="place" />
    <meta property="og:image" content="@yield('share_image', '')" />
    <meta property="og:image:alt" content="@yield('share_title', 'Property at Omenkul.com')" />
    <meta property="og:image:width" content="516" />
    <meta property="og:image:height" content="344" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="@yield('share_description', 'The best way to find your home With industry-leading tools and the savviest pros in the business, our mission is to ethically and honestly serve our clients so that they can achieve the dream of home')" />
    <meta name="twitter:title" content="@yield('share_title', 'Omenkul')" />
    <meta name="twitter:image" content="@yield('share_image', '')" />

    @yield('meta')

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    @stack('before-styles')
    
    {!! style('/front/css/bootstrap.min.css') !!}
    {!! style('/front/css/font-awesome.min.css') !!}
    {!! style('/front/css/lightgallery.css') !!}
    {!! style('/front/css/style.css') !!}
    
    {!! style('/front/css/slick.css') !!}
    {!! style('/front/css/slick-theme.css') !!}

    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    @stack('after-styles')
    <title>Omenkul</title>

</head>
<body>


@yield('content')


<!-- Optional JavaScript --> 
<!-- jQuery first, then Popper.js, then Bootstrap JS --> 
@stack('before-scripts')

{!! script('/front/js/jquery-3.3.1.min.js') !!}

{!! script('/front/js/popper.min.js') !!}
{!! script('/front/js/bootstrap.min.js') !!}

{!! script('/front/js/picturefill.min.js') !!}
{!! script('/front/js/lightgallery-all.min.js') !!}

{!! script('/front/js/jquery.pano.js') !!}

{!! script('/front/js/js.js') !!}
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
				
<style>
.alert button {
  float: inherit !important;
  background: none !important;
}
</style>
@stack('after-scripts')
</body>
</html>