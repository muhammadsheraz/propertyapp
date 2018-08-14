<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' =>[
        'access' =>[
            'title'  => 'Управление доступом',

            'users' =>[
                'all'              => 'Все пользователи',
                'change-password'  => 'Изменить пароль',
                'create'           => 'Создать пользователя',
                'deactivated'      => 'Деактивированные пользователи',
                'deleted'          => 'Удаленные пользователи',
                'edit'             => 'Изменить учетную запись пользователя ',
                'main'             => 'Пользователи',
                'view'             => 'Просмотр пользователя',
            ],
        ],

        'log-viewer' =>[
            'main'       => 'Журнал событий',
            'dashboard'  => 'Панель',
            'logs'       => 'Журналы',
        ],

        'sidebar' =>[
            'dashboard'  => 'Панель',
            'general'    => 'Общие',
            'system'     => 'Система',
        ],
    ],

    'language-picker' =>[
        'language'  => 'Язык',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' =>[
            'ar'     => 'Арабский',
            'zh'     => 'Современный китайский',
            'zh-TW'  => 'Традиционный китайский',
            'da'     => 'Датский',
            'de'     => 'Немецкий',
            'el'     => 'Греческий',
            'en'     => 'Английский',
            'es'     => 'Испанский',
            'fr'     => 'Французский',
            'he'     => 'Иврит',
            'id'     => 'Индонезийский',
            'it'     => 'Итальянский',
            'ja'     => 'Японский',
            'nl'     => 'Голландский',
            'no'     => 'Норвежский',
            'pt_BR'  => 'Бразильский португальский',
            'ru'     => 'Русский',
            'sv'     => 'Шведский',
            'th'     => 'Тайский',
            'tr'     => 'Турецкий',
        ],
    ],
];
