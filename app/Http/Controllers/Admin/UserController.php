<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // Assign Roles and Permissions 
  
  public function index()
    {
        $users = User::all();

        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'));
    }


    //Controller Method assigning Roles and Permission
public function assignRole(Request $request, User $user)
{
    $request->validate([
        'role' => 'required|exists:roles,name'
    ]);

    $user->syncRoles([$request->role]);

    return back()->with('success', 'Role updated');
}
}


