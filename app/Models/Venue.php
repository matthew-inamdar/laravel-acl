<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venue extends Model
{
    /**
     * @var array The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function spaces(): HasMany
    {
        return $this->hasMany(Space::class);
    }

    /**
     * @param \App\Models\User $user
     * @return bool
     */
    public function belongsToUser(User $user): bool
    {
        return $user->venue_id === $this->id;
    }
}
