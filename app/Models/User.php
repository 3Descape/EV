<?php

namespace App\Models;

use App\Notifications\PasswordResetNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $admin_delte_exception = 'Es muss immer <strong>mindestens ein Administrator bestehen </strong>.
                                    Bitte geben Sie einem anderen Nutzer zuerst die Administratorrechte!';

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isDefaultUser()
    {
        return !((bool)$this->roles()->count());
    }

    public function assignRole($role)
    {
        if (is_string($role)) {
            return $this->roles()->save(
                Role::whereName($role)->firstOrFail()
            );
        }

        return $this->roles()->save($role);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !!$this->roles()->get()->where('id', $role->id)->count();
    }

    public function isAdmin()
    {
        return $this->hasRole(Role::ADMIN_ROLE_NAME);
    }

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
