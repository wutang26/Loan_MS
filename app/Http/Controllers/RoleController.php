<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $permissions = Permission::all();
    
        $roles = Role::latest()->paginate(10);

        return view('settings.roles.index', compact('roles','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createRole()
    {
        //Role has permission
        $permissions = Permission::orderBy('module')->get()->groupBy('module');
    
        $roles = Role::all();
        
        return view('settings.roles.create', compact('roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */

  public function storeRole(RoleRequest $request)
{
    // Allow comma-separated role names

    $roles = Role::with('permissions')->get();

     //dd($request->all());

    $roleNames = array_filter(
        array_map('trim', explode(',', $request->lable))
    );

    foreach ($roleNames as $label) {

        $role = Role::firstOrCreate(
            [
                'name'       => Str::slug($label),
                'guard_name' => 'web',
            ],
            [
                'module'      => $request->module ?? null,
                'lable'       => $label,
                'description' => $request->description,
                'is_active'   => $request->is_active,
            ]
        );

        // Sync same permissions to each role
        if ($request->filled('permissions')) {
    $role->syncPermissions(
        Permission::whereIn('id', array_map('intval', $request->permissions))->get()
    );
     return redirect()->route('settings.roles.index', compact('roles'))
        ->with('success', 'Role(s) created successfully');
    }
return redirect()->back()->with('error', 'Role(s) do not  created successfully');
}
}
//    public function storeRole(Request $request)
// {

//     Role::create([
//         'module'      => $request->module,
//         'lable'       => $request->lable,
//         'name'        => Str::slug($request->lable),
//         'description' => $request->description,
//         'is_active'   => $request->is_active,
//         'guard_name'  => 'web', // REQUIRED
//     ]);
//     return redirect()
//         ->route('settings.roles.index')
//         ->with('success', 'Role created successfully');
// }

// Edit Permission
public function editRole(Role $role)
{
    $permissions = Permission::orderBy('module')
        ->get()
        ->groupBy('module');

    return view('settings.roles.edit', compact('role', 'permissions'));
}


// Update Permission


public function updateRole(Request $request, Role $role)
{
    $validated = $request->validate([
        'lable' => 'required|string|max:255',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean',
        'permissions' => 'array',                     //
        'permissions.*' => 'exists:permissions,id',   // 
    ]);

    $role->update([
        'lable' => $validated['lable'],
        'name' => Str::slug($validated['lable']), // 
        'description' => $validated['description'] ?? null,
        'is_active' => $validated['is_active'],
    ]);

      // 🔥 THIS IS IMPORTANT
    // ✅ SAFE SYNC
    if ($request->has('permissions')) {
        $role->permissions()->sync($validated['permissions']);
    }

    return redirect()
        ->route('settings.roles.index')
        ->with('success', 'Role updated successfully');
}

    // $role = Role::findOrFail($role);

    // // Validate all fields
    // $request->validate([
    //     'module'      => 'required|string|max:255',
    //     'lable'       => 'required|string|max:255',
    //     'description' => 'nullable|string',
    //     'is_active'   => 'required|boolean',
    // ]);

    // // Update all fields
    // $role->update([
    //     'module'      => $request->module,
    //     'lable'       => $request->lable,
    //     'name'        => Str::slug($request->lable), // keep slug updated
    //     'description' => $request->description,
    //     'is_active'   => $request->is_active,
    //     // guard_name remains unchanged
    // ]);



    /**
     * Show the form for editing the specified resource.
     */
   public function deleteRole(Role $role)
{
    // Detach all permissions first
    $role->permissions()->detach();

    // Now delete the role
    $role->delete();

    return redirect()
        ->route('settings.roles.index')
        ->with('success', 'Role deleted successfully');
}


    
}
