<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Permission;


class UsersController extends Controller
{
    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->middleware('auth');

    }

    public function show()
    {
        $users = User::all();
        return view('users.all_users', compact('users'));
    }

    public function showUserEdit($id)
    {
        $user = User::find($id);
        $roles = $this->role::all();
        return view('edit', compact('user'), compact('roles'));
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $all_roles = $this->role::all();
        $roles = $request->input('roles');

        if (!empty($roles)) {
            foreach ($roles as $role) {
                $user->assignRole($role);
            }
            foreach ($all_roles as $single_role) {
                $array_of_roles[] = $single_role->name;
            }

            $roles_for_remove = array_merge(array_diff($roles, $array_of_roles), array_diff($array_of_roles, $roles));

            foreach ($roles_for_remove as $role_for_revoke) {
                $user->removeRole($role_for_revoke);
            }
            $user->save();
            return redirect('/all_users')->with('user_updated', 'User updated successfully.');
        } else {
            foreach ($all_roles as $single_role) {
                $user->removeRole($single_role);
            }
            $user->save();
            return redirect('/all_users')->with('user_updated', 'User updated successfully.');
        }
//        if (!empty($request->input('roles'))) {
//            $roles = $request->input('roles');
//            foreach ($roles as $role)
//            {
//                $data->assignRole($role);
//            }
//        }
//        if (!empty($request->input('revokedRoles'))) {
//            $revokedRoles = $request->input('revokedRoles');
//            foreach ($revokedRoles as $revokedRole) {
//                $data->removeRole($revokedRole);
//            }
//        }

//        $data->save();
//        return redirect('/all_users')->with('user_updated', 'User updated successfully.');


    }
}
