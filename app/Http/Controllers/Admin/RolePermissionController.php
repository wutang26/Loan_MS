<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\AuditLog;

class RolePermissionController extends Controller
{
    //Show Roles and Permissions
     public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.roles.permissions', compact('roles', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $permissions = $request->permissions ?? [];

        $role->syncPermissions($permissions);

        AuditLog::create([
    'performed_by' => auth()->id(),
    'action' => 'update_permissions',
    'target_type' => 'Role',
    'target_id' => $role->id,
    'description' => 'Updated permissions for role '.$role->name,
]);

        return back()->with('success', 'Permissions updated successfully');
    }
}
