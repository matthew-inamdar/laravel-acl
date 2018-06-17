<?php

namespace App\Enums;

use GoldSpecDigital\PHPEnum\Enum;

class Permissions extends Enum
{
    /*
     * Venue permissions.
     */
    public const VIEW_ALL_VENUES = 'view all venues';
    public const CREATE_ALL_VENUES = 'create all venues';
    public const EDIT_ALL_VENUES = 'edit all venues';
    public const DELETE_ALL_VENUES = 'delete all venues';

    public const VIEW_VENUE = 'view venue';
    public const CREATE_VENUE = 'create venue';
    public const EDIT_VENUE = 'edit venue';
    public const DELETE_VENUE = 'delete venue';

    /*
     * Space permissions.
     */
    public const VIEW_ALL_SPACES = 'view all spaces';
    public const CREATE_ALL_SPACES = 'create all spaces';
    public const EDIT_ALL_SPACES = 'edit all spaces';
    public const DELETE_ALL_SPACES = 'delete all spaces';

    public const VIEW_SPACE = 'view space';
    public const CREATE_SPACE = 'create space';
    public const EDIT_SPACE = 'edit space';
    public const DELETE_SPACE = 'delete space';

    /*
     * Event permissions.
     */
    public const VIEW_ALL_EVENTS = 'view all events';
    public const CREATE_ALL_EVENTS = 'create all events';
    public const EDIT_ALL_EVENTS = 'edit all events';
    public const DELETE_ALL_EVENTS = 'delete all events';

    public const VIEW_EVENT = 'view event';
    public const CREATE_EVENT = 'create event';
    public const EDIT_EVENT = 'edit event';
    public const DELETE_EVENT = 'delete event';
}
