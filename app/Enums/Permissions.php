<?php

namespace App\Enums;

use GoldSpecDigital\PHPEnum\Enum;

class Permissions extends Enum
{
    public const VIEW_ALL_VENUES = 'view all venues';
    public const VIEW_OWN_VENUE = 'view own venue';
    public const CREATE_VENUES = 'create venue';
    public const EDIT_ALL_VENUES = 'edit all venues';
    public const EDIT_OWN_VENUE = 'edit own venue';
    public const DELETE_ALL_VENUES = 'delete all venues';
    public const DELETE_OWN_VENUE = 'delete own venue';
}
