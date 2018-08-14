<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel '.app()->version().' Boilerplate'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost/realapp'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => env('APP_TIMEZONE', 'UTC'),

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    /*
    |--------------------------------------------------------------------------
    | PHP Locale Code
    |--------------------------------------------------------------------------
    |
    | The PHP locale determines the default locale that will be used
    | by the Carbon library when setting Carbon's localization.
    |
    */
    'locale_php' => env('APP_LOCALE_PHP', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        Collective\Html\HtmlServiceProvider::class,

        /*
         * Package Service Providers...
         */
        Appstract\BladeDirectives\BladeDirectivesServiceProvider::class,
        Creativeorange\Gravatar\GravatarServiceProvider::class,
        HieuLe\Active\ActiveServiceProvider::class,

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\BladeServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\ComposerServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        CrudGenerator\CrudGeneratorServiceProvider::class,

        /*
         * Goolge Map Integration...
         */
        Cornford\Googlmapper\MapperServiceProvider::class,

        /**
         * BotDetect - Captcha : Laravel 5 Integration
         */
        'Latrell\Captcha\CaptchaServiceProvider',

        /**
         * Laravel Passport
         */
        Laravel\Passport\PassportServiceProvider::class,
        Barryvdh\DomPDF\ServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'Captcha' => 'Latrell\Captcha\Facades\Captcha',
        'Form' => Collective\Html\FormFacade::class,
        'Html' => Collective\Html\HtmlFacade::class,
        /*
         * Package Aliases
         */
        'Active' => HieuLe\Active\Facades\Active::class,
        'Gravatar' => Creativeorange\Gravatar\Facades\Gravatar::class,
        'Socialite' => Laravel\Socialite\Facades\Socialite::class,
        /*
         * Google Map Aliases
         */
        'Mapper' => Cornford\Googlmapper\Facades\MapperFacade::class,
        /*
         * DomPDF Laravel Extension
         */        
        'PDF' => Barryvdh\DomPDF\Facade::class,
    ],

    'max_upload_size' => '2000000', // In Bytes 2000000 bytes = 2 Mbytes
    'allowed_images' => '/(\.|\/)(gif|jpe?g|png)$/i', // RegExp (only png, jpg, jpeg and gifs are allowed for now)

    'broker_no_padding_size' => 5,
    'customer_no_padding_size' => 5,
    'property_no_padding_size' => 5,
    'message_no_padding_size' => 5,
    'active'=>'active',
    'closed'=>'closed',
    'pending'=>'pending',
    'draft'=>'draft',
    'cancelled'=>'cancelled',
    'completed'=>'completed',
    'inactive' => 'inactive',
    'sold' => 'sold',
    'rented' => 'rented',
    'request_sold' => 'sold-pending',
    'request_rented' => 'rented-pending',

    'cheapest' => 'cheapest',
    'highest' => 'highest',
    'newest' => 'newest',
    'oldest' => 'oldest',

    'yes' => 'yes',
    'no' => 'no',

    'broker_created' => 'broker account created',
    'broker_updated' => 'broker account updated',
    'broker_deleted' => 'broker account deleted',
    'broker_active' => 'broker account active',
    'broker_inactive' => 'broker account inactive',
    'broker_registered' => 'broker registered',
    'sold_request' => 'property sold request',
    'rented_request' => 'property rented request',

    'property_assigned' => 'property assigned',
    'property_created' => 'property created',
    'property_updated' => 'property updated',
    'property_deleted' => 'property deleted',
    'property_active' => 'property active',
    'broker_contracts_file_path' => '/broker_contracts',
    'settings_broker_contracts' => '/settings_broker_contracts',
    'broker_contract_uploaded' => 'broker contract uploaded',
    'broker_contract_confirmed' => 'broker contract confirmed',
    'broker_contract_discontinued' => 'broker contract discontinued',
    'buy' => 'buy',
    'rent' => 'rent',
    'percent' => 'percent',
    'fixed' => 'fixed',

    'safe_broker_delete' => false,

    'create' => 'create',
    'edit' => 'edit',

    ## Microsoft Translation API
    'microsoft_translator_api_key' => '13a3bf5247aa4c65ac3ff8a6c701cda1',
    'microsoft_translator_api_host' => 'https://api.cognitive.microsofttranslator.com',
    'microsoft_translator_api_endpoint' => '/translate?api-version=3.0',

    'property' => 'property',
    'property_request' => 'property_request',
];
