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

    'accepted'              => 'attribute: لم يتم قبوله',
    'active_url'            => 'attribute: الرابط ليس صالح',
    'after'                 => 'attribute: يجب ان يكون تاريخه بعد تاريخ الموعد',
    'after_or_equal'        => 'attribute: يجب ان يكون تاريخه قبل تاريخ الموعد او اليوم نفسه',
    'alpha'                 => 'attribute: يجب ان يكون مكون من الحروف فقط',
    'alpha_dash'            => 'attribute: يمكن ان يتكون فراغات و ارقام و حروف',
    'alpha_num'             => 'attribute: يمكن ان يتكون من حروف وارقام',
    'array'                 => 'attribute: يمكن ان يكون مرتب',
    'before'                => 'attribute: يجب ان يكون تاريخه قبل تاريخ الموعد',
    'before_or_equal'       => 'attribute: يجب ان يكون تاريخه قبل او نفس يوم الموعد',
    'between'              =>[
        'numeric'  => 'attribute: يجب ان يكون بين الحد الاقصى والادنى',
        'file'     => 'attribute: يجب ان يكون بين الحد الاقصى والادنى من الكيلوبايت',
        'string'   => 'attribute: يجب ان يكون بين الحد الاقصى والادنى من الخانات',
        'array'    => 'attribute: يجب ان يكون بين الحد الاقصى والادنى من المادة',
    ],
    'boolean'               => 'attribute: خانته يجب ان تكون صحيحة او خاطئة',
    'confirmed'             => 'attribute: التصحيح لايتطابق',
    'date'                  => 'attribute: ليس تاريخا صحيحا',
    'date_format'           => 'attribute: الشكل لايتطابق مع الشكل',
    'different'             => 'attribute: يجب ان يكون مختلفا عن الاخر',
    'digits'                => 'attribute: يجب ان يتكون من الارقام',
    'digits_between'        => 'attribute: يجب ان يكون بين الحد الاقصى والادنى من الارقام',
    'dimensions'            => 'attribute: احجام الصورة ليست صحيحة',
    'distinct'              => 'attribute: تم الادخال ادخالا مزدوجا',
    'email'                 => 'attribute: يجب ان يكون عنوان بريد الكترني صحيح',
    'exists'                => 'ال(attribute) الذي تم اخياره ليس صحيحا',
    'file'                  => 'attribute: يجب ان يكون على شكل ملف',
    'filled'                => 'attribute: يجب ان يكون ادخال مزدوج',
    'image'                 => 'attribute: يجب ان يكون صورة',
    'in'                    => 'ال(attribute) الذي تم اخياره ليس صحيحا',
    'in_array'              => 'attribute: لايأخذ مساحة في أماكن اخرى',
    'integer'               => ' attribute: يجب أن يكون عددًا صحيحًا ',
    'ip'                    => 'attribute: يجب أن يكون عنوان IP صالحًا',
    'ipv4'                  => 'attribute: يجب أن يكون عنوان IPv4 صالحًا',
    'ipv6'                  => ' attribute: يجب أن يكون عنوان IPv6 صالحًا ',
    'json'                  => 'attribute: يجب أن تكون سلسلة JSON صالحة',
    'max'                  => [
        'numeric'  => 'attribute: يجب أن يكون :max صغير',
        'file'     => 'attribute: يجب أن يكون :max أصغر من كيلو بايت',
        'string'   => 'attribute: يجب أن يكون :max أصغر من الحرف',
        'array'    => 'attribute: يجب أن يكون :max أصغر من المادة',
    ],
    'mimes'                 => 'attribute: يجب أن يكون نوع الملف :values',
    'mimetypes'             => 'attribute: يجب أن يكون نوع الملف :values',
    'min'                  => [
        'numeric'  => 'attribute: يجب أن يكون :min على الاقل',
        'file'     => 'attribute: يجب أن يكون :min كيلو بايت على الاقل',
        'string'   => 'attribute: يجب أن يكون :min حرف على الاقل',
        'array'    => 'attribute: يجب أن يكون :min مادة على الاقل',
    ],
    'not_in'                => 'ال attribute: المختار ليس صالحا',
    'numeric'               => 'attribute: يجب أن يكون رقما',
    'present'               => 'يجب أن يكون حقل ال attribute: موجودا',
    'regex'                 => 'فورمات/شكل ال attribute: غير صالح',
    'required'              => 'يجب أن يكون هناك حقل attribute:',
    'required_if'           => 'حقل :attribute , مطلوب :other: values اخر ',
    'required_unless'       => 'حقل :attribute , مطلوب الى حينه :other :value  اخر ',
    'required_with'         => 'حقل :attribute , مطلوب عند وجود :values اخر',
    'required_with_all'     => 'حقل :attribute , مطلوب عند وجود :values اخر',
    'required_without'      => 'حقل :attribute , مطلوب عند عدم وجود :values اخر',
    'required_without_all'  => 'حقل :attribute , مطلوب الى حين وجود :value  اخر ',
    'same'                  => 'attribute: و الاخر يجب أن تطابق :other',
    'size'                 => [
        'numeric'  => 'attribute: يجب ان يكون مقياس',
        'file'     => 'attribute: يجب ان يكون المقياس كيلوبايت',
        'string'   => 'attribute: يجب ان تكون للمقياس خانات  ',
        'array'    => 'attribute: يجب ان يحتوي المقياس على مادة',
    ],
    'string'                => 'attribute: يجب ان يكون متسلسلا',
    'timezone'              => 'attribute: يجب ان يكون في منطقة مسموحة',
    'unique'                => 'attribute: تم اخذه من قبل شخص اخر',
    'uploaded'              => 'attribute: فشلت الاضافة',
    'url'                   => 'attribute: الشكل ليس صحيحا',

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
                    'associated_roles'  => 'الاقسام المرتبطة',
                    'dependencies'      => 'الاعتماد',
                    'display_name'      => 'اسم الشاشه',
                    'group'             => 'مجموعة',
                    'group_sort'        => 'ترتيب المجموعة',

                    'groups' => [
                        'name'  => 'اسم المجموعة',
                    ],

                    'name'        => 'الكنية',
                    'first_name'  => 'الاسم',
                    'last_name'   => 'الكنية',
                    'system'      => 'النظام',
                ],

                'roles' => [
                    'associated_permissions'  => '',
                    'name'                    => 'الأذونات المرتبطة',
                    'sort'                    => 'الكنية',
                ],

                'users' =>[
                    'active'                   => 'نشط',
                    'associated_roles'         => 'الاقسام المرتبطة',
                    'confirmed'                => 'تم تأكييده',
                    'email'                    => 'عنوان البريد الالكتروني',
                    'name'                     => 'الكنية',
                    'last_name'                => 'الاسم',
                    'first_name'               => 'الكنية',
                    'other_permissions'        => 'الأذونات الاخرى',
                    'password'                 => 'كلمة المرور',
                    'password_confirmation'    => 'تأكييد كلمة المرور',
                    'send_confirmation_email'  => 'ارسل رسالة التأكييد',
                    'timezone'                 => 'وحدة زمنية',
                    'language'                 => 'اللغة',
                ],
                'brokers' => [
                    'active'                   => 'نشط',
                    'associated_roles'         => 'الاقسام المرتبطة',
                    'confirmed'                => 'تم تأكييده',
                    'email'                    => 'عنوان البريد الالكتروني',
                    'phone_no'                 => 'الهاتف',
                    'mobile_no'                => 'المحمول',
                    'name'                     => 'الكنية',
                    'last_name'                => 'الاسم',
                    'first_name'               => 'الكنية',
                    'other_permissions'        => 'الأذونات الاخرى',
                    'password'                 => 'كلمة المرور',
                    'password_confirmation'    => 'تأكييد كلمة المرور',
                    'send_confirmation_email'  => 'ارسل رسالة التأكييد',
                    'timezone'                 => 'وحدة زمنية',
                    'language'                 => 'اللغة',
                    'city'                 => 'المدينة',
                    'district'                 => 'المنطقة/الحي',
                    'company_name'                 => 'اسم الشركة',
                    'tax_no'                 => 'الرقم الضريبي ',
                    'nearest_landmark'                 => 'في اقرب وقت',
                    'default_broker'                 => 'الوسيط الافتراضي',
                ],
            ],
        ],

        'frontend' => [
            'avatar'                     => 'صروة العرض',
            'email'                      => 'عنوان البريد الالكتروني',
            'phone_no'                      => 'الهاتف',
            'mobile_no'                      => 'المحمول',
            'first_name'                 => 'الاسم',
            'last_name'                  => 'الكنية',
            'name'                       => 'الاسم الكنية',
            'password'                   => 'كلمة مرور',
            'password_confirmation'      => 'تجديد كلمة المرور',
            'phone'                      => 'الهاتف',
            'message'                    => 'رسالة',
            'new_password'               => 'كلمة المرور الجديدة',
            'new_password_confirmation'  => 'تأكييد كلمة المرور الجديدة',
            'old_password'               => 'كلمة مرور قديمة',
            'timezone'                   => 'وحدة زمنية',
            'language'                   => 'اللغة',
            'contract'                   => 'ملف العقد',
            'contract_confirmed'                   => 'العقد المؤكد',
            'contract_file'                   => 'ملف العقد',
            'broker_id'                   => 'رقم سجل الوكيل العقاري',
            'broker_name'                   => 'اسم الوكيل العقاري',
            'surename'                   => 'كنية الوكيل العقاري',
        ],

        'captcha' => 'كود التصحيح ',
    ],
];
