<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isDefaultUser()
    {
        return !! !$this->roles()->count();
    }

    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }

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
