<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = $this->role::all();
        return view('role.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->name;
        $role = Role::create(['name' => $data]);

        return redirect('/roles')->with('success', 'Role created');
    }

    public function showRoleEdit($id)
    {
        $role = Role::findById($id);
        return view('role.update_role', compact('role'));
    }

    public function updateRole(Request $request)
    {
        $role = Role::findById($request->id);
        $role->name = $request->name;
        $role->save();
        return redirect('/roles')->with('success', 'Role updated successfully.');
    }

    public function rolesProperties()
    {
        $roles = $this->role::all();
        $permissions = Permission::all();
        return view('role.properties', compact('roles'), compact('permissions'));
    }

    public function rolesPropertiesUpdate(Request $request)
    {
        $role = Role::findById($request->id);
        $permissions = Permission::all();
        $role_permissions = $request->input('perRoles');
        $array_of_permissions = array();

        if (!empty($role_permissions)) {
            foreach ($role_permissions as $role_permission) {
                $role->givePermissionTo($role_permissions);
            }
            foreach ($permissions as $permission) {
                $array_of_permissions[] = $permission->name;
            }
            $permissions_for_remove = array_merge(array_diff($role_permissions, $array_of_permissions), array_diff($array_of_permissions, $role_permissions));
            foreach ($permissions_for_remove as $permission_for_remove) {
                $role->revokePermissionTo($permission_for_remove);
            }
            return redirect('/roles_and_permissions_properties')->with('properties_updated', 'Properties updated successfully.');
        } else {
            foreach ($permissions as $permission) {
                $role->revokePermissionTo($permission->name);
            }
            return redirect('/roles_and_permissions_properties')->with('properties_updated', 'Properties updated successfully.');
        }
    }
}
