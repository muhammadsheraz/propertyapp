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
        'all'      => 'Все',
        'yes'      => 'Да',
        'no'       => 'Нет',
        'copyright'  => 'Авторское право',
        'custom'   => 'Персональный пользователь',
        'actions'  => 'Действия',
        'active'   => 'Активный',
        'canceled'   => 'Отменено',
        'completed'   => 'Завершено',
        'buttons' =>[
            'close'    => 'Закрыть',
            'save'    => 'Сохранить',
            'update'  => 'Обновить',
        ],
        'hide'               => 'Скрыть',
        'inactive'           => 'Неактивный',
        'none'               => 'Отсутствует',
        'show'               => 'Отобразить',
        'view_property'  => 'Отобразить недвижимость',
        'commission_sale'  => 'Комиссионная ставка при продаже',
        'commission_rent'  => 'Комиссионная ставка при аренде',
        'commission_from_landlord'  => 'От владельца',
        'commission_from_buyer'  => 'От клиента',
        'commission_from_tenant'  => 'От арендатора',
        'property_type'  => 'Тип недвижимости',
        'rooms'  => 'Количество комнат',
        'price'  => 'Цена',
        'search'  => 'Поиск',
        'property_purpose'  => 'Цель',
        'property_limit'  => 'Пределы',
    ],

    'location' =>[
        'city'      => 'Город',
        'district'      => 'Область/Район',
    ],

    'properties' =>[
        'management'      => 'Управление объявлениями',
        'create'      => 'Создать объявление',
        'view'      => 'Просмотр объявлений',
    ],

    'backend' =>[
        'access' =>[
            'roles' =>[
                'create'      => 'Создать роль',
                'edit'        => 'Определить роль',
                'management'  => 'Управление ролями',

                'table' =>[
                    'number_of_users'  => 'Количество пользователей',
                    'permissions'      => 'Разрешения',
                    'role'             => 'Роль',
                    'sort'             => 'Сортировка',
                    'total'            => 'Всего ролей',
                ],
            ],

            'users' =>[
                'active'               => 'Активные пользователи',
                'all_permissions'      => 'Все роли',
                'change_password'      => 'Изменить пароль',
                'change_password_for'  => 'Изменение пароля для пользователя :user',
                'create'               => 'Создать учетную запись пользователя',
                'deactivated'          => 'Деактивированные пользователи',
                'deleted'              => 'Удаленные пользователи',
                'edit'                 => 'Редактировать информацию о пользователе',
                'management'           => 'Управление пользователями',
                'no_permissions'       => 'Отказано в доступе',
                'no_roles'             => 'Нет роли для настройки',
                'permissions'          => 'Разрешения',

                'table' =>[
                    'confirmed'       => 'Подтверждено',
                    'created'         => 'Создано',
                    'email'           => 'Электронная почта',
                    'id'              => 'Номер регистрации',
                    'last_updated'    => 'Последнее обновление',
                    'name'            => 'Фамилия',
                    'first_name'      => 'Название',
                    'last_name'       => 'Фамилия',
                    'no_deactivated'  => 'Нет деактивированных пользователей',
                    'no_deleted'      => 'Нет удаленных пользователей',
                    'other_permissions'  => 'Прочие разрешения',
                    'permissions'  => 'Разрешения',
                    'social'  => 'Социальный',
                    'total'           => 'Количество пользователей',
                ],

                'tabs' =>[
                    'titles' =>[
                        'overview'  => 'Обзор',
                        'history'   => 'История',
                    ],

                    'content' =>[
                        'overview' =>[
                            'avatar'        => 'Изображение профиля',
                            'confirmed'     => 'Подтверждено',
                            'created_at'    => 'Создано',
                            'deleted_at'    => 'Удалено',
                            'email'         => 'Адрес электронной почты',
                            'last_updated'  => 'Последнее обновление',
                            'name'          => 'Фамилия',
                            'first_name'    => 'Название',
                            'last_name'     => 'Фамилия',
                            'status'        => 'Статус',
                        ],
                    ],
                ],

                'view'  => 'Просмотр информации о пользователе',
            ],

            'brokers' =>[
                'active'               => 'Активные риэлторы',
                'all_permissions'      => 'Все разрешения',
                'change_password'      => 'Изменить пароль',
                'change_password_for'  => 'Изменение пароля для пользователя :user',
                'create'               => 'Создать учетную запись риэлтора',
                'deactivated'          => 'Деактивированные риэлторы',
                'deleted'              => 'Удаленные риэлторы',
                'edit'                 => 'Редактировать информацию о пользователе',
                'management'           => 'Управление риэлторами',
                'no_permissions'       => 'Отказано в доступе',
                'no_roles'             => 'Отсутствует роль для настройки',
                'permissions'          => 'Разрешения',

                'table' =>[
                    'confirmed'       => 'Подтверждено',
                    'created'         => 'Создано',
                    'email'           => 'Адрес электронной почты',
                    'id'              => 'Номер регистрации',
                    'last_updated'    => 'Последнее обновление',
                    'name'            => 'Фамилия',
                    'first_name'      => 'Имя',
                    'properties'  => 'Недвижимость',
                    'last_name'       => 'Фамилия',
                    'no_deactivated'  => 'Деактивированные риэлторы',
                    'no_deleted'      => 'Удаленные риэлторы',
                    'other_permissions'  => 'Прочие разрешения',
                    'permissions'  => 'Разрешения',
                    'roles'           => 'Роли',
                    'social'  => 'Социальный',
                    'total'           => 'Всего пользователей | Всего риэлторов',
                    'broker_no'           => 'Номер регистрации риэлтора',
                    'customer_no'           => 'Номер регистрации пользователя',
                    'profile_photo'           => 'Изображение профиля',
                    'change_profile_photo'           => 'Изменить изображение профиля',
                ],

                'tabs' =>[
                    'titles' =>[
                        'overview'  => 'Обзор',
                        'history'   => 'История',
                    ],

                    'content' =>[
                        'overview' =>[
                            'avatar'        => 'Изображение профиля',
                            'confirmed'     => 'Подтверждено',
                            'created_at'    => 'Создано',
                            'deleted_at'    => 'Удалено',
                            'email'         => 'Адрес электронной почты',
                            'last_updated'  => 'Последнее обновление',
                            'name'          => 'Фамилия',
                            'first_name'    => 'Имя',
                            'last_name'     => 'Фамилия',
                            'status'        => 'Статус',
                        ],
                    ],
                ],

                'view'  => 'Обзор риэлторов',
            ],

            'customers' =>[
                'active'               => 'Активные пользователи',
                'all_permissions'      => 'Разрешения',
                'change_password'      => 'Изменить пароль',
                'change_password_for'  => 'Изменить пароль для пользователя :user',
                'create'               => 'Создать риэлтора',
                'deactivated'          => 'Деактивированные пользователи',
                'deleted'              => 'Удаленные пользователи',
                'edit'                 => 'Редактировать учетную запись пользователя',
                'management'           => 'Управление учетной записью пользователя',
                'no_permissions'       => 'Отказано в доступе',
                'no_roles'             => 'Отсутствует роль для настройки',
                'permissions'          => 'Разрешения',

                'table' =>[
                    'confirmed'       => 'Подтверждено',
                    'created'         => 'Создано',
                    'email'           => 'Адрес электронной почты',
                    'id'              => 'Номер регистрации',
                    'last_updated'    => 'Последнее обновление',
                    'name'            => 'Фамилия',
                    'first_name'      => 'Имя',
                    'properties'  => 'Фамилия',
                    'last_name'       => 'Объявления',
                    'no_deactivated'  => 'Деактивированные пользователи',
                    'no_deleted'      => 'Удаленные пользователи',
                    'other_permissions'  => 'Прочие разрешения',
                    'permissions'  => 'Разрешения',
                    'roles'           => 'Роли',
                    'social'  => 'Социальный',
                    'total'           => 'Всего риэлторов',
                    'broker_no'           => 'Номер регистрации риэлтора',
                    'customer_no'           => 'Номер регистрации пользователя',
                    'profile_photo'           => 'Изображение профиля',
                    'change_profile_photo'           => 'Изменить изображение профиля',
                ],

                'tabs' =>[
                    'titles' =>[
                        'overview'  => 'Обзор',
                        'history'   => 'История',
                    ],

                    'content' =>[
                        'overview' =>[
                            'avatar'        => 'Изображение профиля',
                            'confirmed'     => 'Подтверждено',
                            'created_at'    => 'Создано',
                            'deleted_at'    => 'Удалено',
                            'email'         => 'Адрес электронной почты',
                            'last_updated'  => 'Последнее обновление',
                            'name'          => 'Фамилия',
                            'first_name'    => 'Имя',
                            'last_name'     => 'Фамилия',
                            'status'        => 'Статус',
                        ],
                    ],
                ],

                'view'  => 'Обзор риэлторов',
            ],
        ],
    ],

    'frontend' =>[

        'auth' =>[
            'login_box_title'     => 'Вход в систему',
            'login_button'        => 'Вход в систему',
            'download_contract'        => 'Скачать договор',
            'login_with'          => 'Вход в систему через аккаунт соцсетей',
            'register_box_title'  => 'Зарегистрироваться',
            'register_button'     => 'Зарегистрироваться',
            'remember_me'         => 'Запомнить меня',
        ],

        'contact' =>[
            'box_title'  => 'Свяжитесь с нами',
            'button'  => 'послать',
        ],

        'passwords' =>[
            'expired_password_box_title'  => 'Срок действия вашего пароля истек',
            'forgot_password'             => 'Вы забыли свой пароль?',
            'reset_password_box_title'    => 'Сбросить пароль',
            'reset_password_button'       => 'Сбросить пароль',
            'update_password_button'      => 'Обновить пароль',
            'send_password_reset_link_button'  => 'Отправить на электронную почту Подтверждение для сброса пароля',
        ],

        'user' =>[
            'passwords' =>[
                'change'  => 'Изменить пароль',
            ],

            'profile' =>[
                'avatar'              => 'Изображение профиля',
                'created_at'          => 'Создано',
                'edit_information'    => 'Редактировать мои сведения',
                'email'               => 'Адрес электронной почты',
                'last_updated'        => 'Последнее обновление',
                'name'                => 'Фамилия',
                'first_name'          => 'Имя',
                'last_name'           => 'Фамилия',
                'update_information'  => 'Обновить мою сведения',
            ],
        ],

    ],
];
