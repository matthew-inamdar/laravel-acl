<?php

namespace App\Policies;

use App\Enums\Permissions;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Auth\Access\HandlesAuthorization;

class VenuePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view all venues.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function index(User $user)
    {
        return $user->hasPermissionTo(Permissions::VIEW_ALL_VENUES, 'api');
    }

    /**
     * Determine whether the user can view the venue.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Venue $venue
     * @return bool
     */
    public function view(User $user, Venue $venue)
    {
        if ($user->hasPermissionTo(Permissions::VIEW_ALL_VENUES, 'api')) {
            return true;
        }

        if ($user->hasPermissionTo(Permissions::VIEW_VENUE, 'api') && $venue->belongsToUser($user)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create venues.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo(Permissions::CREATE_VENUE, 'api');
    }

    /**
     * Determine whether the user can update the venue.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Venue $venue
     * @return bool
     */
    public function update(User $user, Venue $venue)
    {
        if ($user->hasPermissionTo(Permissions::EDIT_ALL_VENUES, 'api')) {
            return true;
        }

        if ($user->hasPermissionTo(Permissions::EDIT_VENUE, 'api') && $venue->belongsToUser($user)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the venue.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Venue $venue
     * @return bool
     */
    public function delete(User $user, Venue $venue)
    {
        if ($user->hasPermissionTo(Permissions::DELETE_ALL_VENUES, 'api')) {
            return true;
        }

        if ($user->hasPermissionTo(Permissions::DELETE_VENUE, 'api') && $venue->belongsToUser($user)) {
            return true;
        }

        return false;
    }
}
