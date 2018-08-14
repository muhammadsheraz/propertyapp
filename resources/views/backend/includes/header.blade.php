<!-- Header-->
<header id="header" class="header">
    <div class="header-menu">

        <div class="col-sm-7">
            <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            <div class="header-left">
                

                <div class="dropdown for-notification">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                    <span class="count bg-danger">{{ count($notifications) }}</span>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="notification">
                    <p class="red">{{ __('strings.backend.notifications_count_message', ['count_notifications' => count($notifications)]) }}</p>
                    <?php if (!empty($notifications)) { ?>
                    <?php foreach ($notifications as $notification) { ?>
                        <a class="dropdown-item media notification-dropdown-item" href="<?php echo url("/admin/notifications") ?>" data-notification-id="<?php echo $notification->id; ?>">
                            <i class="fa fa-check"></i>
                            <p><?php echo strip_tags(get_notification_message($notification)); ?></p>
                        </a>
                    <?php } ?>
                    <?php } ?>
                  </div>
                </div>

                <?php if(auth()->user()->hasRole('broker')){ ?>
                <div class="dropdown for-message">
                  <button class="btn btn-secondary dropdown-toggle" type="button"
                        id="message"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti-email"></i>
                    <span class="count bg-primary"><?php echo count($messages); ?></span>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="message">

                    <?php if (count($messages) == 1) { ?>
                        <p class="red"><?php echo __('strings.backend.you_got_new_message', ['message_count'=>count($messages)])?></p>
                    <?php } else { ?>
                        <p class="red"><?php echo __('strings.backend.you_got_new_messages', ['message_count'=>count($messages)])?></p>
                    <?php } ?>

                    <?php if (count($messages)) { ?>
                        <?php foreach ($messages as $message) { ?>
                            <a class="dropdown-item media messageLink" href="<?php echo url('admin/messages/'. $message['thread_id']); ?>" data-customer-id="<?php echo $message['user_id']; ?>">
                                <?php
                                if (!empty($customer['user_data']['avatar_location'])) {
                                    $customer_avatar = \Storage::url($customer['user_data']['avatar_location']);
                                } else {
                                    $customer_avatar = \Storage::url('/images/login.png');
                                }
                                ?>                            
                                <span class="photo media-left"><img alt="avatar" src="<?php echo $customer_avatar; ?>"></span>
                                <span class="message media-body">
                                    <span class="name float-left"><?php echo $message['user_data']['fullname']; ?></span>
                                    <span class="time float-right"><?php echo date('m/d/Y G:i', strtotime($message['created_at'])); ?></span>
                                        <p><?php echo $message['body']; ?></p>
                                </span>
                            </a>                        
                        <?php } ?>
                    <?php } ?>                    
                  </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="col-sm-5">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" title="{{ __('strings.general.logged_in_as') . $logged_in_user->full_name}}" aria-expanded="false">
                    <?php if (!empty($logged_in_user->avatar_location)) { ?>
                        <img class="user-avatar rounded-circle" src="{{ $logged_in_user->picture }}" alt="{{ $logged_in_user->full_name }}">
                    <?php } else { ?>
                        <img class="user-avatar rounded-circle" src="{{ url('/images/login.png') }}" alt="{{ $logged_in_user->full_name }}">
                    <?php } ?>
                </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="{{ route('admin.account') }}"><i class="fa fa- user"></i>{{ __('strings.backend.my_profile') }}</a>
                    <a class="nav-link" href="{{ route('admin.notifications.index') }}"><i class="fa fa- user"></i>{{ __('strings.backend.notifications') }} <span class="count">{{ count($notifications)}}</span></a>
                    <a class="nav-link" href="{{ route('frontend.auth.logout') }}"><i class="fa fa-power -off"></i>{{__('navs.general.logout')}}</a>
                </div>
            </div>

            @if (config('locale.status') && count(config('locale.languages')) > 1)
            <?php //if(!auth()->user()->hasRole('broker')){ ?>
                <div class="language-select dropdown" id="language-select">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                        <?php if (app()->getLocale() == 'en') { ?>
                            <i class="flag-icon flag-icon-um"></i>
                        <?php } else if (app()->getLocale() == 'ar') { ?>
                            <i class="flag-icon flag-icon-sa"></i>
                        <?php } else { ?>
                            <i class="flag-icon flag-icon-{{ app()->getLocale() }}"></i>
                        <?php } ?>
                    </a>
                    @include('includes.partials.lang')
                </div>
            <?php //} ?>
            @endif

        </div>
    </div>

</header><!-- /header -->
<!-- Header-->