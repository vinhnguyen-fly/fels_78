<?php

namespace FELS\Entities\Traits;

use FELS\Entities\Relationship;

trait FollowableTrait
{
    /**
     * The active relations between current user and other users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activeRelations()
    {
        return $this->hasMany(Relationship::class, 'follower_id');
    }

    /**
     * The list of users that are followed by current user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function following()
    {
        return $this->belongsToMany(static::class, 'follows', 'follower_id', 'followed_id')
            ->withTimestamps();
    }

    /**
     * The passive relations between current user and other users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function passiveRelations()
    {
        return $this->hasMany(Relationship::class, 'followed_id');
    }

    /**
     * The list of users that follow the current user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(static::class, 'follows', 'followed_id', 'follower_id')
            ->withTimestamps();
    }

    /**
     * Check if the current user is followed by another user.
     *
     * @param $user
     * @return bool
     */
    public function isFollowedBy($user)
    {
        return $this->passiveRelations()->where('follower_id', $user->id)->exists();
    }

    /**
     * Check if the current user is following another user.
     *
     * @param $user
     * @return bool
     */
    public function isFollowing($user)
    {
        return $this->activeRelations()->where('followed_id', $user->id)->exists();
    }
}
