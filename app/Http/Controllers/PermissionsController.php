<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * @var Permission
     */
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
        $this->middleware('auth');
    }

    public function index()
    {
        $permissions = $this->permission::all();
        return view('permission.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        $data = $request->name;
        $permission = Permission::create(['name' => $data]);

        return redirect('/permissions')->with('success', 'Permission created');
    }

    public function showAllPermissions()
    {
        $permissions = Permission::all();
        return view('permission.index', compact('permissions'));
    }

    public function edit($id)
    {
        $permission = Permission::findById($id);
        return view('permission.update_permission', compact('permission'));
    }

    public function update(Request $request)
    {
        $permission = Permission::findById($request->id);
        $permission->name = $request->name;
        $permission->save();
        return redirect('/permissions')->with('success', 'Permission updated successfully.');
    }
}
