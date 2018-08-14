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
        'all'      => 'Hepsi',
        'yes'      => 'Evet',
        'no'       => 'Hayır',
        'copyright'  => 'Telif Hakkı',
        'custom'   => 'Kişiye Özel',
        'actions'  => 'Eylemler',
        'active'   => 'Etkin',
        'canceled'   => 'İptal edildi',
        'completed'   => 'Tamamlandı',
        'buttons' =>[
            'close'    => 'Kapat',
            'save'    => 'Kayıt et',
            'update'  => 'Güncelle',
        ],
        'hide'               => 'Gizle',
        'inactive'           => 'Etkisiz',
        'none'               => 'Yok, hiç',
        'show'               => 'Göster',
        'view_property'  => 'Gayrimenkulü göster',
        'commission_sale'  => 'Satılık için komisyon oranı',
        'commission_rent'  => 'Kiralık için komisyon oranı',
        'commission_from_landlord'  => 'Mal sahibinden',
        'commission_from_buyer'  => 'Müşteriden',
        'commission_from_tenant'  => 'Kiracıdan',
        'property_type'  => 'Türü',
        'rooms'  => 'Oda',
        'price'  => 'Fiyat',
        'search'  => 'Ara',
        'property_purpose'  => 'Amaç',
        'property_limit'  => 'Sınır',
    ],

    'location' =>[
        'city'      => 'Şehir',
        'district'      => 'Bölge/Semt',
    ],

    'properties' =>[
        'management'      => 'İlan Yönetimi',
        'create'      => 'İlan Oluştur',
        'view'      => 'İlana gözat',
    ],

    'backend' =>[
        'access' =>[
            'roles' =>[
                'create'      => 'Rol Oluştur',
                'edit'        => 'Rolü tanımla',
                'management'  => 'Rol Yönetimi',

                'table' =>[
                    'number_of_users'  => 'Kullanıcı sayısı',
                    'permissions'      => 'İzinler',
                    'role'             => 'Rol',
                    'sort'             => 'Sırala',
                    'total'            => 'Rol Toplamı',
                ],
            ],

            'users' =>[
                'active'               => 'Etkin Kullanıcılar',
                'all_permissions'      => 'Bütün Roller',
                'change_password'      => 'Şifre Değiştir',
                'change_password_for'  => ':user kullanıcısı için şifre değişimi',
                'create'               => 'Kullanıcı Hesabı Oluştur',
                'deactivated'          => 'Etkisizleştirilmiş Kullanıcılar',
                'deleted'              => 'Silinmiş Kullanıcılar',
                'edit'                 => 'Kullanıcı Bilgilerini Düzenle',
                'management'           => 'Kullanıcı Yönetimi',
                'no_permissions'       => 'İzin Verilmiyor',
                'no_roles'             => 'Ayarlanacak rol yok',
                'permissions'          => 'İzinler',

                'table' =>[
                    'confirmed'       => 'Doğrulandı',
                    'created'         => 'Oluşturuldu',
                    'email'           => 'Email',
                    'id'              => 'Kayıt No',
                    'last_updated'    => 'Son Güncelleme',
                    'name'            => 'Soyad',
                    'first_name'      => 'Ad',
                    'last_name'       => 'Soyad',
                    'no_deactivated'  => 'Etkisizleştirilmiş Kullanıcı Yok',
                    'no_deleted'      => 'Silinmiş Kullanıcı Yok',
                    'other_permissions'  => 'Diğer İzinler',
                    'permissions'  => 'İzinler',
                    'social'  => 'Sosyal',
                    'total'           => 'Kullanıcı Sayısı',
                ],

                'tabs' =>[
                    'titles' =>[
                        'overview'  => 'Bakış',
                        'history'   => 'Geçmiş',
                    ],

                    'content' =>[
                        'overview' =>[
                            'avatar'        => 'Profil Resmi',
                            'confirmed'     => 'Doğrulandı',
                            'created_at'    => 'Oluşturuldu',
                            'deleted_at'    => 'Silindi',
                            'email'         => 'Email Adresi',
                            'last_updated'  => 'Son Güncelleme',
                            'name'          => 'Soyad',
                            'first_name'    => 'Ad',
                            'last_name'     => 'Soyad',
                            'status'        => 'Durum',
                        ],
                    ],
                ],

                'view'  => 'Kullanıcı Bilgilerine Gözat',
            ],

            'brokers' =>[
                'active'               => 'Etkin Emlakçılar',
                'all_permissions'      => 'Bütün İzinler',
                'change_password'      => 'Şifre Değiştir',
                'change_password_for'  => ':user kullanıcısı için şifre değişimi',
                'create'               => 'Emlakçı Hesabı Oluştur',
                'deactivated'          => 'Etkisizleştirilen Emlakçılar',
                'deleted'              => 'Silinen Emlakçılar',
                'edit'                 => 'Kullanıcı Bilgilerini Düzenle',
                'management'           => 'Emlakçı Yönetimi',
                'no_permissions'       => 'İzin Verilmiyor',
                'no_roles'             => 'Ayarlanacak rol yok',
                'permissions'          => 'İzinler',

                'table' =>[
                    'confirmed'       => 'Doğrulandı',
                    'created'         => 'Oluşturuldu',
                    'email'           => 'Email Adresi',
                    'id'              => 'Kayıt No',
                    'last_updated'    => 'Son Güncelleme',
                    'name'            => 'Soyad',
                    'first_name'      => 'Ad',
                    'properties'  => 'Gayrimenkuller',
                    'last_name'       => 'Soyad',
                    'no_deactivated'  => 'Etkisizleştirilen Emlakçılar',
                    'no_deleted'      => 'Silinen Emlakçılar',
                    'other_permissions'  => 'Diğer İzinler',
                    'permissions'  => 'İzinler',
                    'roles'           => 'Roller',
                    'social'  => 'Sosyal',
                    'total'           => 'Toplam Kullanıcı | Toplam Emlakçı',
                    'broker_no'           => 'Emlakçı Kayıt No',
                    'customer_no'           => 'Kullanıcı Kayıt No',
                    'profile_photo'           => 'Profil Resmi',
                    'change_profile_photo'           => 'Profil Resmini Değiştir',
                ],

                'tabs' =>[
                    'titles' =>[
                        'overview'  => 'Bakış',
                        'history'   => 'Geçmiş',
                    ],

                    'content' =>[
                        'overview' =>[
                            'avatar'        => 'Profil Resmi',
                            'confirmed'     => 'Doğrulandı',
                            'created_at'    => 'Oluşturuldu',
                            'deleted_at'    => 'Silindi',
                            'email'         => 'Email Adresi',
                            'last_updated'  => 'Son Güncelleme',
                            'name'          => 'Soyad',
                            'first_name'    => 'Ad',
                            'last_name'     => 'Soyad',
                            'status'        => 'Durum',
                        ],
                    ],
                ],

                'view'  => 'Emlakçıya Gözat',
            ],

            'customers' =>[
                'active'               => 'Etkin Kullanıcılar',
                'all_permissions'      => 'İzinler',
                'change_password'      => 'Şifre Değiştir',
                'change_password_for'  => ':user kullanıcısı için şifre değişimi',
                'create'               => 'Emlakçı Oluştur',
                'deactivated'          => 'Etkisizleştirilen Kullanıcılar',
                'deleted'              => 'Silinen Kullanıcılar',
                'edit'                 => 'Kullanıcı Hesabını Düzenle',
                'management'           => 'Kullanıcı Hesabı Yönetimi',
                'no_permissions'       => 'İzin Verilmiyor',
                'no_roles'             => 'Ayarlanacak rol yok',
                'permissions'          => 'İzinler',

                'table' =>[
                    'confirmed'       => 'Doğrulandı',
                    'created'         => 'Oluşturuldu',
                    'email'           => 'Email Adresi',
                    'id'              => 'Kayıt No',
                    'last_updated'    => 'Son Güncelleme',
                    'name'            => 'Soyad',
                    'first_name'      => 'Ad',
                    'properties'  => 'İlanlar',
                    'last_name'       => 'Soyad',
                    'no_deactivated'  => 'Etkisizleştirilen Kullanıcılar',
                    'no_deleted'      => 'Silinen Kullanıcılar',
                    'other_permissions'  => 'Diğer İzinler',
                    'permissions'  => 'İzinler',
                    'roles'           => 'Roller',
                    'social'  => 'Sosyal',
                    'total'           => 'Kullanıcı Toplamı',
                    'broker_no'           => 'Emlakçı Kayıt No',
                    'customer_no'           => 'Kullanıcı Kayıt No',
                    'profile_photo'           => 'Profil Resmi',
                    'change_profile_photo'           => 'Profil Resmini Değiştir',
                ],

                'tabs' =>[
                    'titles' =>[
                        'overview'  => 'Bakış',
                        'history'   => 'Geçmiş',
                    ],

                    'content' =>[
                        'overview' =>[
                            'avatar'        => 'Profil Resmi',
                            'confirmed'     => 'Doğrulandı',
                            'created_at'    => 'Oluşturuldu',
                            'deleted_at'    => 'Silindi',
                            'email'         => 'Email Adresi',
                            'last_updated'  => 'Son Güncelleme',
                            'name'          => 'Soyad',
                            'first_name'    => 'Ad',
                            'last_name'     => 'Soyad',
                            'status'        => 'Durum',
                        ],
                    ],
                ],

                'view'  => 'Emlakçı Hesabına Gözat',
            ],
        ],
    ],

    'frontend' =>[

        'auth' =>[
            'login_box_title'     => 'Giriş',
            'login_button'        => 'Giriş',
            'download_contract'        => 'Yetki Belgesini İndir',
            'login_with'          => 'Sosyal Medya Hesabıyla Giriş',
            'register_box_title'  => 'Kayıt Ol',
            'register_button'     => 'Kayıt Ol',
            'remember_me'         => 'Beni Hatırla',
        ],

        'contact' =>[
            'box_title'  => 'Bize Ulaşın',
            'button'  => 'Gönder',
        ],

        'passwords' =>[
            'expired_password_box_title'  => 'Şifrenizin kullanım süresi doldu',
            'forgot_password'                  => 'Şifrenizi Unuttunuz mu?',
            'reset_password_box_title'         => 'Şifremi Sıfırla',
            'reset_password_button'            => 'Şifremi Sıfırla',
            'update_password_button'            => 'Şifremi Güncelle',
            'send_password_reset_link_button'  => 'Şifre sıfırlama emaili gönder',
        ],

        'user' =>[
            'passwords' =>[
                'change'  => 'Şifremi Değiştir',
            ],

            'profile' =>[
                'avatar'              => 'Profil Resmi',
                'created_at'          => 'Oluşturuldu',
                'edit_information'    => 'Bilgilerimi Düzenle',
                'email'               => 'Email Adresi',
                'last_updated'        => 'Son Güncelleme',
                'name'                => 'Soyad',
                'first_name'          => 'Ad',
                'last_name'           => 'Soyad',
                'update_information'  => 'Bilgilerimi Güncelle',
            ],
        ],

    ],
];
