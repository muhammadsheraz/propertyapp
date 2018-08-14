<nav class="navbar for_high navbar-expand-lg navbar-light"> <a class="navbar-brand" href="@yield('home_url', url('/'))"><img src="{{ url('/') }}/front/images/logo.png"></a>
    <?php if (empty($hide_nav)) { ?>
    <div class="collapse navbar-collapse nav-mainmenu">
        <ul class="navbar-nav">
            <li class="nav-item <?php echo $current_uri == '/' ? 'active': ''; ?>"> <a class="nav-link" href="{{ url('/') }}">{!! __('strings.frontend.home') !!}</a> </li>
            <li class="nav-item <?php echo (!empty($request_input['property_purpose']) AND $request_input['property_purpose'] == 'buy') ? 'active': ''; ?>"> <a class="nav-link" href="{{ url('/properties/list?property_purpose=buy') }}">{!! __('strings.frontend.sale') !!}</a> </li>
            <li class="nav-item <?php echo (!empty($request_input['property_purpose']) AND $request_input['property_purpose'] == 'rent') ? 'active': ''; ?>"> <a class="nav-link" href="{{ url('/properties/list?property_purpose=rent') }}">{!! __('strings.frontend.rent') !!}</a> </li>
            <li class="nav-item <?php echo $current_uri == 'information/faqs' ? 'active': ''; ?>"> <a class="nav-link" href="{{ url('/information/faqs') }}">{{ __('strings.frontend.faqs')}}</a> </li>
            
            <li class="nav-item <?php echo $current_uri == 'contact' ? 'active': ''; ?>"> <a class="nav-link" href="{{ url('/contact') }}">{!! __('strings.frontend.contact_us') !!}</a> </li>        
        </ul>
        <ul class="pl-0 m-0 broker-login pl-3">
            <?php if (empty($logged_in_user)) { ?>
                <li class="nav-item"> <a class="nav-link red-bg" href="{{ url('/broker-login') }}">{{ __('strings.frontend.broker_login')}}</a> </li>
            <?php } else { ?>
                <li class="nav-item"> <a class="nav-link red-bg" title="Logged in as <?php echo auth()->user()->full_name; ?>, Click to logout" href="{{ url('/logout') }}">{!! __('strings.frontend.log_out') !!}</a> </li>
            <?php } ?>

        </ul>
    </div>
    <?php } ?>
</nav>

<nav class="navbar for_low navbar-dark"> <a class="navbar-brand" href="@yield('home_url', url('/'))"><img src="{{ url('/') }}/front/images/logo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <?php if (empty($hide_nav)) { ?>
        <ul class="navbar-nav">
            <li class="nav-item <?php echo $current_uri == '/' ? 'active': ''; ?>"> <a class="nav-link" href="{{ url('/') }}">{!! __('strings.frontend.home') !!}</a> </li>
            <li class="nav-item <?php echo (!empty($request_input['property_purpose']) AND $request_input['property_purpose'] == 'buy') ? 'active': ''; ?>"> <a class="nav-link" href="{{ url('/properties/list?property_purpose=buy') }}">{!! __('strings.frontend.sale') !!}</a> </li>
            <li class="nav-item <?php echo (!empty($request_input['property_purpose']) AND $request_input['property_purpose'] == 'rent') ? 'active': ''; ?>"> <a class="nav-link" href="{{ url('/properties/list?property_purpose=rent') }}">{!! __('strings.frontend.rent') !!}</a> </li>
            <li class="nav-item <?php echo $current_uri == 'information/faqs' ? 'active': ''; ?>"> <a class="nav-link" href="{{ url('/information/faqs') }}">{{ __('strings.frontend.faqs')}}</a> </li>
            
            <li class="nav-item <?php echo $current_uri == 'contact' ? 'active': ''; ?>"> <a class="nav-link" href="{{ url('/contact') }}">{!! __('strings.frontend.contact_us') !!}</a> </li>        
        </ul>
        <ul class="pl-0 m-0 broker-login pl-3">
            <?php if (empty($logged_in_user)) { ?>
                <li class="nav-item"> <a class="nav-link red-bg" href="{{ url('/broker-login') }}">{{ __('strings.frontend.broker_login')}}</a> </li>
            <?php } else { ?>
                <li class="nav-item"> <a class="nav-link red-bg" title="Logged in as <?php echo auth()->user()->full_name; ?>, Click to logout" href="{{ url('/logout') }}">{!! __('strings.frontend.log_out') !!}</a> </li>
            <?php } ?>

        </ul>
    <?php } ?>

    <ul class="s-lang d-lg-none m-0 p-0">
          <?php foreach (array_keys(config('locale.languages_omenkul')) as $lang): ?>
          <?php 
            $active = '';
            if (app()->getLocale() == $lang) {
              $active = 'active';
            }          
          ?>
          <li class="<?php echo $active; ?>">
            <a href="{{ '/lang/'.$lang }}"><img src="{{ url('/') }}/front/images/{{$lang}}-flag.png"></a>
            <br>
            <?php echo array_get(config('locale.languages_names'), $lang); ?>
          </li>
          <?php endforeach; ?>
        </ul>
    </div>
</nav>
