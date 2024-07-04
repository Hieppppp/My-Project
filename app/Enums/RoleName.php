<?php
namespace App\Enums;

enum RoleName: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case CUSTOMER = 'customer';
}