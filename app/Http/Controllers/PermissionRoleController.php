<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Permission;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    public function store(Request $request, Role $role, Permission $permission)
    {
        $this->authorize('can_access_roles', User::class);
        $role->permissions()->save($permission);

        if (request()->expectsJson()) {
            return response()->json([
                'status' => 'Berechtigung wurde hinzugefügt.'
            ], 200);
        }

        return back();
    }

    public function destroy(Role $role, $permission_id)
    {
        $this->authorize('can_access_roles', User::class);
        $role->permissions()->detach($permission_id);

        if (request()->expectsJson()) {
            return response()->json([
                'status' => 'Berechtigung wurde gelöscht.'
            ], 200);
        }

        return back();
    }
}
