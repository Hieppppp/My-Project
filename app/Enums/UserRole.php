<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserRole extends Enum
{
    const ADMIN = 'admin';
    const USER = 'user';
    const CUSTOMER = 'customer';

    public static function ADMIN(): UserRole
    {
        return new UserRole(self::ADMIN);
    }

    public static function USER(): UserRole
    {
        return new UserRole(self::USER);
    }

    public static function CUSTOMER(): UserRole
    {
        return new UserRole(self::CUSTOMER);
    }
}
