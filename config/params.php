<?php

return [
    'adminEmail' => 'example@example.com',
    'adminName' => 'Site admin',
    'supportEmail' => 'example@example.com',
    'supportName' => 'Support',
    'user.passwordResetTokenExpire' => 3600,

    'pageBlocks' => [
        'text' => [
            'class' => 'app\widgets\pageblocks\PageBlockTextWidget',
            'params' => [
                'content' => 'text',
                'view' => 'paragraph',
            ],
        ],
    ],
];
