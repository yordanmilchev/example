<?php

namespace App\Constant\Permission;

/**
 * Class PermissionConstant holding all permissions as constants
 *
 * Use following command if add/delete permissions: php artisan synchronize-permissions
 *
 * @package App\Constant
 */
class PermissionBasicConstant
{
    /**
     * Actual permissions
     *
     * @var string
     */
    const PERMISSION_ACCESS_ADMIN_PANEL = 'access_administration_pages';
    const PERMISSION_MANAGE_SYSTEM = 'manage_system';
    const PERMISSION_VIEW_USERS = 'view_users';
    const PERMISSION_MANAGE_ACL = 'manage_acl';
    const PERMISSION_TRANSLATE = 'translate';
    const PERMISSION_MANAGE_USERS = 'manage_users';
//    const PERMISSION_MANAGE_BLOG = 'manage_blog';
    const PERMISSION_MANAGE_PAGES = 'manage_pages';
    const PERMISSION_MANAGE_LAYOUT_BLOCKS = 'manage_layout_blocks';
    const PERMISSION_MANAGE_FILES = 'manage_files';
    const PERMISSION_MANAGE_INQUIRIES = 'manage_inquiries';
    const PERMISSION_MANAGE_GALLERY = 'manage_gallery';
    const PERMISSION_MANAGE_SERVICES = 'manage_services';
    const PERMISSION_MANAGE_ACTIVITIES = 'manage_activities';
    const PERMISSION_MANAGE_HOMEPAGE = 'manage_homepage';




    /**
     * Maps permissions to their description
     *
     * run php artisan synchronize-permissions to synchronize permissions with DB
     *
     */
    const PERMISSION_DESCRIPTIONS = [
        self::PERMISSION_ACCESS_ADMIN_PANEL => 'Минимално, задължително правомощие, за да може даден потребител да има достъп до /admin частта на уебсайта.',
        self::PERMISSION_MANAGE_SYSTEM => 'Най-висше правомощие за работа с уебсайта.',
        self::PERMISSION_VIEW_USERS => 'Достъп до данните на клиентите.',
        self::PERMISSION_MANAGE_ACL => 'Най-висше правомощие за работа с роли.
                        - може да създава, чете, редактира и изтрива роли;
                        Обикновено се дава на роля Administrator.',
        self::PERMISSION_TRANSLATE => 'Правомощие за управление на преводите.',
        self::PERMISSION_MANAGE_USERS => 'Най-висше правомощие за работа с потребители.',
//        self::PERMISSION_MANAGE_BLOG => 'Може да управлява блог статии',
        self::PERMISSION_MANAGE_PAGES => 'Потребителят има правомощия да управлява страници.',
        self::PERMISSION_MANAGE_LAYOUT_BLOCKS => 'Потребителят има правомощие да управлява блокове',
        self::PERMISSION_MANAGE_FILES => 'Може да оперира с медийни файлове от публичната директория',
        self::PERMISSION_MANAGE_INQUIRIES => 'Може да оперира с постъпилите запитвания',
        self::PERMISSION_MANAGE_GALLERY => 'Може да управлява галерията',
        self::PERMISSION_MANAGE_SERVICES => 'Може да управлява списъка с услугите',
        self::PERMISSION_MANAGE_ACTIVITIES => 'Може да управлява списъка с дейсностите',
        self::PERMISSION_MANAGE_HOMEPAGE => 'Може да управлява съдържанието показващо се на началната страница',
    ];
}
