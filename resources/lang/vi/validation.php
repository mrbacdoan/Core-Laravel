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

    'accepted'             => ':attribute phải được chấp nhận.',
    'active_url'           => ':attribute không đúng định dạng URL.',
    'after'                => ':attribute phải là khoảng sau :date.',
    'alpha'                => ':attribute chỉ có thể chứa ký tự chữ.',
    'alpha_dash'           => ':attribute chỉ có thể chứa ký tự chữ, số, và dấu gạch dưới.',
    'alpha_num'            => ':attribute chỉ có thể chứa ký tự chữ và số.',
    'array'                => ':attribute phải là một mảng.',
    'before'               => ':attribute phải là khoảng trước :date.',
    'between'              => [
        'numeric' => ':attribute phải ở giữa khoảng :min đến :max.',
        'file'    => ':attribute phải ở giữa khoảng :min đến :max kilobytes.',
        'string'  => ':attribute phải ở giữa khoảng :min đến :max ký tự.',
        'array'   => ':attribute phải ở giữa khoảng :min đến :max phần tử.',
    ],
    'boolean'              => ':attribute phải là true hoặc false.',
    'confirmed'            => ':attribute xác thực không đúng.',
    'date'                 => ':attribute không đúng định dạng ngày tháng.',
    'date_format'          => ':attribute không đúng định dạng :format.',
    'different'            => ':attribute và :other phải khác nhau.',
    'digits'               => ':attribute phải là :digits số.',
    'digits_between'       => ':attribute phải ở giữa :min đến :max số.',
    'email'                => ':attribute phải đúng định dạng email.',
    'filled'               => ':attribute phải được điền vào.',
    'exists'               => ':attribute được chọn không hợp lệ.',
    'image'                => ':attribute phải là dạng ảnh.',
    'in'                   => ':attribute được chọn không hợp lệ.',
    'integer'              => ':attribute phải là kiểu số nguyên.',
    'ip'                   => ':attribute phải đúng định dạng IP.',
    'max'                  => [
        'numeric' => ':attribute không thể lớn hơn :max.',
        'file'    => ':attribute không thể lớn hơn :max kilobytes.',
        'string'  => ':attribute không thể lớn hơn :max ký tự.',
        'array'   => ':attribute không được nhiều hơn :max phần tử.',
    ],
    'mimes'                => ':attribute phải là kiểu định dạng: :values.',
    'min'                  => [
        'numeric' => ':attribute tối thiểu phải là :min.',
        'file'    => ':attribute tối thiểu phải là :min kilobytes.',
        'string'  => ':attribute tối thiểu phải là :min ký tự.',
        'array'   => ':attribute tối thiểu phải là :min phần tử.',
    ],
    'not_in'               => ':attribute được chọn không hợp lệ.',
    'numeric'              => ':attribute phải là kiểu số.',
    'regex'                => ':attribute sai định dạng.',
    'required'             => ':attribute không được bỏ trống.',
    'required_if'          => ':attribute không được bỏ trống khi :other là :value.',
    'required_with'        => ':attribute không được bỏ trống khi giá trị hiện tại là :values.',
    'required_with_all'    => ':attribute không được bỏ trống khi giá trị hiện tại là :values.',
    'required_without'     => ':attribute không được bỏ trống khi giá trị hiện tại không phải là :values.',
    'required_without_all' => ':attribute không được bỏ trống khi không có giá trị hiện tại nào là :values.',
    'same'                 => ':attribute và :other phải giống nhau.',
    'size'                 => [
        'numeric' => ':attribute phải là :size.',
        'file'    => ':attribute phải là :size kilobytes.',
        'string'  => ':attribute phải là :size ký tự.',
        'array'   => ':attribute phải chứa :size phần tử.',
    ],
    'timezone'             => ':attributephải là một vùng hợp lệ.',
    'unique'               => ':attribute đã tồn tại.',
    'url'                  => ':attribute định dạng không hợp lệ.',

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
    'vn_phone_number'      => 'Số điện thoại không hợp lệ.',
    "captcha"              => ':attribute không đúng.',
    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'phone'          => [
            'regex' => 'Số điện thoại không hợp lệ.',
        ],
        'province_id'    => [
            'integer' => 'Tỉnh, thành phố không hợp lệ',
            'min'     => 'Tỉnh, thành phố không hợp lệ.',
        ],
        'identity_card'  => [
            'regex' => 'CMND không hợp lệ.',
        ],
        'token_key'      => [
            'required' => 'Token không hợp lệ.',
            'in'       => 'Token không hợp lệ.',
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
    'attributes'           => [

    ],
];
