<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index' , compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required' , 'min:3' , 'unique:permissions']]);
        Permission::create($validated);
        return to_route('admin.permission.index')->with('message' , 'Permission created successfully!');
    }

    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('admin.permissions.edit' , compact('permission' , 'roles'));
    }

    public function update(Request $request , Permission $permission)
    {
        $validated = $request->validate(['name' => ['required' , 'min:3']]);
        $permission->update($validated);
        return to_route('admin.permission.index')->with('message' , 'Permission updated successfully!');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return back()->with('message' , 'Permission Deleted successfully!');
    }

    public function assignRole(Request $request , Permission $permission)
    {
        if ($permission->hasRole($request->role)){
            return back()->with('message' , 'Role exists.');
        }
        $permission->assignRole($request->role);
        return back()->with('message' , 'Role Assigned.');
    }

    public function removeRole(Permission $permission , Role $role)
    {
        if ($permission->hasRole($role)){
            $permission->removeRole($role);
            return back()->with('message' , 'Role removed.');
        }
        return back()->with('message' , 'Role is not exists.');
    }
}
