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

    'accepted' => 'The :attribute must be accepted.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute must only contain letters.',
    'alpha_dash' => 'The :attribute must only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'current_password' => 'Password is incorrect.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'Please enter a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'file' => 'The :attribute must be greater than or equal to :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal to :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'max' => [
        'numeric' => 'The :attribute must not be greater than :max.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'string' => 'The :attribute must not be greater than :max characters.',
        'array' => 'The :attribute must not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'Please enter a numeric value.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute must be a valid URL.',
    'uuid' => 'The :attribute must be a valid UUID.',

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
        'username' => [
            'required' => 'Please enter your email or mobile number.',
            'not_found' => 'No user found with this email or mobile number.',
            'deactivated' => 'Your account has been deactivated.'
        ],
        'password' => [
            'required' => 'Please enter a password.',
            'min' => 'Password must contain at least :min characters',
            'max' => 'Password cannot contain more than :max characters',
        ],
        'passwordConfirm' => [
            'required' => 'Please confirm the password.',
            'same' => 'Passwords do not match.'
        ],
        'current_password' => [
            'required' => 'Please enter your current password.',
        ],
        'new_password' => [
            'required' => 'Please enter a new password.',
            'same_as_current' => 'New password cannot be same as current password.'
        ],
        'new_password_confirm' => [
            'required' => 'Please confirm your new password.',
            'same' => 'New passwords do not match.',
        ],
        'name' => [
            'required' => 'Please enter a name.',
            'max' => 'Name cannot contain more than :max characters.'
        ],
        'mobile' => [
            'required' => 'Please enter a mobile number.',
            'valid' => 'Please enter a valid mobile number.',
            'unique' => 'Provided mobile number is in use by another user.'
        ],
        'email' => [
            'required' => 'Please enter an email address.',
            'unique' => 'Provided email address is already in use by another user.',
        ],
        'unit' => [
            'required' => 'Please enter an unit.',
        ],
        'price' => [
            'required' => 'Please enter a price.',
            'min' => 'Price cannot be a negative value.'
        ],
        'discounted_price' => [
            'lt' => 'Discounted price must be less than actual price.',
        ],
        'category_id' => [
            'exists' => 'Category not found.',
            'exists.parent' => 'Seleced parent category does not exist.'
        ],
        'inventory' => [
            'required' => 'Please enter inventory amount.',
            'integer' => 'Please enter a number.',
            'min' => 'Inventory amount cannot be negative.',
        ],
        'is_featured' => [
            '*' => 'Invalid data provided.',
        ],
        'image' => [
            'required' => 'Please select an image.',
            'mimes' => 'Invalid image type. Allowed types are :values.',
            'max' => 'Image size should not be more than 1MB.'
        ],
        'address' => [
            'required' => 'Please enter an address.'
        ],
        'area' => [
            'exists' => 'Area not found.',
            'required' => 'Please select an area.'
        ],
        'district' => [
            'exists' => 'District not found.',
            'required' => 'Please select a district.'
        ],
        'division' => [
            'exists' => 'Division not found.',
            'required' => 'Please select a division.'
        ],
        'product' => [
            'exists' => 'Product not found.',
            'quantity' => 'Please enter quantity.'
        ],
        'title' => [
            'required' => 'Please enter a title.'
        ],
        'type' => [
            'required' => 'Please select a type.'
        ],
        'code' => [
            'required' => 'Please enter a code.',
            'unique' => 'Code already exists.',
            'max' => 'Code is too long. Must be 255 characters or less.'
        ],
        'discount_percentage' => [
            'required' => 'Please enter discount percentage.',
            'integer' => 'Discount percentage must be an integer number.',
            'between' => 'Discount percentage must be a number between 1 and 99.',
        ],
        'maximum_discount' => [
            'integer' => 'Maximum discount must be an integer number.',
            'min' => 'Maximum discount cannot be less than 1.',
        ],
        'validity_start' => [
            'required' => 'Please enter validity start date.'
        ],
        'validity_end' => [
            'required' => 'Please enter validity expiry date.'
        ],
    ],

    'invalid-request' => 'Invalid request',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
