<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PermissionName extends Enum
{
    const VIEWANY = 'viewAny';
    const VIEW = 'view';
    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';
    const RESTORE = 'restore';
    const FORCEDELETE = 'forceDelete';

    // const VIEWANY_USER ='viewany_user';

    // const VIEW_USER = 'view_user';

    // const CREATE_USER = 'create_user';

    // const UPDATE_USER = 'update_user';

    // const DELETE_USER = 'delete_user';

    const VIEW_COURSE = 'view_course';

    const VIEWANY_COURSE = 'viewany_course';

    const CREATE_COURSE = 'create_course';

    const UPDATE_COURSE = 'update_course';

    const DELETE_COURSE = 'delete_course';
    const RESTORE_COURSE = 'restore_course';

    const FORCEDELETE_COURSE = 'forcedelete_course';


}
