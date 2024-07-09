<?php

use App\Enums\PermissionName;
use App\Enums\UserRole;


return [
    'routes' => [
        'users.index' => [PermissionName::VIEW],
        'users.create' => [PermissionName::CREATE],
        'users.edit' => [PermissionName::UPDATE],
        'users.destroy' => [PermissionName::DELETE],

        'courses.index' => [ PermissionName::VIEW_COURSE],
        'courses.create' => [PermissionName::CREATE_COURSE],
        'courses.edit' => [PermissionName::UPDATE_COURSE],
        'courses.destroy' => [PermissionName::DELETE_COURSE],
    ],
];
