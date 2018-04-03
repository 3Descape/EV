<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use App\Permission;

class ActAsUser
{
    public $user;

    public function __construct(User $user = null)
    {
        $this->user = $user ?? factory(User::class)->create();
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUpPermission($permission)
    {
        if (is_string($permission)) {
            $permission_instance = Permission::create([
               'name' => $permission,
               'label' => 'Some permission'
           ]);
        } elseif ($permission instanceof Permission) {
            $permission_instance = $permission;
        } else {
            throw new Exception("Argument was not a string or instance of App\Permission");
        }

        $role = Role::create([
           'name' => 'some name',
           'label' => 'Some role'
       ]);

        $role->permissions()->save($permission_instance);

        $this->user->assignRole($role);

        return $this;
    }
}
