<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Role Policy
 */
class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    public function before()
    {
        //
    }

    public function admin(User $user)
    {
        return $user->hasRole('admin');
    }

    public function can_create_event(User $user)
    {
        return $user->hasPermission('create_event');
    }
}
