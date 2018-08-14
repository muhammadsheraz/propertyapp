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

    'accepted'              => ':attribute должен соответствовать',
    'active_url'            => ':attribute не допустимый URL',
    'after'                 => 'дата :attribute должна быть до или после даты :date',
    'after_or_equal'        => 'дата :attribute должна быть до или соответствовать дате :date',
    'alpha'                 => ':attribute может состоять только из букв',
    'alpha_dash'            => ':attribute может состоять из букв, цифр и пробелов',
    'alpha_num'             => ':attribute может состоять из букв и цифр',
    'array'                 => ':attribute может состоять из последовательных символов',
    'before'                => ':attribute , должен быть до даты :date',
    'before_or_equal'       => ':attribute должна быть до или соответствовать дате :date',
    'between'              =>[
        'numeric'  => ':attribute , должен быть минимум от :min и максимум до :max',
        'file'     => ':attribute , должен быть минимум от :min и максимум до :max килобайт',
        'string'   => ':attribute , должен быть минимум от :min и максимум до :max символов',
        'array'    => ':attribute , должен быть минимум от :min и максимум до :max пунктов',
    ],
    'boolean'               => 'поле :attribute должно быть верным или ложным ',
    'confirmed'             => ':attribute не соответствует проверке',
    'date'                  => ':attribute не является допустимой датой',
    'date_format'           => ': attribute не соответствует формату : format',
    'different'             => ':attribute и :other должны отличаться',
    'digits'                => ':attribute должен состоять из цифр',
    'digits_between'        => ':attribute , должен быть минимум от :min и максимум до :max',
    'dimensions'            => 'параметры :attribute изображения недействительны',
    'distinct'              => 'в поле :attribute было введено двойное значение',
    'email'                 => ':attribute должен быть действительным адресом электронной почты',
    'exists'                => 'Выбранный :attribute недействителен',
    'file'                  => ':attribute должен быть в файле',
    'filled'                => 'В поле :attribute должно быть введено значение',
    'image'                 => ':attribute должен быть изображением',
    'in'                    => 'Выбранный :attribute недействителен',
    'in_array'              => 'Поле :attribute не располагается в другом :other поле',
    'integer'               => ':attribute должен быть целым числом',
    'ip'                    => ':attribute должен быть действительным IP-адресом',
    'ipv4'                  => ':attribute должен быть действительным адресом IPv4 ',
    'ipv6'                  => ':attribute должен быть действительным адресом IPv6 ',
    'json'                  => ':attribute должен быть действительным JSON String',
    'max'                  =>[
        'numeric'  => ':attribute , должен быть меньше :min',
        'file'     => ':attribute , должен быть меньше :min килобайт',
        'string'   => ':attribute , должен быть меньше :min символов',
        'array'    => ':attribute , должен быть меньше :min пунктов',
    ],
    'mimes'                 => ':attribute должен быть типом файла :values',
    'mimetypes'             => ':attribute должен быть типом файла :values',
    'min'                  =>[
        'numeric'  => ':attribute , должен быть минимум :min',
        'file'     => ':attribute , должен быть минимум от :min килобайт',
        'string'   => ':attribute , должен быть минимум от :min символов',
        'array'    => ':attribute , должен быть минимум от :min пунктов',
    ],
    'not_in'                => 'Выбранный :attribute недействителен',
    'numeric'               => ':attribute должен быть числом',
    'present'               => 'Обязательно наличие поля :attribute',
    'regex'                 => 'Формат :attribute недействителен ',
    'required'              => 'Обязательно должно быть поле :attribute',
    'required_if'           => 'Поле :attribute требуется при наличии других значений diğer :other :valuer',
    'required_unless'       => 'Поле :attribute требуется до других значений diğer :other :valuer',
    'required_with'         => 'Поле :attribute требуется при наличии других значений diğer :other :valuer',
    'required_with_all'     => 'Поле :attribute требуется при наличии других значений diğer :other :valuer',
    'required_without'      => 'Поле :attribute требуется при наличии других значений diğer :other :valuer',
    'required_without_all'  => 'Поле :attribute требуется до существующих значений diğer :other :valuer',
    'same'                  => ':attribute и :other должны совпадать',
    'size'                 =>[
        'numeric'  => ':attribute должен иметь размер :size',
        'file'     => ':attribute должен быть :size килобайт',
        'string'   => ':attribute должен быть :size символов',
        'array'    => ' :attribute должен быть :size пунктов',
    ],
    'string'                => ':attribute должен быть массивом',
    'timezone'              => ':attribute должен быть допустимым регионом',
    'unique'                => ':attribute занят другим пользователем',
    'uploaded'              => 'неудачная попытка загрузки :attribute',
    'url'                   => 'Формат :attribute недействителен',

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
                    'associated_roles'  => 'Связанные роли',
                    'dependencies'      => 'Взаимосвязь',
                    'display_name'      => 'Название экрана',
                    'group'             => 'Группа',
                    'group_sort'        => 'Групповая сортировка',

                    'groups' =>[
                        'name'  => 'Название группы',
                    ],

                    'name'        => 'Фамилия',
                    'first_name'  => 'Название',
                    'last_name'   => 'Фамилия',
                    'system'      => 'Система',
                ],

                'roles' =>[
                    'associated_permissions'  => '',
                    'name'                    => 'Связанные разрешения',
                    'sort'                    => 'Фамилия',
                ],

                'users' =>[
                    'active'                   => 'Активный',
                    'associated_roles'         => 'Связанные роли',
                    'confirmed'                => 'Подтверждено',
                    'email'                    => 'Адрес электронной почты',
                    'name'                     => 'Фамилия',
                    'last_name'                => 'Название',
                    'first_name'               => 'Фамилия',
                    'other_permissions'        => 'Прочие разрешения',
                    'password'                 => 'Пароль',
                    'password_confirmation'    => 'Подтверждение пароля',
                    'send_confirmation_email'  => 'Отправить подтверждение по электронной почте',
                    'timezone'                 => 'Часовой пояс',
                    'language'                 => 'Язык',
                ],
                'brokers' =>[
                    'active'                   => 'Активный',
                    'associated_roles'         => 'Связанные роли',
                    'confirmed'                => 'Подтверждено',
                    'email'                    => 'Адрес электронной почты',
                    'phone_no'                 => 'Телефон',
                    'mobile_no'                => 'Мобильный телефон',
                    'name'                     => 'Фамилия',
                    'last_name'                => 'Название',
                    'first_name'               => 'Фамилия',
                    'other_permissions'        => 'Прочие разрешения',
                    'password'                 => 'Пароль',
                    'password_confirmation'    => 'Подтверждение пароля',
                    'send_confirmation_email'  => 'Отправить подтверждение по электронной почте',
                    'timezone'                 => 'Часовой пояс',
                    'language'                 => 'Язык',
                    'city'                 => 'Город',
                    'district'                 => 'Область/Район ',
                    'company_name'                 => 'Название компании:',
                    'tax_no'                 => 'Налоговый номер ',
                    'nearest_landmark'                 => 'Ближайшие',
                    'default_broker'                 => 'Брокер По Умолчанию',
                ],
            ],
        ],

        'frontend' =>[
            'avatar'                     => 'Изображение профиля',
            'email'                      => 'Адрес электронной почты',
            'phone_no'                      => 'Телефон',
            'mobile_no'                      => 'Мобильный телефон',
            'first_name'                 => 'Название',
            'last_name'                  => 'Фамилия',
            'name'                       => 'Имя Фамилия',
            'password'                   => 'Пароль',
            'password_confirmation'      => 'Подтверждение пароля',
            'phone'                      => 'Телефон',
            'message'                    => 'Сообщение',
            'new_password'               => 'Новый пароль',
            'new_password_confirmation'  => 'Подтверждение нового пароля',
            'old_password'               => 'Прежний пароль',
            'timezone'                   => 'Часовой пояс',
            'language'                   => 'Язык',
            'contract'                   => 'Файл договора',
            'contract_confirmed'                   => 'Утвержденный договор',
            'contract_file'                   => 'Файл договора',
            'broker_id'                   => 'Номер регистрации риэлтора',
            'broker_name'                   => 'Имя риэлтора',
            'surename'                   => 'Фамилия риэлтора',
        ],

        'captcha' => 'Код подтверждения',
    ],
];
