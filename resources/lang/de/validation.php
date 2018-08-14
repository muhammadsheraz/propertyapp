<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'              => ':attribute wurde nicht akzeptiert',
    'active_url'            => ':attribute ist keine gültige URL',
    'after'                 => ' Das :attribute Datum muss nach dem :date Datum sein',
    'after_or_equal'        => 'Das :attribute Datum muss vor oder am Tag des :date Datums sein',
    'alpha'                 => ':attribute darf nur aus Buchstaben bestehen',
    'alpha_dash'            => ':attribute  darf aus Buchstaben, Ziffern oder Leerzeichen bestehen',
    'alpha_num'             => ':attribute darf aus Buchstaben oder Ziffern bestehen',
    'array'                 => ':attribute kann aus einer Sequenz bestehen',
    'before'                => ':attribute , muss vor dem :date Datum sein',
    'before_or_equal'       => ':attribute , muss vor oder am Tag des :date Datums sein',
    'between'              =>[
        'numeric'  => ':attribute , muss zwischen dem Minimum :min und Maximum :max sein',
        'file'     => ':attribute , muss zwischen den Minimum :min und Maximum :max Kilobyte sein',
        'string'   => ':attribute , muss zwischen den Minimum :min und Maximum :max Zeichen sein',
        'array'    => ':attribute , muss zwischen den Minimum :min und Maximum :max Artikeln sein',
    ],
    'boolean'               => 'Das :attribute Feld muss richtig oder falsch sein',
    'confirmed'             => ':attribute Überprüfung stimmt nicht überein',
    'date'                  => ':attribute ist kein gültiges Datum',
    'date_format'           => 'Das :attribute, :format Format stimmt nicht überein',
    'different'             => ':attribute und andere :other müssen unterschiedlich sein',
    'digits'                => ':attribute muss aus Ziffern bestehen',
    'digits_between'        => ' :attribute muss zwischen den Minimum :min und Maximum :max Ziffern sein',
    'dimensions'            => ':attribute Bildmaße sind ungültig',
    'distinct'              => 'Im :attribute Feld wurde ein doppelter Welt eingegeben',
    'email'                 => ':attribute muss eine gültige E-Mail Adresse sein',
    'exists'                => 'Das gewählte :attribute ist nicht gültig',
    'file'                  => ':attribute muss in Form einer Datei sein',
    'filled'                => 'Im Feld :attribute muss ein Wert eingegeben werden',
    'image'                 => ':attribute muss ein Bild sein',
    'in'                    => 'Das gewählte :attribute ist nicht gültig',
    'in_array'              => 'Das :attribute Feld ist nicht im Feld andere :other vorhanden',
    'integer'               => ':attribute muss eine Ganzzahl sein',
    'ip'                    => ':attribute muss eine gültige IP-Adresse sein',
    'ipv4'                  => ':attribute muss eine gültige IPv4-Adresse sein',
    'ipv6'                  => ':attribute muss eine gültige IPv6-Adresse sein',
    'json'                  => ':attribute muss ein gültiger JSON-String sein',
    'max'                  =>[
        'numeric'  => ':attribute muss kleiner als :max sein',
        'file'     => ':attribute muss kleiner als :max Kilobyte sein',
        'string'   => ':attribute muss kleiner als :max Zeichen sein',
        'array'    => ':attribute muss kleiner als :max Artikel sein',
    ],
    'mimes'                 => ':attribute muss eine Dateiart :values sein',
    'mimetypes'             => ':attribute muss eine Dateiart :values sein',
    'min'                  =>[
        'numeric'  => ':attribute muss mindestens :min sein',
        'file'     => ':attribute muss mindestens :min Kilobyte haben',
        'string'   => ':attribute muss mindestens :min Zeichen haben',
        'array'    => ':attribute muss mindestens :min Artikel haben',
    ],
    'not_in'                => 'Das gewählte :attribute ist nicht gültig',
    'numeric'               => ':attribute muss eine Zahl sein',
    'present'               => 'Das :attribute Feld muss vorhanden sein',
    'regex'                 => ':attribute Format ist nicht gültig',
    'required'              => ':attribute Feld muss vorhanden sein',
    'required_if'           => 'Da das :attribute Feld zu Sonstiges :other :value gehört ist es notwendig',
    'required_unless'       => 'Das :attribute Feld ist solange gültig, bis Sonstige :other :values bestehen',
    'required_with'         => 'Das :attribute Feld ist notwendig, wenn :values vorhanden sind',
    'required_with_all'     => 'Das :attribute Feld ist notwendig, wenn :values vorhanden sind',
    'required_without'      => 'Das :attribute Geld ist notwendig wenn Sonstige :values vorhanden sind',
    'required_without_all'  => 'Das :attribute Feld ist solange notwendig, solange Sonstige :values vorhanden sind',
    'same'                  => ':attribute und Sonstige :other müssen übereinstimmen',
    'size'                 =>[
        'numeric'  => ':attribute muss ein Maß :size sein',
        'file'     => ':attribute  muss :size Kilobyte sein',
        'string'   => ':attribute  muss :size Zeichen sein',
        'array'    => ':attribute muss :size Artikel enthalten',
    ],
    'string'                => ':attribute muss eine Sequenz sein',
    'timezone'              => ':attribute muss ein gültiger Ort sein',
    'unique'                => ':attribute wurde von jemand anderem genutzt',
    'uploaded'              => ':attribute Hochladen ist fehlgeschlagen',
    'url'                   => ':attribute Format ist nicht gültig',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' =>[
        'attribute-name' =>[
            'rule-name'  => '',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' =>[

        'backend' =>[
            'access' =>[
                'permissions' =>[
                    'associated_roles'  => 'Assoziierte Rollen',
                    'dependencies'      => 'Zugehörigkeiten',
                    'display_name'      => 'Bildschirmname',
                    'group'             => 'Gruppe',
                    'group_sort'        => 'Gruppen-Ranking',

                    'groups' =>[
                        'name'  => 'Gruppenname',
                    ],

                    'name'        => 'Nachname',
                    'first_name'  => 'Name',
                    'last_name'   => 'Nachname',
                    'system'      => 'System',
                ],

                'roles' =>[
                    'associated_permissions'  => '',
                    'name'                    => 'Assoziierte Befugnisse',
                    'sort'                    => 'Nachname',
                ],

                'users' =>[
                    'active'                   => 'Aktiv',
                    'associated_roles'         => 'Assoziierte Rollen',
                    'confirmed'                => 'Verifiziert',
                    'email'                    => 'E-Mail Adresse',
                    'name'                     => 'Nachname',
                    'last_name'                => 'Name',
                    'first_name'               => 'Nachname',
                    'other_permissions'        => 'Andere Befugnisse',
                    'password'                 => 'Passwort',
                    'password_confirmation'    => 'Passwort verifizieren',
                    'send_confirmation_email'  => 'Verifizierungsmail schicken',
                    'timezone'                 => 'Zeitabschnitt',
                    'language'                 => 'Sprache',
                ],
                'brokers' =>[
                    'active'                   => 'Aktiv',
                    'associated_roles'         => 'Assoziierte Rollen',
                    'confirmed'                => 'Verifiziert',
                    'email'                    => 'E-Mail Adresse',
                    'phone_no'                 => 'Telefon',
                    'mobile_no'                => 'Mobiltelefon',
                    'name'                     => 'Nachname',
                    'last_name'                => 'Name',
                    'first_name'               => 'Nachname',
                    'other_permissions'        => 'Andere Befugnisse',
                    'password'                 => 'Passwort',
                    'password_confirmation'    => 'Passwort verifizieren',
                    'send_confirmation_email'  => 'Verifizierungsmail schicken',
                    'timezone'                 => 'Zeitabschnitt',
                    'language'                 => 'Sprache',
                    'city'                 => 'Stadt',
                    'district'                 => 'Bezirk/Stadtkreis',
                    'company_name'             => 'Name der Firma:',
                    'tax_no'                 => 'Steuernummer',
                    'nearest_landmark'      => 'Am nächsten',
                    'default_broker'                 => 'Standard Makler',
                ],
            ],
        ],

        'frontend' =>[
            'avatar'                     => 'Profilbild',
            'email'                      => 'E-Mail Adresse',
            'phone_no'                      => 'Telefon',
            'mobile_no'                      => 'Mobiltelefon',
            'first_name'                 => 'Name',
            'last_name'                  => 'Nachname',
            'name'                       => 'Name Nachname',
            'password'                   => 'Passwort',
            'password_confirmation'      => 'Passwort verifizieren',
            'phone'                      => 'Telefon',
            'message'                    => 'Nachricht',
            'new_password'               => 'Neues Passwort',
            'new_password_confirmation'  => 'Neues Passwort verifizieren',
            'old_password'               => 'Altes Passwort',
            'timezone'                   => 'Zeitabschnitt',
            'language'                   => 'Sprache',
            'contract'                   => 'Vertragsdatei',
            'contract_confirmed'                   => 'Bestätigter Vertrag',
            'contract_file'                   => 'Vertragsdatei',
            'broker_id'                   => 'Makler-Registrierungsnummer',
            'broker_name'                   => 'Name des Maklers',
            'surename'                   => 'Nachname des Maklers',
        ],

        'captcha' => 'Verifizierungscode',
    ],
];
