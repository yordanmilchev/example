<?php

namespace App\Constant;

/**
 * Class RolesConstant holding all roles as constants
 *
 * @package App\Constant
 */
class RolesConstant
{
    /**
     * Actual role types
     *
     * @var string
     */
    const ROLE_TECHNICAL_ADMINISTRATOR = 'technical_administrator';
    const ADMINISTRATOR = 'administrator';

    /**
     * Maps roles to their description
     *
     * run php artisan synchronize-roles to synchronize roles with DB;
     *
     */
    const ROLE_DESCRIPTIONS = [
        self::ROLE_TECHNICAL_ADMINISTRATOR => '[Технически администратор] Администрира технически настройки на уебсайта. Има всички права.',
        self::ADMINISTRATOR => '[Администратор] Администрира съдържанието на уебсайта.',
    ];
}
