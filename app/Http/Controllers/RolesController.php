<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Permission;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $this->authorize('admin', User::class);

        return view('admin.sites.roles.role_index', [
            'roles' => Role::with('permissions')->get(),
            'permissions' => Permission::where('name', '!=', 'admin')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('admin', User::class);
        $this->validate($request, [
            'name' => 'required|string|unique:roles|max:20',
            'label' => 'required|string|max:50',
        ], [
            'name.required' => 'Die Berechtigung muss einen Namen haben',
            'label.required' => 'Die Berechtigung muss eine kurze Beschreibung haben'
        ]);

        Role::create([
            'name' => $request->name,
            'label' => $request->label,
        ]);

        return back();
    }

    public function destroy($id)
    {
        $this->authorize('admin', User::class);
        Role::destroy($id);

        return back();
    }

    public function destroy_permission(Role $role, $permission_id)
    {
        $this->authorize('admin', User::class);
        $role->permissions()->detach($permission_id);

        return back();
    }
}
