<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    public function store(Request $request)
    {
        $this->authorize('admin', User::class);
        $permission = Permission::find($request->permission);
        Role::find($request->role_id)->permissions()->save($permission);

        return back();
    }
}
