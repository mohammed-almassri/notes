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
    'accepted' => 'حقل :attribute يجب ان يكون مقبولا.',
    'active_url' => 'حقل :attribute ليس رابطا صحيح.',
    'after' => 'حقل :attribute يجب ان يكون بعد تاريخ :date.',
    'after_or_equal' => 'حقل :attribute يجب ان يكون مساويا او بعد تاريخ :date.',
    'alpha' => 'حقل :attribute يجب ان يتكون فقط من حروف.',
    'alpha_dash' => 'حقل :attribute يجب ان يتكون فقط من حروف، ارقام، (-).',
    'alpha_num' => 'حقل :attribute يجب ان يتكون فقط من حروف وارقام.',
    'array' => 'حقل :attribute يجب ان يكون مصفوفة.',
    'before' => 'حقل :attribute يجب ان يكون قبل تاريخ :date.',
    'before_or_equal' => 'حقل :attribute يجب ان يكون مساويا او قبل تاريخ :date.',
    'between' => [
        'numeric' => 'حقل :attribute يجب ان يكون ما بين :min و :max.',
        'file' => 'الحجم :attribute يجب ان يكون بين :min و :max كيلو بايت.',
        'string' => 'عدد حروف :attribute يجب ان تكون بين :min و :max حرف.',
        'array' => 'عدد عناصر :attribute يجب ان يكون بين :min و :max عنصر.',
    ],
    'boolean' => 'حقل :attribute يجب ان يكون قيمة 1 او صفر.',
    'confirmed' => 'حقل :attribute غير مطابق للتأكيد.',
    'date' => 'حقل :attribute يحتوي على تاريخ غير صحيح.',
    'date_format' => 'حقل :attribute يحتوي على صيغة تاريخ غير مطابقة ل :format.',
    'different' => 'حقل :attribute و :other يجب ان يكونو مختلفين.',
    'digits' => 'حقل :attribute يجب ان يتكون من :digits خانة.',
    'digits_between' => 'حقل :attribute يجب ان يكون ما بين :min و :max خانة.',
    'dimensions' => 'حقل :attribute ابعاده غير صحيحة.',
    'distinct' => 'حقل :attribute يحتوي على قيمة مكررة.',
    'email' => 'حقل :attribute يجب ان يكون بريد الكتروني صحيح.',
    'exists' => 'قيمة :attribute المختارة غير موجودة.',
    'file' => 'حقل :attribute يجب ان يكون ملف.',
    'filled' => 'حقل :attribute يجب ان يحتوي على قيمة.',
    'image' => 'حقل :attribute يجب ان يكون صورة.',
    'in' => 'قيمة :attribute المختارة غير صحيحة.',
    'in_array' => 'قيمة :attribute غير موجودة من ضمن :other.',
    'integer' => 'حقل :attribute يجب ان يكون رقم صحيح.',
    'ip' => 'حقل :attribute يجب ان يكون عنوان شبكة صحيح.',
    'json' => 'حقل :attribute يجب ان يكون جسون صحيح.',
    'max' => [
        'numeric' => 'قيمة :attribute يجب ان لا تزيد عن :max.',
        'file' => 'حجم :attribute يجب ان لا يزيد عن :max كيلو بايت.',
        'string' => 'عدد حروف :attribute يجب ان لا يزيد عن :max حرف.',
        'array' => 'عدد عناصر :attribute يجب ان لا تزيد عن :max items.',
        'height' => 'حقل :attribute يجب ان لا يزيد ارتفاعه عن :max بكسل',
    ],
    'mimes' => 'صيغة :attribute يجب ان تكون من ضمن : :values.',
    'mimetypes' => 'صيغة :attribute يجب ان تكون من ضمن : :values.',
    'min' => [
        'numeric' => 'قيمة :attribute يجب ان لا تقل عن :min.',
        'file' => 'حجم :attribute يجب ان لا يقل عن :min كيلو بايت.',
        'string' => 'عدد حروف :attribute يجب ان لا يقل عن :min .',
        'array' => 'عدد عناصر :attribute يجب ان لا يقل عن :min items.',
    ],
    'not_in' => 'قيمة :attribute المختارة غير صحيحة.',
    'numeric' => 'حقل :attribute يجب ان يكون رقم.',
    'present' => 'حقل :attribute يجب ان يكون موجود.',
    'regex' => 'صيغة حقل :attribute غير صحيحة.',
    'required' => 'حقل :attribute مطلوب.',
    'required_if' => 'حقل :attribute مطلوب',
    'required_unless' => 'حقل :attribute مطلوب اذا كانت قيمة :other ضمن :values.',
    'required_with' => 'حقل :attribute مطلوب حينما يكون :values له قيمة.',
    'required_with_all' => 'حقل :attribute مطلوب حينما يكون :values لهم قيم.',
    'required_without' => 'حقل :attribute مطلوب حينما يكون :values ليس له قيمة.',
    'required_without_all' => 'حقل :attribute مطلوب حينما يكون :values ليس لهم قيمة.',
    'same' => 'حقل :attribute و :other يجب ان يكونوا متشابهين.',
    'size' => [
        'numeric' => 'حجم حقل :attribute يجب ان يكون :size.',
        'file' => 'حجم حقل :attribute يجب ان يكون :size كيلو بايت.',
        'string' => 'حجم حقل :attribute يجب ان يكون :size حرف.',
        'array' => 'حجم حقل :attribute يجب ان يكون :size عنصر.',
    ],
    'string' => 'حقل :attribute يجب ان يكون نص.',
    'timezone' => 'حقل :attribute يجب ان يكون منطقة زمنية صحيحة.',
    'unique' => 'حقل :attribute موجود مسبقا.',
    'uploaded' => 'حقل :attribute لا يمكن رفعه.',
    'url' => 'حقل :attribute ليس رابط صحيح.',
    'alpha_spaced' => 'The :attribute may only contain letters and spaces.',
    'invalid_duration' => 'صيفه الفتره خاطئة, يجب ان تكون m:s او h:m:s',
    'invalid_durations' => 'حقل "الى" يجب ان يكون اكبر من حقل "من"',
    'attributes' => [
        'path_from'=>'من',
        'path_to'=>'الى',
        'name' => 'الاسم',
        'title' => 'العنوان',
        'email' => 'البريد الالكتروني',
        'dob' => 'تاريخ الميلاد',
        'country_id' => 'الدولة',
        'gender' => 'الجنس',
        'mobile' => 'رقم الجوال',
        'description' => 'التفاصيل',
        'video' => 'الفيديو',
        'url' => 'الرابط',
        'password' => 'كلمة المرور',
        'subject' => 'العنوان',
        'message' => 'الرسالة',
        'question' => 'السؤال',
        'text' => 'النص',
        'percent' => 'النسبة',
        'image' => 'الصورة',
        'from'=>'من',
        'to'=>'الى',
        'images'=>'الصور',
        'language_id'=>'اللغة',
        'countries'=>'الدول',
        'msisdn'=>'رقم الجوال',
        'document_number'=>'رقم الوثيقة',
        'document_image'=>'صورة الهوية الفلسطينية',
        'document_type'=>'نوع الوثيقة',
        'document_video'=>'فيديو شخصي',
        'file'=>'الملف',

        'org_name'=>'اسم المؤسسة',
        'org_name_en'=>'الاسم بالانجليزية',
        'phone'=>'الجوال',
        'national_id'=>'رقم الهوية',
        'sponsorship_date'=>'تاريخ الرعاية',
        'amount'=>'المبلغ',
        'currency_id'=>'العملة',
        'city_id'=>'المدينة',
        'type_id'=>'النوع',
        'type_other'=>'أخرى',
        'operator_number'=>'رقم المشتغل',
        'fax'=>'الفاكس',
        'details'=>'التفاصيل',
        'attachment'=>'كتاب رسمي',
        'discount_source_file'=>'شهادة اعفاء ضريبي',
        'commercial_registry_file'=>'ملف السجل التجاري',
        'tax_bill_file'=>'الفاتورة الضريبية',
        'sim_type_id'=>'نوع الشريحة',
        'subscription_type_id'=>'نوع الاشتراك',
        'region_id'=>'المنطقة',
        'program_id'=>'البرنامج',
        'deliver_to_id'=>'التوصيل الى',
        'showroom_id'=>'المعرض',
        'address'=>'العنوان',
        'otp'=>'الكود',
        'site_host'=>'الموقع',
        'packages.*.name'=>'الاسم',
        'packages.*.minutes'=>'الدقائق',
        'packages.*.internet'=>'الانترنت',
        'packages.*.validity'=>'الصلاحية',
        'packages.*.price'=>'السعر',
        'packages.*.prepaid_code'=>'prepaid code',
        'packages.*.postpaid_code'=>'postpaid code',
        'packages.*.mix_code'=>'mix code',
        'packages.*.mix_main_code'=>'mix main code',



        'client_landline'=>'رقم الهاتف',
        'district_id'=>'المدينة',
        'locality_id'=>'المنطقة',
        'building_name'=>'اسم المبنى',
        'near_to'=>'معلم قريب',
        'contact_phone'=>'رقم التواصل',
        'contact_phone_2'=>'رقم تواصل آخر',
        'contact_email'=>'الايميل',
        'need_fl'=>'تركيب خط ارضي',
        'contact_date'=>'تاريخ الزيارة',
        'team_data'=>'موعد الزيارة',
        'followup_full_name'=>'الاسم رباعي',
        'followup_client_phone'=>'رقم الجوال',
        'followup_client_email'=>'الايميل',
        'requested_speed'=>'السرعة',
        'added_services'=>'الخدمات المضافة',
        'date' => 'التاريخ',
        'freq_day'=>'الظهور يوميا',
        'freq_week'=>'الظهور اسبوعيا',
        'freq_month'=>'الظهور شهريا',
        'marital_status'=>'الحالة الاجتماعية',
        'address_study'=>'مكان السكن عند الدراسه بحال السكن بمكان مختلف عن الاهل',
        'other_phone'=>'رقم هاتف اخر',
        'facebook'=>'فيسبوك',
        'about'=>'عن',
        'talents'=>'مواهب',
        'university'=>'الجامعة',
        'uni_year'=>'السنة الجامعية',
        'uni_major'=>'التخصص الجامعي',
        'uni_number'=>'الرقم الجامعي',

        'availability_type_id'=>'فحص الامكانية الفنية',
        'client_landline'=>'رقم الارضي',
        'location_lat'=>'latitude',
        'location_lon'=>'logitude',
        'district_id'=>'المدينة',
        'locality_id'=>'المنطقة',
        'quarter_id'=>'الحي',
        'dob'=>'تاريخ الميلاد',
        'full_name'=>'الاسم رباعي',
        'document_type_id'=>'نوع الوثيقة',
        'document_number'=>'رقم الوثيقة',
        'contact_phone'=>'رقم التواصل',
        'contact_phone_2'=>'رقم تواصل آخر',
        'contact_email'=>'الايميل',
        'contact_date'=>'تاريخ الزيارة',
        'need_fl'=>'تركيب خط أرضي',
        'near_to'=>'قريب من',
        'building_name'=>'اسم المبنى',
        'building_floor'=>'الطابق',
        'street'=>'الشارع',
        'email_notification'=>'ارسال الفاتورة على الايميل',
        'sms_notification'=>'ارسال الفاتورة على الجوال',
        'spouse_id'=>'رقم هوية الزوج',
        'requested_speed'=>'السرعة المطلوبة',
        'aman_id'=>'امان',
        'fixed_ip_id'=>'fixed ip',
        'mesh_id'=>'mesh',
        'i_like_id'=>'hadara tv',
        'handset_id'=>'handset',

        'imei_num'=>'الرقم التسلسلي',

        'city_code' => 'المدينة',
        'customer_type' => 'نوع الهاتف',
        'customer_name' => 'الاسم',

    ],

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

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'code' => [
            'exists' => 'يرجة ادخال كود التفعيل الصحيح',
        ],

        'g-recaptcha-response'=>[
            'required'=>'الرجاء الضغط على زر recaptcha',
        ],


    ],
    'phone_regex'=>'الرقم يجب ان يكون طوله 10 خانات و يبدأ ب 059',
    'wrong_code'=>'رمز التحقق خطأ',
    'expired_code'=>'انتهت صلاحية رمز التحقق, الرجاء طلب رمز جديد بالنقر على الزر ادناه',
    'recaptcha'=>'الرجاء الضغط على زر recaptcha',
    'terms'=>'الرجاء الموافقة على الشروط والاحكام',
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
    'values' => [
        // or whatever fields you wanna translate
        'date' => [
            // or tomorrow
            'today' => 'اليوم'
        ]
    ]
];
