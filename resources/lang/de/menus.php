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
            'title'  => 'Zugangsmanagement',

            'users' =>[
                'all'              => 'Alle Nutzer',
                'change-password'  => 'Passwort ändern',
                'create'           => 'Benutzer erstellen',
                'deactivated'      => 'Deaktivierte Nutzer',
                'deleted'          => 'Gelöschte Nutzer',
                'edit'             => 'Nutzerkonto bearbeiten',
                'main'             => 'Benutzer',
                'view'             => 'Nutzer ansehen',
            ],
        ],

        'log-viewer' =>[
            'main'       => 'Tägliche Ansicht',
            'dashboard'  => 'Panel',
            'logs'       => 'Tagesansicht',
        ],

        'sidebar' =>[
            'dashboard'  => 'Panel',
            'general'    => 'Allgemein',
            'system'     => 'System',
        ],
    ],

    'language-picker' =>[
        'language'  => 'Sprache',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' =>[
            'ar'     => 'Arabisch',
            'zh'     => 'Hochchinesisch',
            'zh-TW'  => 'Traditionelles chinesisch',
            'da'     => 'Dänisch',
            'de'     => 'Deutsch',
            'el'     => 'Griechisch',
            'en'     => 'Englisch',
            'es'     => 'Spanisch',
            'fr'     => 'Französisch',
            'he'     => 'Israelisch',
            'id'     => 'Indonesisch',
            'it'     => 'Italienisch',
            'ja'     => 'Japanisch',
            'nl'     => 'Niederländisch',
            'no'     => 'Norwegisch',
            'pt_BR'  => 'Brasilianisches portugiesisch',
            'ru'     => 'Russisch',
            'sv'     => 'Schwedisch',
            'th'     => 'Thailändisch',
            'tr'     => 'Türkisch',
        ],
    ],
];
