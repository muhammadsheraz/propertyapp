<?php

use App\Helpers\General\HtmlHelper;
use App\Models\Setting;
use App\Helpers\TranslatorAPI;

/*
 * Global helpers file with misc functions.
 */
if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (! function_exists('include_route_files')) {

    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function include_route_files($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (! function_exists('home_route')) {

    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function home_route()
    {
        if (auth()->check()) {
            if (auth()->user()->can('view backend')) {
                return 'admin.dashboard';
            } else {
                return 'frontend.user.dashboard';
            }
        }

        return 'frontend.index';
    }
}

if (! function_exists('style')) {

    /**
     * @param       $url
     * @param array $attributes
     * @param null  $secure
     *
     * @return mixed
     */
    function style($url, $attributes = [], $secure = null)
    {
        return resolve(HtmlHelper::class)->style($url, $attributes, $secure);
    }
}

if (! function_exists('script')) {

    /**
     * @param       $url
     * @param array $attributes
     * @param null  $secure
     *
     * @return mixed
     */
    function script($url, $attributes = [], $secure = null)
    {
        return resolve(HtmlHelper::class)->script($url, $attributes, $secure);
    }
}

if (! function_exists('form_cancel')) {

    /**
     * @param        $cancel_to
     * @param        $title
     * @param string $classes
     *
     * @return mixed
     */
    function form_cancel($cancel_to, $title, $classes = 'btn btn-danger btn-sm')
    {
        return resolve(HtmlHelper::class)->formCancel($cancel_to, $title, $classes);
    }
}

if (! function_exists('form_submit')) {

    /**
     * @param        $title
     * @param string $classes
     *
     * @return mixed
     */
    function form_submit($title, $classes = 'btn btn-success btn-sm pull-right')
    {
        return resolve(HtmlHelper::class)->formSubmit($title, $classes);
    }
}

if (! function_exists('get_user_timezone')) {

    /**
     * @return string
     */
    function get_user_timezone()
    {
        if (auth()->user()) {
            return auth()->user()->timezone;
        }

        return 'UTC';
    }
}

if (! function_exists('prepare_for_select')) {

    /**
     * @return string
     */
    function prepare_for_select($data, $params)
    {
        $key = $params['key'];
        $value = $params['value'];
        $placeholder = array_get($params, 'placeholder', '');

        $prep_data = [''=> $placeholder];

        
        if (!empty($data)) {
            foreach ($data as $d) {
                if (is_array($d)) {
                    $prep_data[$d[$key]] = $d[$value];
                } else {
                    $prep_data[$d->$key] = $d->$value;
                }
            }
        }

        return $prep_data;
    }
}

if (! function_exists('get_page_url')) {

    /**
     * @return string
     */
    function get_page_url($page)
    {
        $page_url = '';

        if (!empty($page)) {
            switch($page->page_type) {
                case "information":
                case "properties":
                    $page_url = url("/$page->page_type/$page->slug");
                    break;
                case "static":
                    if ($page->slug == 'home')
                        $page_url = url("/");
                    else 
                        $page_url = url("/$page->slug");
                    break;
            }
        }

        return $page_url;
    }
}

if (! function_exists('get_property_status')) {

    /**
     * @return string
     */
    function get_property_status($status='')
    {
        if (!empty($status)) {
            switch($status) {
                case "active":
                    return ucfirst(config('app.active'));                
                case "pending":
                    return ucfirst(config('app.pending'));                
                case "inactive":
                    return ucfirst(config('app.inactive'));
                case "draft":
                    return ucfirst(config('app.draft'));
                case "sold-pending":
                    return ucfirst(config('app.request_sold'));
                case "rented-pending":
                    return ucfirst(config('app.request_rented'));
                default:
                    return '';
            }
        } else {
            return [
                'active'=>ucfirst(config('app.active')),
                'pending'=>ucfirst(config('app.pending')),
                'inactive'=>ucfirst(config('app.inactive')),
                'draft'=>ucfirst(config('app.draft')),
                'sold-pending'=>ucfirst(config('app.request_sold')),
                'rented-pending'=>ucfirst(config('app.request_rented')),
            ];
        }
    }
}

if (! function_exists('get_property_types')) {

    /**
     * @return string
     */
    function get_property_types($type='')
    {
        if (!empty($type)) {
            switch($type) {
                case "1":
                    return __('strings.frontend.offices');                
                case "2":
                    return __('strings.frontend.condos');                
                case "3":
                    return __('strings.frontend.townhouses');
                case "4":
                    return __('strings.frontend.houses');
                default:
                    return '';
            }
        } else {
            return [
                '2' => __('strings.frontend.condos'),
                '3' => __('strings.frontend.townhouses'),
                '4' => __('strings.frontend.houses'),
                '1' => __('strings.frontend.offices'),
            ];
        }
    }
}

if (! function_exists('get_currency_symbols')) {

    /**
     * @return string
     */
    function get_currency_symbols($symbol='')
    {
        if (!empty($status)) {
            switch($status) {
                case "$":
                    return '$';                
                case "£":
                    return '£';                
                case "₺":
                    return '₺';
                default:
                    return '';
            }
        } else {
            return [
                '$'=>'$',
                '£'=>'£',
                '₺'=>'₺',
            ];
        }
    }
}

if (! function_exists('get_property_purpose')) {

    /**
     * @return string
     */
    function get_property_purpose()
    {
        return ['rent'=>__('strings.frontend.for_rent'), 'buy'=>__('strings.frontend.for_sale')];
    }
}

if (! function_exists('get_property_title_by_lang')) {

    /**
     * @return string
     */
    function get_property_title_by_lang($property) {
        $lang = app()->getLocale();
                
        switch ($lang) {
            case 'en':
                $title = $property->title;
                break;
            
            default:
                $title = $property->{'title_' . $lang};
                break;
        }

        return $title;
    }
}

if (! function_exists('get_property_type_name_by_lang')) {

    /**
     * @return string
     */
    function get_property_type_name_by_lang($property_type) {
        $lang = app()->getLocale();
                
        switch ($lang) {
            case 'en':
                $name = $property_type->name;
                break;
            
            default:
                $name = $property_type->{'name_' . $lang};
                break;
        }

        return $name;
    }
}

if (! function_exists('get_property_description_by_lang')) {

    /**
     * @return string
     */
    function get_property_description_by_lang($property) {
        $lang = app()->getLocale();
                
        switch ($lang) {
            case 'en':
                $description = $property->description;
                break;
            
            default:
                $description = $property->{'description_' . $lang};
                break;
        }

        return $description;
    }
}

if (! function_exists('app_settings_get')) {
    
    /**
     * @return string
     */
    function app_settings_get($column = '') {
        $application_id = 1;

        if (!empty($column)) {
            if (is_array($column)) {
                return array_only(Setting::findOrFail($application_id)->toArray(), $column);
            } else {
                return Setting::findOrFail($application_id)->$column;
            }
        } else {
            return Setting::findOrFail($application_id);
        }        
    }
}

if (! function_exists('get_notification_message')) {

    /**
     * @return string
     */
    function get_notification_message($notification) {
        $action = '';

        $action = !empty($notification->data['action']) ? $notification->data['action'] : '';
        $target = "_blank";

        switch ($action) {
            case config('app.property_created'):
                $property = $notification->data['property'];
                $user = $notification->data['done_by'];
                $role_name = ucfirst($notification->data['done_by_role']['name']);
                if ($notification->data['done_by_role']['name'] != 'administrator') {
                    $role_name = '';
                }
                
                $params['property_label'] = '<a target="' . $target . '" href="' . url('/admin/properties/' . $property['id'] ) . '">' . $property['property_no'] . '</a>';

                if ($notification->notifiable_id == $user['id']) {
                    $params['user_label'] = $role_name . '<a target="' . $target . '" href="' . url('/admin/account/' ) . '">' . $user['broker_no'] . '</a>';
                } else {
                    $params['user_label'] = $role_name . '<a target="' . $target . '" href="' . url('/admin/auth/broker/' . $user['id'] ) . '">' . $user['broker_no'] . '</a>';
                }

                $action = __('strings.notifications.property_created', $params);
                break;
            case config('app.property_updated'):
                $property = $notification->data['property'];
                $user = $notification->data['done_by'];
                $role_name = ucfirst($notification->data['done_by_role']['name']);

                if ($notification->data['done_by_role']['name'] != 'administrator') {
                    $role_name = '';
                }
                
                $params['property_label'] = '<a target="' . $target . '" href="' . url('/admin/properties/' . $property['id'] ) . '">' . $property['property_no'] . '</a>';
                $params['user_label'] = $role_name . '<a target="' . $target . '" href="' . url('/admin/properties/' . $user['id'] ) . '">' . $user['broker_no'] . '</a>';

                $action = __('strings.notifications.property_updated', $params);
                break;
            case config('app.property_deleted'):
                $property = $notification->data['property'];
                $user = $notification->data['done_by'];
                $role_name = ucfirst($notification->data['done_by_role']['name']);
                if ($notification->data['done_by_role']['name'] != 'administrator') {
                    $role_name = '';
                }

                $params['property_label'] = '<a target="' . $target . '" href="' . url('/admin/properties/' . $property['id'] ) . '">' . $property['property_no'] . '</a>';
                $params['user_label'] = $role_name . '<a target="' . $target . '" href="' . url('/admin/properties/' . $user['id'] ) . '">' . $user['broker_no'] . '</a>';

                $action = __('strings.notifications.property_deleted', $params);
                break;
            case config('app.property_active'):
                $property = $notification->data['property'];
                $user = $notification->data['done_by'];
                $role_name = ucfirst($notification->data['done_by_role']['name']);
                if ($notification->data['done_by_role']['name'] != 'administrator') {
                    $role_name = '';
                }

                $broker = $notification->data['broker'];

                $params['property_label'] = '<a target="' . $target . '" href="' . url('/admin/properties/' . $property['id'] ) . '">' . $property['property_no'] . '</a>';
                $params['user_label'] = $role_name . '<a target="' . $target . '" href="' . url('/admin/properties/' . $user['id'] ) . '">' . $user['broker_no'] . '</a>';

                $action = __('strings.notifications.property_active', $params);
                break;
            case config('app.property_assigned'):
                $property = $notification->data['property'];
                $broker = $notification->data['broker'];
                $role_name = ucfirst($notification->data['done_by_role']['name']);
                if ($notification->data['done_by_role']['name'] != 'administrator') {
                    $role_name = '';
                }
                $params['property_label'] = '<a target="' . $target . '" href="' . url('/admin/properties/' . $property['id'] ) . '">' . $property['property_no'] . '</a>';
                $params['user_label'] = $role_name;
                $params['broker_label'] = '<a target="' . $target . '" href="' . url('/admin/auth/broker/' . $broker['id'] ) . '">' . $broker['broker_no'] . '</a>';

                $action = __('strings.notifications.property_assigned', $params);
                break;
            case config('app.broker_registered'):
                $broker = $notification->data['broker'];
                $role_name = ucfirst($notification->data['done_by_role']['name']);
                $role_name = '';
                $params['user_label'] = $role_name .  ' <a target="' . $target . '" href="' . url('/admin/auth/broker/' . $broker['id'] ) . '">' . $broker['broker_no'] . '</a>';

                $action = __('strings.notifications.user_registered', $params);
                break;            
            case config('app.broker_created'):
                $broker = $notification->data['broker'];
                $user = $notification->data['done_by'];
                $done_by_role = ucfirst($notification->data['done_by_role']['name']);

                if ($notification->notifiable_id == $broker['id']) {
                    $params['user_label'] = '<a target="' . $target . '" href="' . url('/admin/account/' ) . '">' . $broker['broker_no'] . '</a>';
                } else {
                    $params['user_label'] = '<a target="' . $target . '" href="' . url('/admin/auth/broker/' . $broker['id'] ) . '">' . $broker['broker_no'] . '</a>';
                }
                $params['done_by_label'] = $done_by_role;

                $action = __('strings.notifications.user_created', $params);
                break;            
            case config('app.broker_deleted'):
                $broker = $notification->data['broker'];
                $user = $notification->data['done_by'];
                $done_by_role = ucfirst($notification->data['done_by_role']['name']);

                if ($notification->notifiable_id == $broker['id']) {
                    $params['user_label'] = '<a target="' . $target . '" href="' . url('/admin/account/' ) . '">' . $broker['broker_no'] . '</a>';
                } else {
                    $params['user_label'] = '<a target="' . $target . '" href="' . url('/admin/auth/broker/' . $broker['id'] ) . '">' . $broker['broker_no'] . '</a>';
                }
                $params['done_by_label'] = $done_by_role;

                $action = __('strings.notifications.user_deleted', $params);
                break;            
            case config('app.broker_active'):
                $broker = $notification->data['broker'];
                $user = $notification->data['done_by'];
                $done_by_role = ucfirst($notification->data['done_by_role']['name']);

                if ($notification->notifiable_id == $broker['id']) {
                    $params['user_label'] = '<a target="' . $target . '" href="' . url('/admin/account/' ) . '">' . $broker['broker_no'] . '</a>';
                } else {
                    $params['user_label'] = '<a target="' . $target . '" href="' . url('/admin/auth/broker/' . $broker['id'] ) . '">' . $broker['broker_no'] . '</a>';
                }

                $params['done_by_label'] = $done_by_role;

                $action = __('strings.notifications.user_active', $params);
                break;           
            case config('app.broker_inactive'):
                $broker = $notification->data['broker'];
                $user = $notification->data['done_by'];
                $done_by_role = ucfirst($notification->data['done_by_role']['name']);

                if ($notification->notifiable_id == $broker['id']) {
                    $params['user_label'] = '<a target="' . $target . '" href="' . url('/admin/account/' ) . '">' . $broker['broker_no'] . '</a>';
                } else {
                    $params['user_label'] = '<a target="' . $target . '" href="' . url('/admin/auth/broker/' . $broker['id'] ) . '">' . $broker['broker_no'] . '</a>';
                }
                $params['done_by_label'] = $done_by_role;

                $action = __('strings.notifications.user_inactive', $params);
                break;            
            case config('app.broker_updated'):
                $broker = $notification->data['broker'];
                $user = $notification->data['done_by'];
                $role_name = ucfirst($notification->data['done_by_role']['name']);
                $role_name = '';

                if ($notification->notifiable_id == $broker['id']) {
                    $params['broker_label'] = '<a target="' . $target . '" href="' . url('/admin/account/' ) . '">' . $broker['broker_no'] . '</a>';
                } else {
                    $params['broker_label'] = '<a target="' . $target . '" href="' . url('/admin/auth/broker/' . $broker['id'] ) . '">' . $broker['broker_no'] . '</a>';
                }

                $params['user_label'] = $role_name . '<a target="' . $target . '" href="' . url('/admin/properties/' . $user['id'] ) . '">' . $user['broker_no'] . '</a>';

                $action = __('strings.notifications.user_created', $params);
                break;            
            case config('app.broker_contract_uploaded'):
                $broker = $notification->data['broker'];
                $user = $notification->data['done_by'];
                $role_name = ucfirst($notification->data['done_by_role']['name']);
                $role_name = '';
                $contract_file_path = Storage::url($broker['contract_file']);

                $params['contract_label'] = '<a target="' . $target . '" href="' . $contract_file_path . '">Contract</a>';
                
                if ($notification->notifiable_id == $broker['id']) {
                    $params['broker_label'] = '<a target="' . $target . '" href="' . url('/admin/account/' ) . '">' . $broker['broker_no'] . '</a>';
                } else {
                    $params['broker_label'] = '<a target="' . $target . '" href="' . url('/admin/auth/broker/' . $broker['id'] ) . '">' . $broker['broker_no'] . '</a>';
                }

                $action = __('strings.notifications.broker_contract_uploaded', $params);
                break;            
            case config('app.broker_contract_confirmed'):
                $broker = $notification->data['broker'];
                $user = $notification->data['done_by'];
                $role_name = ucfirst($notification->data['done_by_role']['name']);
                $role_name = '';
                if ($notification->notifiable_id == $broker['id']) {
                    $params['broker_label'] = '<a target="' . $target . '" href="' . url('/admin/account/' ) . '">' . $broker['broker_no'] . '</a>';
                } else {
                    $params['broker_label'] = '<a target="' . $target . '" href="' . url('/admin/auth/broker/' . $broker['id'] ) . '">' . $broker['broker_no'] . '</a>';
                }

                $params['user_label'] = $role_name;

                $action = __('strings.notifications.broker_contract_confirmed', $params);
                break;            
            case config('app.broker_contract_discontinued'):
                $broker = $notification->data['broker'];
                $user = $notification->data['done_by'];
                $role_name = ucfirst($notification->data['done_by_role']['name']);
                $role_name = '';
                if ($notification->notifiable_id == $broker['id']) {
                    $params['broker_label'] = '<a target="' . $target . '" href="' . url('/admin/account/' ) . '">' . $broker['broker_no'] . '</a>';
                } else {
                    $params['broker_label'] = '<a target="' . $target . '" href="' . url('/admin/auth/broker/' . $broker['id'] ) . '">' . $broker['broker_no'] . '</a>';
                }

                $params['user_label'] = $role_name;

                $action = __('strings.notifications.broker_contract_discontinued', $params);
                break;            
            case config('app.sold_request'):
                $broker = $notification->data['done_by'];
                $property = $notification->data['property'];
                
                if ($notification->notifiable_id == $broker['id']) {
                    $params['broker_label'] = '<a target="' . $target . '" href="' . url('/admin/account/' ) . '">' . $broker['broker_no'] . '</a>';
                } else {
                    $params['broker_label'] = '<a target="' . $target . '" href="' . url('/admin/auth/broker/' . $broker['id'] ) . '">' . $broker['broker_no'] . '</a>';
                }

                $params['property_label'] = 'Property <a target="' . $target . '" href="' . url('/admin/properties/' . $property['id'] ) . '">' . $property['property_no'] . '</a>';

                $action = __('strings.notifications.property_sold_request', $params);
                break;
            case config('app.rented_request'):
                $broker = $notification->data['done_by'];
                $property = $notification->data['property'];
                
                if ($notification->notifiable_id == $broker['id']) {
                    $params['broker_label'] = '<a target="' . $target . '" href="' . url('/admin/account/' ) . '">' . $broker['broker_no'] . '</a>';
                } else {
                    $params['broker_label'] = '<a target="' . $target . '" href="' . url('/admin/auth/broker/' . $broker['id'] ) . '">' . $broker['broker_no'] . '</a>';
                }

                $params['property_label'] = 'Property <a target="' . $target . '" href="' . url('/admin/properties/' . $property['id'] ) . '">' . $property['property_no'] . '</a>';

                $action = __('strings.notifications.property_rented_request', $params);
                break;            
            default:
                
                break;
        }

        return $action;
    }
}

if (! function_exists('get_rooms')) {

    /**
     * @return string
     */
    function get_rooms($room='')
    {
        if (!empty($room)) {
            switch($room) {
                case "1":
                    return '1+1';                
                case "2":
                    return '2+1';                
                case "3":
                    return '3+1';
                case "4":
                    return '4+1';
                case "5":
                    return '5+1';
                case "6":
                    return '6+';
                default:
                    return '';
            }
        } else {
            return [
                '1'=>'1+1',
                '2'=>'2+1',
                '3'=>'3+1',
                '4'=>'4+1',
                '5'=>'5+1',
                '6'=>'6+',
            ];
        }
    }
}

if (! function_exists('get_currency_symbol')) {

    /**
     * @return string
     */
    function get_currency_symbol($code='')
    {
        if (!empty($code)) {
            switch($code) {
                case "USD":
                    return '$';                
                case "GBP":
                    return '£';                
                case "EUR":
                    return '€';
                case "TRY":
                    return '₺';
                default:
                    return '';
            }
        } else {
            return '$';
        }
    }
}

if (!function_exists('com_create_guid')) {
    function com_create_guid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

/**
 * This function is currently being used by Microsoft Translation API,
 * see App\Helpers\TranslatorAPI
 */
if (!function_exists('get_translations')) {
    function get_translations($text = "", $langs = ['en' , 'de', 'ar', 'tr', 'ru']) {
		$translator = new TranslatorAPI();

		$params['to'] = $langs;
		
		$requestBody = $text;
		return $translator->translate($params, $requestBody);
    }
}


if (!function_exists('get_address')) {
    function get_address ($object) {
		$address = '';
		$components = [
			'house_no',
			'street1',
			'street2',
			'district_name',
			'city_name',
			'country_name',
		];
        
        $array = (array) $object; 

		$address = implode(", ", \array_only($array, $components));

		return $address;
    }
}

if (!function_exists('get_datatable_lang')) {
    function get_datatable_lang ($localLang) {
        $dtLang = [
            'en' => 'English.lang',
            'tr' => 'Turkish.lang',
            'ar' => 'Arabic.lang',
            'ru' => 'Russian.lang',
            'de' => 'German.lang',
        ];

		return $dtLang[$localLang];
    }
}
}