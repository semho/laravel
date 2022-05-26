<?php

namespace App\Policies;

use App\Models\Tiding;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TidingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tiding  $tiding
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Tiding $tiding)
    {
        return  $tiding->owner_id == $user->id || Role::isAdmin($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tiding  $tiding
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Tiding $tiding)
    {
        return  $tiding->owner_id == $user->id || Role::isAdmin($user);
    }

}
