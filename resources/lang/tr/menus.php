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
            'title'  => 'Erişim Yönetimi',

            'users' =>[
                'all'              => 'Bütün Kullanıcılar',
                'change-password'  => 'Şifre Değiştir',
                'create'           => 'Kullanıcı Oluştur',
                'deactivated'      => 'Etkisizleştirilmiş Kullanıcılar',
                'deleted'          => 'Silinmiş Kullanıcılar',
                'edit'             => 'Kullanıcı Hesabını Düzenle',
                'main'             => 'Kullanıcılar',
                'view'             => 'Kullanıcıya Gözat',
            ],
        ],

        'log-viewer' =>[
            'main'       => 'Günlük Görüntüleyici',
            'dashboard'  => 'Panel',
            'logs'       => 'Günlükler',
        ],

        'sidebar' =>[
            'dashboard'  => 'Panel',
            'general'    => 'Genel',
            'system'     => 'Sistem',
        ],
    ],

    'language-picker' =>[
        'language'  => 'Dil',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' =>[
            'ar'     => 'Arapça',
            'zh'     => 'Modern Çince',
            'zh-TW'  => 'Geleneksel Çince',
            'da'     => 'Danimarka Dili',
            'de'     => 'Almanca',
            'el'     => 'Yunanca',
            'en'     => 'İngilizce',
            'es'     => 'İspanyolca',
            'fr'     => 'Fransızca',
            'he'     => 'İsrailce',
            'id'     => 'Endonezya Dili',
            'it'     => 'İtalyanca',
            'ja'     => 'Japonca',
            'nl'     => 'Hollandaca',
            'no'     => 'Norveçce',
            'pt_BR'  => 'Brezilya Portekizcesi',
            'ru'     => 'Rusça',
            'sv'     => 'İsveçce',
            'th'     => 'Tayland Dili',
            'tr'     => 'Türkçe',
        ],
    ],
];
