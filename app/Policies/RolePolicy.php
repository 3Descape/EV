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

    public function before(User $user)
    {
        if ($user->hasRole('administrator')) {
            return true;
        }
    }

    public function admin(User $user)
    {
        return $user->hasRole('admin');
    }

    public function can_access_events(User $user)
    {
        return $user->hasPermission('access_events');
    }

    public function can_access_sites(User $user)
    {
        return $user->hasPermission('access_sites');
    }

    public function can_access_people(User $user)
    {
        return $user->hasPermission('access_people');
    }

    public function can_access_pictures(User $user)
    {
        return $user->hasPermission('access_pictures');
    }

    public function can_access_dashboard(User $user)
    {
        return !$user->isDefaultUser();
    }

    public function can_access_roles(User $user)
    {
        return $user->hasPermission('access_roles');
    }

    public function can_access_files(User $user)
    {
        return $user->hasPermission('access_files');
    }

    public function can_access_fixtures(User $user)
    {
        return $user->hasPermission('access_fixtures');
    }
}
