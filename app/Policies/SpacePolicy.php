<?php

namespace App\Policies;

use App\Enums\Permissions;
use App\Models\User;
use App\Models\Space;
use App\Models\Venue;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpacePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view all spaces.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Venue $venue
     * @return bool
     */
    public function index(User $user, Venue $venue)
    {
        if ($user->hasPermissionTo(Permissions::VIEW_ALL_SPACES)) {
            return true;
        }

        if ($user->hasPermissionTo(Permissions::VIEW_SPACE) && $venue->belongsToUser($user)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the space.
     *
     * @param \App\Models\User  $user
     * @param \App\Models\Space  $space
     * @return bool
     */
    public function view(User $user, Space $space)
    {
        if ($user->hasPermissionTo(Permissions::VIEW_ALL_SPACES)) {
            return true;
        }

        if ($user->hasPermissionTo(Permissions::VIEW_SPACE) && $space->belongsToUser($user)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create spaces.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Venue $venue
     * @return bool
     */
    public function create(User $user, Venue $venue)
    {
        if ($user->hasPermissionTo(Permissions::CREATE_ALL_SPACES)) {
            return true;
        }

        if ($user->hasPermissionTo(Permissions::CREATE_SPACE) && $venue->belongsToUser($user)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the space.
     *
     * @param \App\Models\User  $user
     * @param \App\Models\Space  $space
     * @return bool
     */
    public function update(User $user, Space $space)
    {
        if ($user->hasPermissionTo(Permissions::EDIT_ALL_SPACES)) {
            return true;
        }

        if ($user->hasPermissionTo(Permissions::EDIT_SPACE) && $space->belongsToUser($user)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the space.
     *
     * @param \App\Models\User  $user
     * @param \App\Models\Space  $space
     * @return bool
     */
    public function delete(User $user, Space $space)
    {
        if ($user->hasPermissionTo(Permissions::DELETE_ALL_SPACES)) {
            return true;
        }

        if ($user->hasPermissionTo(Permissions::DELETE_SPACE) && $space->belongsToUser($user)) {
            return true;
        }

        return false;
    }
}
