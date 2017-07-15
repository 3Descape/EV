<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('admin.sites.roles.show', [
            'roles' => $roles,
            'permissions' => $permissions,
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
        ],
        ['name.required' => 'Die Berechtigung muss einen Namen haben',
        'name.unique' => 'Der Name darf nicht zwei Mal vorkommen',
        'name.max' => 'Der Name darf maximal 20 Zeichen haben',
        'label.required' => 'Die Berechtigung muss eine kurze Beschreibung haben',
        'label.max' => 'Die Beschreibung darf maximal 50 Zeichen haben',
        ]

        );

        Role::create([
            'name' => strtolower($request->name),
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
