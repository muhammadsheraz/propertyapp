<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' =>[
        'all'      => 'Alle',
        'yes'      => 'Ja',
        'no'       => 'Nein',
        'copyright'  => 'Urheberrecht',
        'custom'   => 'Personalisiert',
        'actions'  => 'Aktionen',
        'active'   => 'Aktiv',
        'canceled'   => 'Storniert',
        'completed'   => 'Fertig',
        'buttons' =>[
            'close'    => 'Schließen',
            'save'    => 'Speichern',
            'update'  => 'Aktualisieren',
        ],
        'hide'               => 'Verstecken',
        'inactive'           => 'Passiv',
        'none'               => 'Nicht vorhanden, keine',
        'show'               => 'Zeigen',
        'view_property'  => 'Immobilie zeigen',
        'commission_sale'  => 'Provisionsrate für Verkauf',
        'commission_rent'  => 'Provisionsrate für Vermietung',
        'commission_from_landlord'  => 'Vom Eigentümer',
        'commission_from_buyer'  => 'Vom Kunden',
        'commission_from_tenant'  => 'Vom Mieter',
        'property_type'  => 'Immobilienart',
        'rooms'  => 'Zimmeranzahl',
        'price'  => 'Preis',
        'search'  => 'Suchen',
        'property_purpose'  => 'Zwecke',
        'property_limit'  => 'Grenze',
    ],

    'location' =>[
        'city'      => 'Stadt',
        'district'      => 'Bezirk/Stadtkreis',
    ],

    'properties' =>[
        'management'      => 'Anzeigenmanagement',
        'create'      => 'Anzeige erstellen',
        'view'      => 'Anzeige ansehen',
    ],

    'backend' =>[
        'access' =>[
            'roles' =>[
                'create'      => 'Rolle erstellen' ,
                'edit'        => 'Rolle definieren',
                'management'  => 'Rollenmanagement',

                'table' =>[
                    'number_of_users'  => 'Anzahl der Nutzer',
                    'permissions'      => 'Befugnisse',
                    'role'             => 'Rolle',
                    'sort'             => 'Aufreihen',
                    'total'            => 'Gesamtanzahl der Rollen',
                ],
            ],

            'users' =>[
                'active'               => 'Aktive Nutzer',
                'all_permissions'      => 'Alle Rollen',
                'change_password'      => 'Passwort ändern',
                'change_password_for'  => 'Passwort ändern für :user Nutzer',
                'create'               => 'Benutzerkonto erstellen',
                'deactivated'          => 'Deaktivierte Nutzer',
                'deleted'              => 'Gelöschte Nutzer',
                'edit'                 => 'Nutzerinformationen bearbeiten',
                'management'           => 'Nutzermanagement',
                'no_permissions'       => 'Nicht erlaubt',
                'no_roles'             => 'Keine einzustellende Rolle',
                'permissions'          => 'Befugnisse',

                'table' =>[
                    'confirmed'       => 'Verifiziert',
                    'created'         => 'Erstellt',
                    'email'           => 'E-Mail',
                    'id'              => 'Registrierungsnummer',
                    'last_updated'    => 'Letzte Aktualisierung',
                    'name'            => 'Nachname',
                    'first_name'      => 'Name',
                    'last_name'       => 'Nachname',
                    'no_deactivated'  => 'Keine deaktivierten Nutzer',
                    'no_deleted'      => 'Keine gelöschten Nutzer',
                    'other_permissions'  => 'Andere Befugnisse',
                    'permissions'  => 'Befugnisse',
                    'social'  => 'Sozial',
                    'total'           => 'Anzahl der Nutzer',
                ],

                'tabs' =>[
                    'titles' =>[
                        'overview'  => 'Ansicht',
                        'history'   => 'Verlauf',
                    ],

                    'content' =>[
                        'overview' =>[
                            'avatar'        => 'Profilbild',
                            'confirmed'     => 'Verifiziert',
                            'created_at'    => 'Erstellt',
                            'deleted_at'    => 'Gelöscht',
                            'email'         => 'E-Mail Adresse',
                            'last_updated'  => 'Letzte Aktualisierung',
                            'name'          => 'Nachname',
                            'first_name'    => 'Name',
                            'last_name'     => 'Nachname',
                            'status'        => 'Status',
                        ],
                    ],
                ],

                'view'  => 'Nutzerinformationen ansehen',
            ],

            'brokers' =>[
                'active'               => 'Aktive Makler',
                'all_permissions'      => 'Alle Befugnisse',
                'change_password'      => 'Passwort ändern',
                'change_password_for'  => 'Passwort ändern für :user Nutzer',
                'create'               => 'Maklerkonto erstellen',
                'deactivated'          => 'Deaktivierte Makler',
                'deleted'              => 'Gelöschte Makler',
                'edit'                 => 'Nutzerinformationen bearbeiten',
                'management'           => 'Maklermanagement',
                'no_permissions'       => 'Nicht erlaubt',
                'no_roles'             => 'Keine einzustellende Rolle',
                'permissions'          => 'Befugnisse',

                'table' =>[
                    'confirmed'       => 'Verifiziert',
                    'created'         => 'Erstellt',
                    'email'           => 'E-Mail Adresse',
                    'id'              => 'Registrierungsnummer',
                    'last_updated'    => 'Letzte Aktualisierung',
                    'name'            => 'Nachname',
                    'first_name'      => 'Name',
                    'properties'  => 'Immobilien',
                    'last_name'       => 'Nachname',
                    'no_deactivated'  => 'Deaktivierte Makler',
                    'no_deleted'      => 'Gelöschte Makler',
                    'other_permissions'  => 'Andere Befugnisse',
                    'permissions'  => 'Befugnisse',
                    'roles'           => 'Rollen' ,
                    'social'  => 'Sozial',
                    'total'           => 'Gesamtanzahl der Nutzer | Gesamtanzahl der Makler',
                    'broker_no'           => 'Makler-Registrierungsnummer',
                    'customer_no'           => 'Nutzer-Registrierungsnummer',
                    'profile_photo'           => 'Profilbild',
                    'change_profile_photo'           => 'Profilbild ändern',
                ],

                'tabs' =>[
                    'titles' =>[
                        'overview'  => 'Ansicht',
                        'history'   => 'Verlauf',
                    ],

                    'content' =>[
                        'overview' =>[
                            'avatar'        => 'Profilbild',
                            'confirmed'     => 'Verifiziert',
                            'created_at'    => 'Erstellt',
                            'deleted_at'    => 'Gelöscht',
                            'email'         => 'E-Mail Adresse',
                            'last_updated'  => 'Letzte Aktualisierung',
                            'name'          => 'Nachname',
                            'first_name'    => 'Name',
                            'last_name'     => 'Nachname',
                            'status'        => 'Status',
                        ],
                    ],
                ],

                'view'  => 'Makler ansehen',
            ],

            'customers' =>[
                'active'               => 'Aktive Nutzer',
                'all_permissions'      => 'Befugnisse',
                'change_password'      => 'Passwort ändern',
                'change_password_for'  => 'Passwort ändern für :user Nutzer',
                'create'               => 'Makler erstellen',
                'deactivated'          => 'Deaktivierte Nutzer',
                'deleted'              => 'Gelöschte Nutzer',
                'edit'                 => 'Nutzerkonto bearbeiten',
                'management'           => 'Nutzerkontomanagement',
                'no_permissions'       => 'Nicht erlaubt',
                'no_roles'             => 'Keine einzustellende Rolle',
                'permissions'          => 'Befugnisse',

                'table' =>[
                    'confirmed'       => 'Verifiziert',
                    'created'         => 'Erstellt',
                    'email'           => 'E-Mail Adresse',
                    'id'              => 'Registrierungsnummer',
                    'last_updated'    => 'Letzte Aktualisierung',
                    'name'            => 'Nachname',
                    'first_name'      => 'Name',
                    'properties'  => 'Anzeigen',
                    'last_name'       => 'Nachname',
                    'no_deactivated'  => 'Deaktivierte Nutzer',
                    'no_deleted'      => 'Gelöschte Nutzer',
                    'other_permissions'  => 'Andere Befugnisse',
                    'permissions'  => 'Befugnisse',
                    'roles'           => 'Rollen',
                    'social'  => 'Sozial',
                    'total'           => 'Gesamtzahl der Nutzer',
                    'broker_no'           => 'Makler-Registrierungsnummer',
                    'customer_no'           => 'Nutzer-Registrierungsnummer',
                    'profile_photo'           => 'Profilbild',
                    'change_profile_photo'           => 'Profilbild ändern',
                ],

                'tabs' =>[
                    'titles' =>[
                        'overview'  => 'Ansicht',
                        'history'   => 'Verlauf',
                    ],

                    'content' =>[
                        'overview' =>[
                            'avatar'        => 'Profilbild',
                            'confirmed'     => 'Verifiziert',
                            'created_at'    => 'Erstellt',
                            'deleted_at'    => 'Gelöscht',
                            'email'         => 'E-Mail Adresse',
                            'last_updated'  => 'Letzte Aktualisierung',
                            'name'          => 'Nachname',
                            'first_name'    => 'Name',
                            'last_name'     => 'Nachname',
                            'status'        => 'Status',
                        ],
                    ],
                ],

                'view'  => 'Maklerkonto ansehen',
            ],
        ],
    ],

    'frontend' =>[

        'auth' =>[
            'login_box_title'     => 'Einloggen',
            'login_button'        => 'Einloggen',
            'download_contract'        => 'Autoritätszertifikat herunterladen',
            'login_with'          => 'Mit einem sozialen Medienkonto anmelden',
            'register_box_title'  => 'Anmelden',
            'register_button'     => 'Anmelden',
            'remember_me'         => 'An mich erinnern',
        ],

        'contact' =>[
            'box_title'  => 'Kontaktieren Sie uns',
            'button'  => 'Senden',
        ],

        'passwords' =>[
            'expired_password_box_title'  => 'Die Nutzungsdauer Ihres Passworts ist abgelaufen',
            'forgot_password'                  => 'Haben Sie Ihr Passwort vergessen?',
            'reset_password_box_title'         => 'Passwort zurücksetzen',
            'reset_password_button'            => 'Passwort zurücksetzen',
            'update_password_button'            => 'Passwort aktualisieren',
            'send_password_reset_link_button'  => 'E-Mail zum Zurücksetzen des Passworts schicken',
        ],

        'user' =>[
            'passwords' =>[
                'change'  => 'Mein Passwort ändern',
            ],

            'profile' =>[
                'avatar'              => 'Profilbild',
                'created_at'          => 'Erstellt',
                'edit_information'    => 'Meine Informationen bearbeiten',
                'email'               => 'E-Mail Adresse',
                'last_updated'        => 'Letzte Aktualisierung',
                'name'                => 'Nachname',
                'first_name'          => 'Name',
                'last_name'           => 'Nachname',
                'update_information'  => 'Meine Informationen aktualisieren',
            ],
        ],

    ],
];
