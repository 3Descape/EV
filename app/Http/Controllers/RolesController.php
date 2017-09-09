<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        return view('admin.sites.roles.show', [
            'roles' => Role::with('permissions')->get(),
            'permissions' => Permission::where('name', '!=', 'admin')->get(),
        ]);
    }

    public function add_permission(Request $request)
    {
        $permission = Permission::find($request->permission);
        Role::find($request->role_id)->permissions()->save($permission);
        return back();
    }

    public function store(Request $request)
    {
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
        Role::destroy($id);
        return back();
    }

    public function destroy_permission(Role $role, $permission_id)
    {
        $role->permissions()->detach($permission_id);
        return back();
    }
}
