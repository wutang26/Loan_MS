<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

       // Get all users with their roles and permissions
        $users = User::with('roles', 'permissions')->get();

        $permissions = auth()->user();

        
        return view('settings.users.index', compact('users', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
   //Create members function
    public function createUser()
    {

        $users = User::all();

         //Get Roles
        $roles = Role::all();

        return view('settings.users.create', compact('users', 'roles'));
    }

    // Store users

public function storeUser(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'status' => 'required|in:active,pending,inactive',
        'date_joined' => 'required|date',
        'role' => 'required|string', // validate role
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'status' => $validated['status'],
        'date_joined' => $validated['date_joined'],
    ]);

    // Assign the role
    $user->assignRole($validated['role']);

    return redirect()
        ->route('settings.users.index')
        ->with('success', 'User created successfully');
}

    /**
     * Store a newly created resource in storage.
     */
    //Edit Function
    public function editUser(string $id)
    {

        $user = User::find($id);

        return view('settings.users.edit', compact('user'));
    }
public function updateUser(Request $request, string $id)

{

    //dd($request->all());
    // Validate input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'usertype' => 'required|string|max:255',
        // 'date_joined' => 'required|date',
        'status' => 'required|string|max:255',
        'password' => 'nullable|min:6', // optional now
    ]);

    // Find the user
    $user = User::findOrFail($id);

    // Update fields
    $user->name = $request->name;
    $user->email = $request->email;
    $user->usertype = $request->usertype;
    //$user->date_joined = $request->date_joined;
    $user->status = $request->status;

    // Update password only if provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // Save changes
    $user->save();

    return redirect()->route('settings.users.index')
                     ->with('success', 'User updated successfully');
}


    //Delete a member 
    public function deleteUser($id)
        {
            $user = User::findOrFail($id);
            $user->delete();

    return redirect()
        ->route('settings.users.index')
        ->with('success', 'User deleted successfully');
    }


}
