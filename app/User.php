<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * User class
 */
class User extends Authenticatable
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return associated roles for the user
     * @method roles
     * @return Collection
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Checks if the user has a role assigned
     * @method isDefaultUser
     * @return boolean
     */
    public function isDefaultUser()
    {
        return !! !$this->roles()->count();
    }

    /**
     * Assigns a role to the user
     * @method assignRole
     * @param  string     $role String representing a role
     */
    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }

    /**
     * Checks if user is associated with a given role
     * @method hasRole
     * @param  string  $role String representing a role or Class of App\Role
     * @return boolean       Returns wheter user has role or not
     */
    public function hasRole($role)
    {
        if(is_string($role)){
            return $this->roles->contains('name', $role);
        }
        return !! $role->intersection($this->roles)->count();
    }

    public function hasPermission($permission)
    {
        $contains = $this->roles()
        ->with('permissions')
        ->get()
        ->map(function($item) use ($permission){
            return $item->permissions
            ->contains('name', $permission);
        });

        return in_array(true, $contains->toArray());
    }
}
