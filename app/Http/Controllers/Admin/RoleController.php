<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index' , compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required' , 'min:3' , 'unique:roles']]);
        Role::create($validated);
        return to_route('admin.roles.index')->with('message' , 'Role created successfully!');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit' , compact('role' , 'permissions'));
    }

    public function update(Request $request , Role $role)
    {
        $validated = $request->validate(['name' => ['required' , 'min:3']]);

        $role->update($validated);
        return to_route('admin.roles.index')->with('message' , 'Role updated successfully!');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('message' , 'Role Deleted Successfully!');
    }

    public function givePermission(Request $request , Role $role)
    {
        if ($role->hasPermissionTo($request->permission)){
            return back()->with('message' , 'permission exists');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message' , 'permission added');
    }

    public function revokePermission(Role $role , Permission $permission)
    {
        if ($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message' , 'permission revoke');
        }
        return back()->with('message' , 'permission not exists');
    }

}
