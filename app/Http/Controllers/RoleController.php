<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('can_access_roles', User::class);

        return view('admin.sites.roles.role_index', [
            'roles' => Role::with('permissions')->get(),
            'permissions' => Permission::where('name', '!=', 'admin')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('can_access_roles', User::class);
        $this->validate($request, [
            'name' => 'required|string|unique:roles|max:20',
            'label' => 'required|string|max:50',
        ], [
            'name.required' => 'Die Berechtigung muss einen Namen haben',
            'label.required' => 'Die Berechtigung muss eine kurze Beschreibung haben'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'label' => $request->label,
        ]);

        if (request()->expectsJson()) {
            return response()->json([
                'status' => 'Rolle wurde hinzugefügt.',
                'role' => Role::with('permissions')->find($role->id)
            ], 200);
        }

        return back();
    }

    public function destroy($id)
    {
        $this->authorize('can_access_roles', User::class);
        Role::destroy($id);

        if (request()->expectsJson()) {
            return response()->json([
                'status' => 'Rolle wurde gelöscht.'
            ], 200);
        }

        return back();
    }
}
