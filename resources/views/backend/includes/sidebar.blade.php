<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{url('/admin')}}"><img src="{{asset('/images/logo2.png')}}" alt="Logo"></a>
            <a class="navbar-brand hidden" href="{{url('/admin')}}"><img src="{{asset('/images/logo.png')}}" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ (\Request::route()->getName() == 'admin.dashboard') ? 'active' : '' }}">
                    <a href="{{url('/admin')}}"> <i class="menu-icon fa fa-dashboard"></i> {{ __('strings.backend.dashboard.title') }} </a>
                </li>
                <?php if(auth()->user()->hasRole('administrator')){ ?>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>{{ __('strings.backend.manage_broker')}}</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-puzzle-piece"></i><a href="{{ route('admin.auth.broker.index') }}">{{ __('strings.backend.brokers')}}</a></li>
                        <li><i class="fa fa-id-badge"></i><a href="{{ route('admin.auth.broker.create') }}">{{ __('strings.backend.add_new')}}</a></li>
                    </ul>
                </li>
                <?php } ?>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{ __('strings.backend.manage_property') }}</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-table"></i><a href="{{ route('admin.properties.index') }}">{{ __('strings.backend.properties') }}</a></li>
                        <li><i class="fa fa-table"></i><a href="{{ route('admin.properties.create') }}">{{ __('strings.backend.add_new') }}</a></li>
                    </ul>
                </li>

                <?php if(auth()->user()->hasRole('administrator')){ ?>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-map-alt"></i>{{ __('strings.backend.manage_property_types')}}</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-table"></i><a href="{{ route('admin.property_types.index') }}">{{ __('strings.backend.property_types')}}</a></li>
                        <li><i class="fa fa-table"></i><a href="{{ route('admin.property_types.create') }}">{{ __('strings.backend.add_new')}}</a></li>
                    </ul>
                </li>
                <?php } ?>

                <?php if(auth()->user()->hasRole('administrator')){ ?>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-map-alt"></i>{{ __('strings.backend.manage_location')}}</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-table"></i><a href="{{ route('admin.cities.index') }}">{{ __('strings.backend.cities')}}</a></li>
                        <li><i class="fa fa-table"></i><a href="{{ route('admin.districts.index') }}">{{ __('strings.backend.districts')}}</a></li>
                    </ul>
                </li>
                <?php } ?>

                <?php if(auth()->user()->hasRole('administrator')){ ?>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-map-alt"></i>{{ __('strings.backend.manage_pages')}}</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-table"></i><a href="{{ route('admin.pages.index') }}">{{ __('strings.backend.pages')}}</a></li>
                        <li><i class="fa fa-table"></i><a href="{{ route('admin.pages.create') }}">{{ __('strings.backend.add_new')}}</a></li>
                    </ul>
                </li>
                <?php } ?>

                <?php if(auth()->user()->hasRole('administrator')){ ?>
                
                <li class="{{ (\Request::route()->getName() == 'admin.auth.user.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.auth.user.index') }}" class=""> <i class="menu-icon fa fa-users"></i>{{ __('strings.backend.customers')}}</a>
                </li>
                <?php } ?>

                <li class="{{ (\Request::route()->getName() == 'admin.notifications.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.notifications.index') }}" class=""> <i class="menu-icon fa fa-bar-chart-o"></i>{!! __('strings.backend.notifications') !!}</a>
                </li>

                <?php if(auth()->user()->hasRole('broker')){ ?>
                    <li class="{{ (\Request::route()->getName() == 'admin.messages.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.messages.index') }}" class=""> <i class="menu-icon fa fa-bar-chart-o"></i> {!! __('strings.backend.messages') !!}</a>
                    </li>
                <?php } ?>
                
                <?php if(auth()->user()->hasRole('broker')){ ?>
                    <li class="{{ (\Request::route()->getName() == 'admin.account') ? 'active' : '' }}">
                        <a href="{{ route('admin.account') }}" class=""> <i class="menu-icon fa fa-user"></i> {!! __('strings.backend.profile') !!}</a>
                    </li>
                <?php } ?>

                <?php if(auth()->user()->hasRole('administrator')){ ?>
                <li class="{{ (\Request::route()->getName() == 'admin.settings') ? 'active' : '' }} d-none">
                    <a href="{{ route('admin.settings.index') }}" class=""> <i class="menu-icon fa fa-gear"></i> Settings</a>
                </li>
                <li class="menu-item-has-children dropdown d-none">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart-o"></i>Reports</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-th"></i><a href="forms-basic.html">Basic Form</a></li>
                        <li><i class="menu-icon fa fa-th"></i><a href="forms-advanced.html">Advanced Form</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown d-none">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-bar-chart"></i>SEO</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-th"></i><a href="forms-basic.html">Basic Form</a></li>
                        <li><i class="menu-icon fa fa-th"></i><a href="forms-advanced.html">Advanced Form</a></li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>