<?php

namespace App\Policies;
use App\Models\Trip;
use App\Models\User;
class TripPolicy
{
    public function view(User $user, Trip $trip)
    {
        return $user->id === $trip->user_id || $trip->collaborators()->where('user_id', $user->id)->exists();
    }
    public function update(User $user, Trip $trip)
    {
        return $user->id === $trip->user_id;
    }
    public function delete(User $user, Trip $trip)
    {
        return $user->id === $trip->user_id;
    }
}