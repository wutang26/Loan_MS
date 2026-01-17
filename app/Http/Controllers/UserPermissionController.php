<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserPermissionController extends Controller
{

    // Show list of users and their permissions
    public function index()
    {
        $users = User::all(); // or paginate for big datasets
        return view('admin.users.index', compact('users'));
    }

    // Assign permissions to a single user
    public function assignPermissions(Request $request, User $user)
    {
        // Example permissions to assign
        $permissions = ['apply loan', 'view loans'];

        $user->givePermissionTo($permissions);

        return redirect()->back()->with('success', 'Permissions assigned successfully!');
    }
}

    
