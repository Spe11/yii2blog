<?php
return [
    'manage' => [
        'type' => 2,
        'ruleName' => 'owner',
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'manage',
        ],
    ],
];
