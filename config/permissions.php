<?php

use App\Enums\PermissionName;
use App\Enums\UserRole;


return [
    'routes' => [
        'users.index' => [PermissionName::VIEW_USER],
        'users.create' => [PermissionName::CREATE_USER],
        'users.edit' => [PermissionName::UPDATE_USER,],
        'users.destroy' => [PermissionName::DELETE_USER],

        'courses.index' => [ PermissionName::VIEW_COURSE],
        'courses.create' => [PermissionName::CREATE_COURSE],
        'courses.edit' => [PermissionName::UPDATE_COURSE],
        'courses.destroy' => [PermissionName::DELETE_COURSE],
    ],
];
