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
    "accepted" => ":attribute باید پذیرفته شده باشد.",
    "active_url" => "آدرس :attribute معتبر نیست",
    "after" => ":attribute باید تاریخی بعد از :date باشد.",
    "alpha" => ":attribute باید شامل حروف الفبا باشد.",
    "alpha_dash" => ":attribute باید شامل حروف الفبا و عدد و خظ تیره(-) باشد.",
    "alpha_num" => ":attribute باید شامل حروف الفبا و عدد باشد.",
    "array" => ":attribute باید شامل آرایه باشد.",
    "before" => ":attribute باید تاریخی قبل از :date باشد.",
    "between" => [
        "numeric" => ":attribute باید بین :min و :max باشد.",
        "file" => ":attribute باید بین :min و :max کیلوبایت باشد.",
        "string" => ":attribute باید بین :min و :max کاراکتر باشد.",
        "array" => ":attribute باید بین :min و :max آیتم باشد.",
    ],
    "boolean" => "The :attribute field must be true or false",
    "confirmed" => ":attribute با تاییدیه مطابقت ندارد.",
    "date" => ":attribute یک تاریخ معتبر نیست.",
    "date_format" => ":attribute با الگوی :format مطاقبت ندارد.",
    "different" => ":attribute و :other باید متفاوت باشند.",
    "digits" => ":attribute باید :digits رقم باشد.",
    "digits_between" => ":attribute باید بین :min و :max رقم باشد.",
    "email" => "فرمت :attribute معتبر نیست.",
    "exists" => ":attribute انتخاب شده، معتبر نیست.",
    "image" => ":attribute باید تصویر باشد.",
    "in" => ":attribute انتخاب شده، معتبر نیست.",
    "integer" => ":attribute باید نوع داده ای عددی (صحیح) باشد.",
    "ip" => ":attribute باید IP آدرس معتبر باشد.",
    "max" => [
        "numeric" => ":attribute نباید بزرگتر از :max باشد.",
        "file" => ":attribute نباید بزرگتر از :max کیلوبایت باشد.",
        "string" => ":attribute نباید بیشتر از :max کاراکتر باشد.",
        "array" => ":attribute نباید بیشتر از :max آیتم باشد.",
    ],
    "mimes" => ":attribute باید یکی از فرمت های :values باشد.",
    "min" => [
        "numeric" => ":attribute نباید کوچکتر از :min باشد.",
        "file" => ":attribute نباید کوچکتر از :min کیلوبایت باشد.",
        "string" => ":attribute نباید کمتر از :min کاراکتر باشد.",
        "array" => ":attribute نباید کمتر از :min آیتم باشد.",
    ],
    "not_in" => ":attribute انتخاب شده، معتبر نیست.",
    "numeric" => ":attribute باید شامل عدد باشد.",
    "regex" => ":attribute یک فرمت معتبر نیست",
    "required" => "فیلد :attribute الزامی است",
    "required_if" => "فیلد :attribute هنگامی که :other برابر با :value است، الزامیست.",
    "required_with" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_with_all" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_without" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "required_without_all" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "same" => ":attribute و :other باید مانند هم باشند.",
    "size" => [
        "numeric" => ":attribute باید برابر با :size باشد.",
        "file" => ":attribute باید برابر با :size کیلوبایت باشد.",
        "string" => ":attribute باید برابر با :size کاراکتر باشد.",
        "array" => ":attribute باسد شامل :size آیتم باشد.",
    ],
    "timezone" => "The :attribute must be a valid zone.",
    "unique" => ":attribute قبلا انتخاب شده است.",
    "url" => "فرمت آدرس :attribute اشتباه است.",

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
        'province_id'   => [
            'integer'   =>  'شما حتما باید یک استان را انتخاب کنید',
            'exists'    =>  'شما حتما باید یک استان را انتخاب کنید',
        ],
        'login_captcha'   => [
            'check_captcha' => 'لطفا کد امنیتی را بدرستی وارد کنید',
            'string'   =>  'لطفا کد امنیتی را بدرستی وارد کنید',
            ],
        'captcha'   => [
            'check_captcha' => 'لطفا کد امنیتی را بدرستی وارد کنید',
            'string'   =>  'لطفا کد امنیتی را بدرستی وارد کنید',
            ],
        'uni_captcha'   => [
            'uni_captcha' => 'لطفا کد امنیتی را بدرستی وارد کنید',
            'string'   =>  'لطفا کد امنیتی را بدرستی وارد کنید',
            '*' => 'لطفا کد امنیتی را بدرستی وارد کنید',
        ],
        'contract_type' => [
            'required'  => 'شما حتما باید یکی از نوع های همکاری را انتخاب کنید',
            'array' => ':|',
        ],
        'contract_type.*' =>[
            'required'  => 'شما حتما باید یکی از نوع های همکاری را انتخاب کنید',
            'exists'  => 'خطا در نوع داده ی ارسالی',
        ],
        'department_id' =>[
            'array' => ':|',
        ],
        'department_id.*' =>[
            'integer'  => 'مقدار :attribute معتبر نیست',
            'exists'  => 'مقدار :attribute معتبر نیست',
        ],
        'selected_applies'=>[
            'required' => 'هیچ درخواستی انتخاب نشده است',
            'array' => 'هیچ درخواستی انتخاب نشده است',
            'min' => 'هیچ درخواستی انتخاب نشده است',
        ],
        'industry_id' =>[
            'required'  => 'حداقل باید یک صنعت انتخاب کنید',
            'array' => ':|',
        ],
        'industry_id.*' =>[
            'integer'  => 'مقدار صنعت معتبر نیست',
            'exists'  => 'مقدار صنعت معتبر نیست',
        ],
        'our' =>[
            'integer'  => 'فیلد انتخاب شده در بخش طریقه آشنایی با شرکت معتبر نیست',
            'between'  => 'فیلد انتخاب شده در بخش طریقه آشنایی با شرکت معتبر نیست',
        ],
        'register_captcha' => [
            'check_captcha' => 'لطفا کد امنیتی را بدرستی وارد کنید',
            'string' => 'لطفا کد امنیتی را بدرستی وارد کنید',
        ],
        'forget_captcha' => [
            'check_captcha' => 'لطفا کد امنیتی را بدرستی وارد کنید',
            'string' => 'لطفا کد امنیتی را بدرستی وارد کنید',
        ],
        'cv' => [
            'mimes' => 'فرمت cv حتما باید pdf باشد',
            'max' => 'حجم pdf آپلود شده از 5000 کیلوبایت بیشتر است',
        ],
        'change_mobile_captcha' => [
            'check_captcha' => 'لطفا کد امنیتی را بدرستی وارد کنید',
            'string' => 'لطفا کد امنیتی را بدرستی وارد کنید',
        ],
        'linkedin' => [
            'string' => 'لطفا شناسه لینکداین امنیتی را بدرستی وارد کنید',
        ],
        'Contact_captcha' => [
            'check_captcha' => 'لطفا کد امنیتی را بدرستی وارد کنید',
            'string' => 'لطفا کد امنیتی را بدرستی وارد کنید',
        ],
        'degree' => [
            'integer' => 'فیلد انتخاب شده در بخش طریقه آخرین مدرک تحصیلی معتبر نیست',
            'between' => 'فیلد انتخاب شده در بخش طریقه آخرین مدرک تحصیلی معتبر نیست',
        ],
        'ProfesstionalTrainingRecords' => [
            'array' => ':|',
        ],
        'ProfesstionalTrainingRecords.*.title' => [
            'required' => 'پر کردن فیلد شایستگی های تخصصی الزامی می باشد',
            'string' => 'فیلد شایستگی های تخصصی باید حاوی متن باشد',
            'max' => 'فیلد شایستگی های تخصصی نمی تواند بیش از :max کاراکتر باشد',
        ],
        'questions.*.question' => [
            'required' => 'متن سوال نمی تواند خالی باشد. اگر سوالی ندارید، سوال را حذف کنید.',
            'string' => 'متن سوال نمی تواند خالی باشد. اگر سوالی ندارید، سوال را حذف کنید.',
            'max' => 'طول متن سوال نمی تواند بیش از :max کاراکتر باشد',
        ],
        'ProfesstionalTrainingRecords.*.duration' => [
            'required' => 'پر کردن فیلد مدت دوره الزامی می باشد',
            'integer' => 'فیلد مدت دوره باید به صورت عددی و بر حسب ساعت باشد',
        ],
        'ProfesstionalTrainingRecords.*.hasCertificate' => [
            'max' => 'فیلد گواهینامه نمی تواند بیش از :max کاراکتر باشد',
        ],
        'ProfesstionalTrainingRecords.*.endDate' => [
            'required' => 'پر کردن مقدار سال اتمام الزامی می باشد',
            'integer' => 'سال اتمام باید به صورت عددی وارد شود',
        ],
        'ProfesstionalTrainingRecords.*.instituteName' => [
            'required' => 'پر کردن فیلد نام موسسه می باشد',
            'string' => 'نام مؤسسه باید یک مقدار متنی باشد',
            'max' => 'نام مؤسسه نمی تواند بیش از :max کاراکتر باشد',
        ],
        '*.*.field' => [
                'string'=> 'نام رشته باید یک مقدار متنی باشد',
                'max'=> 'فیلد رشته نمی تواند بیش از :max کاراکتر باشد',
        ],
        '*.*.tendency' => [
            'string'=>'نام گرایش باید یک مقدار متنی باشد',
            'max'=>'فیلد گرایش نمی تواند بیش از :max کاراکتر باشد',
        ],
        '*.*.institute' => [
            'string'=>'نام مؤسسه باید یک مقدار متنی باشد',
            'max'=>'فیلد موسسه نمی تواند بیش از :max کاراکتر باشد',
        ],
        '*.*.institute_structure' => [
            'integer'=>'مقدار ساختار مؤسسه معتبر نیست',
        ],
        '*.*.course_type' => [
            'integer'=>'مقدار نوع دوره معتبر نیست',
        ],
        '*.*.city' => [
            'string'=>'نام شهر باید یک مقدار متنی باشد',
            'max'=>'نام شهر نمی تواند بیش از :max کاراکتر باشد',
        ],
        '*.*.average' => [
            'required'=>'پر کردن فیلد معدل ضروری می باشد',
            'between'=>'مقدار معدل معتبر نیست',
        ],
        'Diploma' => [
            'array' => 'فیلد دیپلم اجباری است',
            'min' => 'فیلد دیپلم اجباری است',
            'max' => 'تعداد مدرک دیپلم نمی تواند بیش از :max باشد',
            'required' => 'فیلد دیپلم الزامی است',
        ],
        'BSC' =>[
            'required' => 'فیلد کارشناسی الزامی است',
            'array' => 'فیلد کارشناسی الزامی است',
            'max' => 'تعداد مدرک کارشناسی نمی تواند بیش از :max باشد',
        ],
        'PHD' =>[
            'required' => 'فیلد دکترا الزامی است',
            'array' => 'فیلد دکترا الزامی است',
            'max' => 'تعداد مدرک دکترا نمی تواند بیش از :max باشد',
        ],
        'CPHD' =>[
            'required' => 'فیلد دکترا پیوسته الزامی است',
            'array' => 'فیلد دکترا پیوسته الزامی است',
            'max' => 'تعداد مدرک دکترا پیوسته نمی تواند بیش از :max باشد',
        ],
        'MSC' =>[
            'required' => 'فیلد کارشناسی ارشد الزامی است',
            'array' => 'فیلد کارشناسی ارشد الزامی است',
            'max' => 'تعداد مدرک کارشناسی ارشد نمی تواند بیش از :max باشد',
        ],
        'AD' =>[
            'required' => 'فیلد کاردانی الزامی است',
            'array' => 'فیلد کاردانی الزامی است',
            'max' => 'تعداد مدرک کاردانی نمی تواند بیش از :max باشد',
        ],
        'Family' =>[
            'required' => 'پر کردن اطلاعات مربوط به خانواده الزامی است',
        ],
        'ForeignLanguage.*.title' =>[
            'required' => 'پر کردن فیلد نام زیان الزامی است',
            'string' => 'نام زبان باید یک مقدا متنی باشد',
            'max' => 'نام زبان نمی تواند بیش از :max کاراکتر باشد',
        ],
        'ForeignLanguage.*.speaking' =>[
            'required' => 'انتخاب سطح مهارت در مکالمه الزامی است',
            'integer' => ':|',
            'between' => 'لطفا یکی از سطح های مهارتی را برای مکالمه انتخاب کنید',
        ],
        'ForeignLanguage.*.writing' =>[
            'required' => 'انتخاب سطح مهارت در نگارش الزامی است',
            'integer' => ':|',
            'between' => 'لطفا یکی از سطح های مهارتی را برای نگارش انتخاب کنید',
        ],
        'ForeignLanguage.*.comprehension' =>[
            'required' => 'انتخاب سطح مهارت در درک مطلب الزامی است',
            'integer' => ':|',
            'between' => 'لطفا یکی از سطح های مهارتی را برای درک مطلب انتخاب کنید',
        ],
        'ForeignLanguage.*.Certificate' =>[
            'string' => 'نام گواهینامه زبان باید یک مقدا متنی باشد',
            'max' => 'نام گواهینامه زبان نمی تواند بیش از :max کاراکتر باشد',
        ],
        'computerSkill.*.title' =>[
            'required' => 'نام مهارت الزامی می باشد',
            'string' => 'نام مهارت باید یک مقدار متنی باشد',
            'max' => 'نام مهارت نمی تواند بیش از :max کاراکتر باشد',
        ],
        'computerSkill.*.proficiency' =>[
            'required' => 'سطج مهارت الزامی است',
            'integer' => ':|',
            'between' => 'لطفا یکی از سطح های مهارتی را برای آشنایی با کامپیوتر انتخاب کنید',
        ],
        'computerSkill.*.has_certificate' =>[
            'integer' => ':|',
            'between' => ':|',
        ],
        'computerSkill.*.description' =>[
            'required' => 'توضیحات در خصوص مهارت الزامی است',
            'string' => 'توضیحات باید یک عبارت متنی باشد',
            'max' => 'توضیحات مهارت نمی تواند بیش از :max کاراکتر باشد',
        ],
        'expire_date'=>[
            'persian_date' => 'فرمت تاریخ انقضا اشتباه می باشد'
        ],
        'born_date'=>[
            'persian_date' => 'فرمت تاریخ تولد اشتباه می باشد'
        ],
        'military_date'=>[
            'persian_date' => 'فرمت تاریخ پایان خدمت اشتباه می باشد',
        ],
        'experimental.*.title' =>[
            'required' => 'عنوان مهارت تجربی الزامی است',
            'string' => 'عنوان مهارت تجربی باید یک عبارت متنی باشد',
            'max' => 'نام مهارت نمی تواند بیش از :max کاراکتر باشد',
        ],
        'experimental.*.proficiency' =>[
            'required' => 'سطح مهارت تجربی الزامی است',
            'integer' => 'مقدار :attribute معتبر نیست',
            'between' => 'مقدار :attribute معتبر نیست',
        ],
        'experimental.*.description' =>[
            'string' => 'توضیحات باید یک عبارت متنی باشد',
            'max' => 'توضیحات مهارت نمی تواند بیش از :max کاراکتر باشد',
        ],
        'job' =>[
            'array' => ':|',
            'between' => 'مقدار :attribute معتبر نیست',
            'exists' => 'شغل مورد نظر وجود ندارد یا منقضی شده است'
        ],
        'job.*.namesazman' =>[
            'required' => 'نام سازمان ضروری است',
            'string' => 'نام سازمان باید یک عبارت متنی باشد',
            'max' => 'نام سازمان نمی تواند بیش از :max کاراکتر باشد',
        ],
        'job.*.tarikhshoro' =>[
            'required' => 'تاریخ شروع کار الزامی است',
        ],
        'job.*.akharinsemat' =>[
            'required' => 'آخرین سمت الزامی است',
            'string' => 'آخرین سمت باید یک عبارت متنی باشد',
            'max' => 'آخرین سمت نمی تواند بیش از :max کاراکتر باشد',
        ],
        'job.*.akharinhoghogh' =>[
            'required' => 'آخرین حقوق دریافتی الزامی است',
            'integer' => 'مقدار :attribute معتبر نیست',
        ],
        'job.*.elatghat' =>[
            'required' => 'علت قطع همکاری الزامی است',
            'string' => 'علت قطع همکاری باید یک عبارت متنی باشد',
            'max' => 'علت قطع همکاری نمی تواند بیش از :max کاراکتر باشد',
        ],
        'job.*.shomartamas' =>[
            'regex' => '',
        ],
        'job.*.vazayef' =>[
            'string' => '',
            'max' => 'وظایف قبلی شما نمی تواند بیش از :max کاراکتر باشد',
        ],
        'Family.*.name' =>[
            'required' => 'فیلد نام الزامی است',
            'string' => 'نام باید یک عبارت متنی باشد',
            'max' => 'نام شخص نمی تواند بیش از :max کاراکتر باشد',
        ],
        'Family.*.relation' =>[
            'integer' => ':|',
            'between' => 'شما باید یکی از نسبت هایی که در لیست موجود هستند را انتخاب کنید',
        ],
        'Family.*.job' =>[
            'string' => 'شفل باید یک عبارت متنی باشد',
            'max' => 'نام شغل نمی تواند بیش از :max کاراکتر باشد',
        ],
        'Family.*.organization' =>[
            'string' => 'صنف/سازمان باید یک عبارت متنی باشد',
            'max' => 'نام شرکت نمی تواند بیش از :max کاراکتر باشد',
        ],
        'requested_salary' =>[
            'string' => '',
            'required' => '',
        ],
        'crime' =>[
            'integer' => 'مقدار :attribute معتبر نیست',
            'max' => 'مقدار :attribute معتبر نیست',
            'required' => 'مقدار :attribute معتبر نیست',
        ],
        'crime_description' =>[
            'string' => '',
            'max' => 'علت جرم نمی تواند بیش از :max کاراکتر باشد',
        ],
        'sickness' =>[
            'required' => '',
            'max' => ':|',
            'integer' => ':|',
        ],
        'sickness_description' =>[
            'string' => 'علت بیماری باید یک عبارت متنی باشد',
            'max' => 'علت بیماری نمی تواند بیش از :max کاراکتر باشد',
        ],
        'treatment' =>[
            'required' => 'یکی از موارد بله یا خیر را برای سوال بهبودی انتخاب کنید',
            'integer' =>  ':|',
            'between' =>  'یکی از موارد بله یا خیر را برای سوال بهبودی انتخاب کنید',
        ],
        'subject' =>[
            'string' =>  'وارد کردن موضوع الزامی می باشد',
            'max' =>  'موضوع نمی تواند بیشتر از :max کاراکتر باشد',
        ],
        'body' =>[
            'string' =>  'وارد کردن پیام الزامی می باشد',
            'max' =>  'پیام نمی تواند بیشتر از :max کاراکتر باشد',
        ],
        'introducer' =>[
            'required_if' => 'اگر از کارکنان گروه صنعتی کسی را می شناسید باید اطلاعات وی وا در فرم وارد کنید',
            'array' => ':|',
            'max' =>  ':|',
        ],
        'intro' =>[
            'integer' => ':|',
            'max' =>  ':|',
        ],
        'introducer.*.name' =>[
            'string' => 'نام معرف باید یک عبارت متنی باشد',
            'max' => 'نام معرف نمی تواند بیش از :max کاراکتر باشد',
        ],
        'introducer.*.company' =>[
            'string' => 'نام سازمان باید یک عبارت متنی باشد',
            'max' => 'نام سازمان نمی تواند بیش از :max کاراکتر باشد',
        ],
        'introducer.*.relation' =>[
            'string' => 'نسبت باید یک عبارت متنی باشد',
            'max' => 'نسبت نمی تواند بیش از :max کاراکتر باشد',
        ],
        'introducer.*.post' =>[
            'string' => 'سمت باید یک عبارت متنی باشد',
            'max' => 'سمت نمی تواند بیش از :max کاراکتر باشد',
        ],
        'q1' =>[
            'string' => 'پاسخ سوال باید یک عبارت متنی باشد',
            'max' => 'پاسخ سوال نمی تواند بیش از :max کاراکتر باشد',
        ],
        'q2' =>[
            'string' => 'پاسخ سوال باید یک عبارت متنی باشد',
            'max' => 'پاسخ سوال نمی تواند بیش از :max کاراکتر باشد',
        ],
        'q3' =>[
            'string' => 'پاسخ سوال باید یک عبارت متنی باشد',
            'max' => 'پاسخ سوال نمی تواند بیش از :max کاراکتر باشد',
        ],
        'q4' =>[
            'string' => 'پاسخ سوال باید یک عبارت متنی باشد',
            'max' => 'پاسخ سوال نمی تواند بیش از :max کاراکتر باشد',
        ],
        'q5' =>[
            'string' => 'پاسخ سوال باید یک عبارت متنی باشد',
            'max' => 'پاسخ سوال نمی تواند بیش از :max کاراکتر باشد',
        ],
        'accept' =>[
            'required' => 'شما حتما باید مندرجات توافق نامه را بپذیرید',
            'integer' => ':|',
        ],
        'first_name' =>[
            'regex' => 'لطفا نام خود را با حروف فارسی وارد کنید',
        ],
        'last_name' =>[
            'regex' => 'لطفا نام خانوادگی خود را با حروف فارسی وارد کنید',
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
    'attributes' => [
        "name" => "نام",
        "username" => "نام کاربری",
        "email" => "ایمیل",
        "first_name" => "نام",
        "last_name" => "نام خانوادگی",
        "password" => "رمز عبور",
        "password_confirmation" => "تاییدیه ی رمز عبور",
        "city" => "شهر",
        "country" => "کشور",
        "address" => "نشانی",
        "phone" => "تلفن",
        "mobile" => "تلفن همراه",
        "age" => "سن",
        'code' => 'کد',
        "sex" => "جنسیت",
        "gender" => "جنسیت",
        'job_general_merites' => 'شایستگی های عمومی',
        'job_professional_merites' => 'شایستگی های تخصصی',
        "student_id" => "شماره دانشجویی",
        "interests" => "علاقه مندی های شغل",
        "day" => "روز",
        "month" => "ماه",
        "year" => "سال",
        "hour" => "ساعت",
        "minute" => "دقیقه",
        "second" => "ثانیه",
        "title" => "عنوان",
        "text" => "متن",
        "national_id" => "کدملی",
        "national_code" => "کدملی",
        "born_date" => "تاریخ تولد",
        "marriage_status" => "وضعیت تأهل",
        "province_id" => "استان",
        "city_id" => "شهر",
        "address_area" => "منطقه/محله",
        "home_phone" => "تلفن منزل",
        "content" => "محتوا",
        "description" => "توضیحات",
        "excerpt" => "گلچین کردن",
        "date" => "تاریخ",
        "time" => "زمان",
        "available" => "موجود",
        "size" => "اندازه",
        'military_status' => 'وضعیت نظام وظیفه',
        'military_date' => 'تاریخ پایان خدمت',
        'military_free' => 'دلیل معافیت',
        'military_buy' => 'تاریخ خرید خدمت',
        'accept' => 'تایید توافق نامه',
        'moaref_fullname' => 'نام و نام خانوادگی',
        'moaref_compnay' => 'نام شرکت فعلی',
        'moaref_nesbat' => 'نسبت',
        'moaref_post' => 'سمت',
        'PHD' => 'دکترا',
        'pc' => 'استان-شهر',
        'CPHD' => 'دکترای پیوسته',
        'MSC' => 'کارشناسی ارشد',
        'BSC' => 'کارشناسی',
        'AD' => 'کاردانی',
        'Diploma' => 'دیپلم',
        'home_page_url' => 'آدرس سایت',
        'logo' => 'لوگو',
        'body' => 'توضیحات',
        'slug' => 'نام مستعار',
        'department_id' => 'زمینه تخصصی',
        'department' => 'زمینه تخصصی',
        'pin_status' => 'وضعیت پین',
        'degree' => 'آخرین مدرک تحصیلی',
        'subject' => 'موضوع',
        'priority' => 'اهمیت',
        'login_captcha' => 'کد امنیتی',
        'captcha' => 'کد امنیتی',
        'register_captcha' => 'کد امنیتی',
        'forget_captcha' => 'کد امنیتی',
        'Contact_captcha' => 'کد امنیتی',
        'message' => 'پیام',
        'old_password' => 'پسورد قبلی',
        'main_responsibilities' => 'مسئولیت های اصلی',
        'skill_1' => 'شایستگی های عمومی',
        'skill_2' => 'شایستگی های تخصصی',
        'alias' => 'نام مستعار لاتین',
        'post' => 'عنوان شغل(پست)',
        'goal_or_mission' => 'اهداف و ماموریت ها',
        'questions' => 'سوالات',
        'question' => 'سوال',
        'apply_id' => 'آی دی درخواست',
        'job_id' => 'آی دی آگهی',
]
];