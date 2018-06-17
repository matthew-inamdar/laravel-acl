<?php

namespace App\Policies;

use App\Enums\Permissions;
use App\Models\Space;
use App\Models\User;
use App\Models\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view all events.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Space $space
     * @return bool
     */
    public function index(User $user, Space $space)
    {
        if ($user->hasPermissionTo(Permissions::VIEW_ALL_EVENTS)) {
            return true;
        }

        if ($user->hasPermissionTo(Permissions::VIEW_EVENT) && $space->belongsToUser($user)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function view(User $user, Event $event)
    {
        if ($user->hasPermissionTo(Permissions::VIEW_ALL_EVENTS)) {
            return true;
        }

        if ($user->hasPermissionTo(Permissions::VIEW_EVENT) && $event->belongsToUser($user)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create events.
     *
     * @param  \App\Models\User $user
     * @param \App\Models\Space $space
     * @return mixed
     */
    public function create(User $user, Space $space)
    {
        if ($user->hasPermissionTo(Permissions::CREATE_ALL_EVENTS)) {
            return true;
        }

        if ($user->hasPermissionTo(Permissions::CREATE_EVENT) && $space->belongsToUser($user)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function update(User $user, Event $event)
    {
        if ($user->hasPermissionTo(Permissions::EDIT_ALL_EVENTS)) {
            return true;
        }

        if ($user->hasPermissionTo(Permissions::EDIT_EVENT) && $event->belongsToUser($user)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function delete(User $user, Event $event)
    {
        if ($user->hasPermissionTo(Permissions::DELETE_ALL_EVENTS)) {
            return true;
        }

        if ($user->hasPermissionTo(Permissions::DELETE_EVENT) && $event->belongsToUser($user)) {
            return true;
        }

        return false;
    }
}
