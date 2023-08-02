<?php

return [
    'user_keys' => [
        // 'id' => 'id',
        // 'account_id' => 'account_id',
        // 'email' => 'email',
        'name' => 'name',
        // 'is_active' => 'is_active',
        'role_id' => 'role_id',
        'image' => 'image',
        'address' => 'address',
        'phone' => 'phone',
        // 'createdAt' => 'created_at',
        // 'updatedAt' => 'updated_at',
    ],

    'order_status' => [
        1 => 'Pending',
        2 => 'Processing',
        3 => 'Shipped',
        4 => 'Delivered',
        5 => 'Canceled',
        6 => 'Refunded',
        7 => 'Returned',
    ],

    'is_active' => [
        true => 'Hoạt động',
        false => 'Tạm ngưng',
    ],
];
