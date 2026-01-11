<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Show Permissions
         //Fetch all permissions from model 
         $permissions = Permission::latest()->get();

        return view('settings.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createPermission()
    {
        //
        $permissions = Permission::all();

        
        return view('settings.permissions.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * Hence! Hii inasaidia tuweze kusubmit multiple values mf. Assigning multiple feature or permission groups to a single Module Eg. Accountant can view report, edit report, delete report.
     */
 
public function storePermission(PermissionRequest $request)
{
    // Split permissions by comma
    $permissions = explode(',', $request->permissions);

    foreach ($permissions as $permission) {
        $label = trim($permission);

        // Skip empty values
        if ($label === '') {
            continue;
        }

        Permission::firstOrCreate(
            [
                'name'       => Str::slug($label),
                'guard_name' => 'web',
            ],
            [
                'module'      => $request->module,
                'lable'       => $label,
                'description' => $request->description,
                'is_active'   => $request->is_active,
            ]
        );
    }

    return redirect()
        ->route('settings.permissions.index')
        ->with('success', 'Permissions created successfully for the module');
}

// Edit Permission
public function editPermission(string $id)
{
    $permission = Permission::findOrFail($id); // safer than find
    return view('settings.permissions.edit', compact('permission'));
}

// Update Permission
public function updatePermission(Request $request, string $id)
{
    $permission = Permission::findOrFail($id);

    // Validate all fields
    $request->validate([
        'module'      => 'required|string|max:255',
        'lable'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'is_active'   => 'required|boolean',
    ]);

    // Update all fields
    $permission->update([
        'module'      => $request->module,
        'lable'       => $request->lable,
        'name'        => Str::slug($request->lable), // keep slug updated
        'description' => $request->description,
        'is_active'   => $request->is_active,
        // guard_name remains unchanged
    ]);

    return redirect()->route('settings.permissions.index')
        ->with('success', 'Permission updated successfully');
}

    /**
     * Show the form for editing the specified resource.
     */
    public function deletePermission($id)
    {
        $permissions = Permission::findOrFail($id);
        $permissions->delete();

        return redirect()
            ->route('settings.permissions.index')
            ->with('success', 'Permission deleted successfully');
    }

    
}
