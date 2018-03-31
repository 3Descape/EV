<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\PasswordResetNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    /**
     * Returns all associated roles for a user
     * @method roles
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Checks if user has a role associated
     * @method isDefaultUser
     * @return boolean
     */
    public function isDefaultUser()
    {
        return !!!$this->roles()->count();
    }

    /**
     * Associates a given role with a user
     * @method assignRole
     * @param  App\Role
     * @return App\Role
     */
    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }

    /**
     * Checks if the user has a certain role
     * @method hasRole
     * @param  App\Role or String
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !!$this->roles()->get()->where('id', $role->id)->count();
    }

    /**
     * Checks if the user has a certain permission associated
     * @method hasPermission
     * @param string
     * @return boolean
     */
    public function hasPermission($permission)
    {
        $contains = $this->roles()
        ->with('permissions')
        ->get()
        ->map(function ($item) use ($permission) {
            return $item->permissions
            ->contains('name', $permission);
        });

        return in_array(true, $contains->toArray());
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }
}
