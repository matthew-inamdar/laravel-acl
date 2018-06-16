<?php

namespace App\Enums;

use GoldSpecDigital\PHPEnum\Enum;

class Roles extends Enum
{
    public const SUPER_ADMIN = 'super admin';
    public const ORGANISATION_ADMIN = 'organisation admin';
    public const EVENT_ORGANISER = 'event organiser';
}
