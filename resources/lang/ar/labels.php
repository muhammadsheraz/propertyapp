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
        'all'      => 'كل ',
        'yes'      => 'نعم ',
        'no'       => 'لا',
        'copyright'  => 'حقوق النشر',
        'custom'   => 'خاصة للعميل',
        'actions'  => 'اجراءات',
        'active'   => 'فعال',
        'canceled'   => 'تم حذفه ',
        'completed'   => 'تم اكماله',
        'buttons' =>[
            'close'    => 'اغلق',
            'save'    => 'احفظ ',
            'update'  => 'تحديث',
        ],
        'hide'               => 'اخفاء',
        'inactive'           => 'غير نشط',
        'none'               => 'لايوجد ، غير متاح',
        'show'               => 'اظهر',
        'view_property'  => 'اظهر العقار',
        'commission_sale'  => 'معدل عمولة البيع ',
        'commission_rent'  => 'معدل عمولة الايجار',
        'commission_from_landlord'  => 'من المالك ',
        'commission_from_buyer'  => 'من الزبون',
        'commission_from_tenant'  => 'من المستأجر',
        'property_type'  => 'نوع العقار',
        'rooms'  => 'عدد الغرف',
        'price'  => 'السعر',
        'search'  => 'ابحث',
        'property_purpose'  => 'الغرض ',
        'property_limit'  => 'الحد',
    ],

    'location' =>[
        'city'      => 'المدينة',
        'district'      => 'المنطقة/ الحي',
    ],

    'properties' =>[
        'management'      => 'مدير الاعلان ',
        'create'      => 'انشئ اعلان',
        'view'      => 'تصفح الاعلان',
    ],

    'backend' =>[
        'access' =>[
            'roles' =>[
                'create'      => 'انشئ قسم',
                'edit'        => 'حدد القسم',
                'management'  => 'مدير القسم',

                'table' =>[
                    'number_of_users'  => 'عدد المستخدمين',
                    'permissions'      => 'أذونات',
                    'role'             => 'القسم',
                    'sort'             => 'رتب ',
                    'total'            => 'مجموع الاقسام',
                ],
            ],

            'users' =>[
                'active'               => 'المستخدمين النشطين',
                'all_permissions'      => 'جميع الاقسام',
                'change_password'      => 'غير كلمة المرور',
                'change_password_for'  => 'غير كلمة المرور للمستخدم',
                'create'               => 'انشئ حساب المستخدم',
                'deactivated'          => 'المستخدمين الغير نشطين ',
                'deleted'              => 'المستخدمين المحذوفين',
                'edit'                 => 'حرر معلومات المستخدم',
                'management'           => 'ادارة المستخدم',
                'no_permissions'       => 'لا يسمح بذلك',
                'no_roles'             => 'لا يوجد قسم لضبطه',
                'permissions'          => 'أذونات',

                'table' =>[
                    'confirmed'       => 'تم توثيقه',
                    'created'         => 'تم انشاؤه',
                    'email'           => 'بريد الكتروني',
                    'id'              => 'رقم السجل',
                    'last_updated'    => 'اخر تحديث',
                    'name'            => 'الكنية',
                    'first_name'      => 'الاسم',
                    'last_name'       => 'الكنية',
                    'no_deactivated'  => 'لايوجد مستخدم غير نشط',
                    'no_deleted'      => 'لايوجد مستخدم محذوف',
                    'other_permissions'  => 'أذونات اخرى',
                    'permissions'  => 'أذونات ',
                    'social'  => 'اجتماعي',
                    'total'           => 'عدد المستخدمين',
                ],

                'tabs' =>[
                    'titles' =>[
                        'overview'  => 'استطلاع',
                        'history'   => 'السجل',
                    ],

                    'content' =>[
                        'overview' =>[
                            'avatar'        => 'صورة العرض',
                            'confirmed'     => 'تم توثيقه',
                            'created_at'    => 'تم انشاؤه',
                            'deleted_at'    => 'تم حذفه',
                            'email'         => 'عنوان البريد الالكتروني',
                            'last_updated'  => 'اخر تحديث',
                            'name'          => 'الكنية',
                            'first_name'    => 'الاسم',
                            'last_name'     => 'الكنية',
                            'status'        => 'الحاله',
                        ],
                    ],
                ],

                'view'  => 'اطلع على معلومات المستخدم ',
            ],

            'brokers' =>[
                'active'               => 'وكلاء عقاريين نشطين',
                'all_permissions'      => 'جميع الأذونات',
                'change_password'      => 'غير كلمة المرور',
                'change_password_for'  => 'تغيير كلمة المرور للمستخدم',
                'create'               => 'انشئ حساب وكيل عقاري',
                'deactivated'          => 'وكلاء عقاريين غير نشطين',
                'deleted'              => 'الوكلاء العقاريين المحذوفين',
                'edit'                 => 'حرر معلومات المستخدم ',
                'management'           => 'ادارة وكلاء العقار',
                'no_permissions'       => 'لا يسمح بذلك',
                'no_roles'             => 'لا يوجد قسم لضبطه',
                'permissions'          => 'أذونات',

                'table' =>[
                    'confirmed'       => 'تم توثيقه ',
                    'created'         => 'تم انشاؤه ',
                    'email'           => 'عنوان البريد الالكتروني',
                    'id'              => 'رقم السجل',
                    'last_updated'    => 'اخر تحديث',
                    'name'            => 'الكنية',
                    'first_name'      => 'الاسم',
                    'properties'  => 'العقارات',
                    'last_name'       => 'الكنية',
                    'no_deactivated'  => 'وكلاء العقار الغير نشطين',
                    'no_deleted'      => 'وكلاء العقار المحذوفين',
                    'other_permissions'  => 'أذونات اخرى',
                    'permissions'  => 'أذونات ',
                    'roles'           => 'الاقسام',
                    'social'  => 'اجتماعي',
                    'total'           => 'مجموع المستخدمين/مجموع الوكلاء العقاريين',
                    'broker_no'           => 'رقم سجل الوكيل العقاري',
                    'customer_no'           => 'رقم سجل المستخدم',
                    'profile_photo'           => 'صورة العرض',
                    'change_profile_photo'           => 'تغيير صورة العرض',
                ],

                'tabs' =>[
                    'titles' =>[
                        'overview'  => 'استطلاع',
                        'history'   => 'السجل',
                    ],

                    'content' =>[
                        'overview' =>[
                            'avatar'        => 'صورة العرض',
                            'confirmed'     => 'تم توثيقه',
                            'created_at'    => 'تم انشاؤه',
                            'deleted_at'    => 'تم حذفه',
                            'email'         => 'عنوان البريد الالكتروني',
                            'last_updated'  => 'اخر تحديث',
                            'name'          => 'الكنية',
                            'first_name'    => 'الاسم',
                            'last_name'     => 'الكنية',
                            'status'        => 'الحاله',
                        ],
                    ],
                ],

                'view'  => 'اطلع على الوكيل العقاري',
            ],

            'customers' =>[
                'active'               => 'المستخدمين النشطين ',
                'all_permissions'      => 'أذونات',
                'change_password'      => 'تغيير كلمة المرور',
                'change_password_for'  => 'تغيير كلمة المرور للمستخدم',
                'create'               => 'انشئ وكيل عقاري',
                'deactivated'          => 'المستخدمين الغير نشطين',
                'deleted'              => 'المستخدمين المحذوفين',
                'edit'                 => 'حرر حساب المستخدم',
                'management'           => 'ادارة حساب المستخدم',
                'no_permissions'       => 'لا يسمح بذلك',
                'no_roles'             => 'لا يوجد قسم لضبطه',
                'permissions'          => 'أذونات',

                'table' =>[
                    'confirmed'       => 'تم توثيقه',
                    'created'         => 'تم انشاؤه',
                    'email'           => 'عنوان البريد الاكتروني',
                    'id'              => 'رقم السجل',
                    'last_updated'    => 'اخر تحديث',
                    'name'            => 'الكنية',
                    'first_name'      => 'الاسم',
                    'properties'  => 'الاعلانات',
                    'last_name'       => 'الكنية',
                    'no_deactivated'  => 'المستخمين الغير نشطين',
                    'no_deleted'      => 'المستخدمين المحذوفين',
                    'other_permissions'  => 'أذونات اخرى',
                    'permissions'  => 'أذونات ',
                    'roles'           => 'الاقسام',
                    'social'  => 'اجتماعي',
                    'total'           => 'مجموع المستخدمين',
                    'broker_no'           => 'رقم سجل الوكيل العقاري',
                    'customer_no'           => 'رقم سجل المستخدم',
                    'profile_photo'           => 'صورة العرض',
                    'change_profile_photo'           => 'تغيير صورة العرض',
                ],

                'tabs' =>[
                    'titles' =>[
                        'overview'  => 'استطلاع',
                        'history'   => 'السجل',
                    ],

                    'content' =>[
                        'overview' =>[
                            'avatar'        => 'صورة العرض',
                            'confirmed'     => 'تم توثيقه',
                            'created_at'    => 'تم انشاؤه',
                            'deleted_at'    => 'تم حذفه',
                            'email'         => 'عنوان البريد الالكتروني',
                            'last_updated'  => 'اخر تحديث',
                            'name'          => 'الكنية',
                            'first_name'    => 'الاسم',
                            'last_name'     => 'الكنية',
                            'status'        => 'الحاله',
                        ],
                    ],
                ],

                'view'  => 'اطلع على حساب الوكيل العقاري',
            ],
        ],
    ],

    'frontend' =>[

        'auth' =>[
            'login_box_title'     => 'دخول',
            'login_button'        => 'دخول',
            'download_contract'        => 'حمل معلومات العقد',
            'login_with'          => 'تسجيل الدخول عن طريق حساب التواصل الاجتماعي',
            'register_box_title'  => 'التسجيل',
            'register_button'     => 'التسجيل',
            'remember_me'         => 'تذكرني',
        ],

        'contact' =>[
            'box_title'  => 'تواصلوا معنا',
            'button'  => 'ارسل',
        ],

        'passwords' =>[
            'expired_password_box_title'  => 'انتهت صلاحية كلمة المرور الخاصة بكم',
            'forgot_password'                  => 'هل نسيت كلمة المرور؟',
            'reset_password_box_title'         => 'اعادة تعيين كلمة المرور',
            'reset_password_button'            => 'اعادة تعيين كلمة المرور',
            'update_password_button'            => 'تحديث كلمة المرور',
            'send_password_reset_link_button'  => 'ارسل رسالة بريد الكتروني بتعيين كلمة المرور',
        ],

        'user' =>[
            'passwords' =>[
                'change'  => 'غير كلمة مروري',
            ],

            'profile' =>[
                'avatar'              => 'صورة العرض',
                'created_at'          => 'تم انشاؤه',
                'edit_information'    => 'حرر معلوماتي',
                'email'               => 'عنوان البريد الاكتروني',
                'last_updated'        => 'اخر تحديث',
                'name'                => 'الكنية',
                'first_name'          => 'الاسم',
                'last_name'           => 'الكنية',
                'update_information'  => 'حدث معلوماتي',
            ],
        ],

    ],
];
