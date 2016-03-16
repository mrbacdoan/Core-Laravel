<?php
return [
    'users'     => [
        'view'   => [
            'users.index'
        ],
        'create' => [
            'users.create',
            'users.store'
        ],
        'edit'   => [
            'users.edit',
            'users.update'
        ],
        'group'  => [
            'users.group'
        ],
    ],
    'groups'    => [
        'view'   => [
            'groups.index'
        ],
        'create' => [
            'groups.create',
            'groups.store'
        ],
        'edit'   => [
            'groups.edit',
            'groups.update'
        ],
    ]
];