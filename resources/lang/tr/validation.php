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

    'accepted'              => ':attribute kabul edilmeli',
    'active_url'            => ':attribute geçerli bir URL değil',
    'after'                 => ':attribute tarihi :date tarihinden sonra olmalıdır',
    'after_or_equal'        => ':attribute tarihi :date tarihinden önce veya aynı gün olmalıdır',
    'alpha'                 => ':attribute sadece harflerden oluşmalıdır',
    'alpha_dash'            => ':attribute  harflerden, numaralardan ve boşluklardan oluşabilir',
    'alpha_num'             => ':attribute harflerden ve numaralardan oluşabilir',
    'array'                 => ':attribute bir diziden oluşabilir',
    'before'                => ':attribute , :date tarihinden önce olmalıdır',
    'before_or_equal'       => ':attribute , :date tarihinden önce veya aynı gün olmalıdır',
    'between'              =>[
        'numeric'  => ':attribute , minimum :min ve maksimum :max arasında olmalıdır',
        'file'     => ':attribute , minimum :min ve maksimum :max kilobayt arasında olmalıdır',
        'string'   => ':attribute , minimum :min ve maksimum :max karakterler arasında olmalıdır',
        'array'    => ':attribute , minimum :min ve maksimum :max madde arasında olmalıdır',
    ],
    'boolean'               => ':attribute alanı doğru veya yanlış olmalıdır',
    'confirmed'             => ':attribute doğrulama eşleşmiyor',
    'date'                  => ':attribute geçerli bir tarih değil',
    'date_format'           => ':attribute, :format formata uymuyor',
    'different'             => ':attribute ve diğeri :other farklı olmalıdır',
    'digits'                => ':attribute rakamlardan oluşmalıdır',
    'digits_between'        => ' :attribute minimum :min ve maksimum :max rakamları arasında olmalıdır',
    'dimensions'            => ':attribute resim boyutları geçersiz',
    'distinct'              => ':attribute alanına çifte değer girilmiş',
    'email'                 => ':attribute geçerli bir email adresi olmalıdır',
    'exists'                => 'Seçilen :attribute geçerli değil',
    'file'                  => ':attribute dosya halinde olmalıdır',
    'filled'                => ':attribute alanına bir değer girilmelidir',
    'image'                 => ':attribute bir resim olmalıdır',
    'in'                    => 'Seçilen :attribute geçerli değil',
    'in_array'              => ':attribute alanı diğer :other alanda yer almıyor',
    'integer'               => ':attribute bir tam sayı olmalıdır',
    'ip'                    => ':attribute geçerli bir IP adresi olmalıdır',
    'ipv4'                  => ':attribute geçerli bir IPv4 adresi olmalıdır',
    'ipv6'                  => ':attribute geçerli bir IPv6 adresi olmalıdır',
    'json'                  => ':attribute geçerli bir JSON String olmalıdır',
    'max'                  =>[
        'numeric'  => ':attribute :max küçük olmalıdır',
        'file'     => ':attribute :max kilobayttan küçük olmalıdır',
        'string'   => ':attribute :max karakterden küçük olmalıdır',
        'array'    => ':attribute :max maddeden küçük olmalıdır',
    ],
    'mimes'                 => ':attribute bir dosya türü :values olmalıdır',
    'mimetypes'             => ':attribute bir dosya türü :values olmalıdır',
    'min'                  =>[
        'numeric'  => ':attribute en azından :min olmalıdır',
        'file'     => ':attribute en azından :min kilobayt olmalıdır',
        'string'   => ':attribute en azından :min karakter olmalıdır',
        'array'    => ':attribute en azından :min madde olmalıdır',
    ],
    'not_in'                => 'Seçilen :attribute geçerli değil',
    'numeric'               => ':attribute bir sayı olmalıdır',
    'present'               => ':attribute alanı mevcut olmalıdır',
    'regex'                 => ':attribute formatı geçerli değil',
    'required'              => ':attribute alanı olması gerekiyor',
    'required_if'           => ':attribute alanı, diğer :other :value olduğunda gereklidir',
    'required_unless'       => ':attribute alanı, diğer :other :values olana kadar gereklidir',
    'required_with'         => ':attribute alanı, diğer :values mevcut olduğunda gereklidir',
    'required_with_all'     => ':attribute alanı, diğer :values mevcut olduğunda gereklidir',
    'required_without'      => ':attribute alanı, diğer :values mevcut olmadığında gereklidir',
    'required_without_all'  => ':attribute alanı, diğer :values mevcut olana kadar gereklidir',
    'same'                  => ':attribute ve diğeri :other uyuşmalıdır',
    'size'                 =>[
        'numeric'  => ':attribute bir ölçü :size olmalıdır',
        'file'     => ':attribute  :size kilobayt  olmalıdır',
        'string'   => ':attribute  :size karakter olmalıdır',
        'array'    => ':attribute :size madde içermelidir',
    ],
    'string'                => ':attribute bir dizi olmalıdır',
    'timezone'              => ':attribute geçerli bir bölge olmalıdır',
    'unique'                => ':attribute başkası tarafından alındı',
    'uploaded'              => ':attribute yükleme başarısız oldu',
    'url'                   => ':attribute formatı geçerli değil',

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
                    'associated_roles'  => 'İlişkilendirilmiş Roller',
                    'dependencies'      => 'Bağımlılıklar',
                    'display_name'      => 'Ekran Adı',
                    'group'             => 'Grup',
                    'group_sort'        => 'Grup Sıralaması',

                    'groups' =>[
                        'name'  => 'Grup Adı',
                    ],

                    'name'        => 'Soyad',
                    'first_name'  => 'Ad',
                    'last_name'   => 'Soyad',
                    'system'      => 'Sistem',
                ],

                'roles' =>[
                    'associated_permissions'  => '',
                    'name'                    => 'İlişkilendirilmiş İzinler',
                    'sort'                    => 'Soyad',
                ],

                'users' =>[
                    'active'                   => 'Etkin',
                    'associated_roles'         => 'İlişkilendirilmiş Roller',
                    'confirmed'                => 'Doğrulandı',
                    'email'                    => 'Email adresi',
                    'name'                     => 'Soyad',
                    'last_name'                => 'Ad',
                    'first_name'               => 'Soyad',
                    'other_permissions'        => 'Diğer İzinler',
                    'password'                 => 'Şifre',
                    'password_confirmation'    => 'Şifre Doğrulaması',
                    'send_confirmation_email'  => 'Onay emaili gönder',
                    'timezone'                 => 'Zaman Dilimi',
                    'language'                 => 'Dil',
                ],
                'brokers' =>[
                    'active'                   => 'Etkin',
                    'associated_roles'         => 'İlişkilendirilmiş Roller',
                    'confirmed'                => 'Doğrulandı',
                    'email'                    => 'Email adresi',
                    'phone_no'                 => 'Telefon',
                    'mobile_no'                => 'Cep Telefonu',
                    'name'                     => 'Soyad',
                    'last_name'                => 'Ad',
                    'first_name'               => 'Soyad',
                    'other_permissions'        => 'Diğer İzinler',
                    'password'                 => 'Şifre',
                    'password_confirmation'    => 'Şifre Doğrulaması',
                    'send_confirmation_email'  => 'Onay emaili gönder',
                    'timezone'                 => 'Zaman Dilimi',
                    'language'                 => 'Dil',
                    'city'                 => 'Şehir',
                    'district'                 => 'Bölge/Semt',
                    'company_name'                 => 'Şirket Adı:',
                    'tax_no'                 => 'Vergi Numarası',
                    'nearest_landmark'                 => 'En Yakınında',
                    'default_broker'                 => 'Varsayılan Komisyoncu',
                ],
            ],
        ],

        'frontend' =>[
            'avatar'                     => 'Profil Resmi',
            'email'                      => 'Email Adresi',
            'phone_no'                      => 'Telefon',
            'mobile_no'                      => 'Cep Telefonu',
            'first_name'                 => 'Ad',
            'last_name'                  => 'Soyad',
            'name'                       => 'Adı Soyadı',
            'password'                   => 'Şifre',
            'password_confirmation'      => 'Şifre Doğrulaması',
            'phone'                      => 'Telefon',
            'message'                    => 'Mesaj',
            'new_password'               => 'Yeni Şifre',
            'new_password_confirmation'  => 'Yeni Şifre Doğrulaması',
            'old_password'               => 'Eski Şifre',
            'timezone'                   => 'Zaman Dilimi',
            'language'                   => 'Dil',
            'contract'                   => 'Sözleşme Dosyası',
            'contract_confirmed'                   => 'Onaylanan Sözleşme',
            'contract_file'                   => 'Sözleşme Dosyası',
            'broker_id'                   => 'Emlakçı Kayıt No',
            'broker_name'                   => 'Emlakçının Adı',
            'surename'                   => 'Emlakçının Soyadı',
        ],

        'captcha' => 'Doğrulama Kodu',
    ],
];
