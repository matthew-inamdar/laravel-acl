<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    /**
     * @var array The attributes that are mass assignable.
     */
    protected $fillable = [
        'space_id',
        'name',
        'start_at',
        'duration_in_minutes',
    ];

    /**
     * @var array The dates to cast.
     */
    protected $dates = [
        'start_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class);
    }

    /**
     * @param \App\Models\User $user
     * @return bool
     */
    public function belongsToUser(User $user): bool
    {
        return $user->venue_id === $this->space->venue_id;
    }
}
