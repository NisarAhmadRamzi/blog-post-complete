<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Artisan;

class RoleController extends Controller
{
    public function index()
    {
        return view('backend.role.index')
            ->with('roles', Role::paginate(10));
    }

    public function create()
    {
        return view('backend.role.create');
    }

    public function store(Request $request)
    
    {
        
        $field = $request->validate([
            'name' => 'required'
        ]);
        Role::create($field);

        return redirect()->route('role.index');
    }





    // Show the role and its assigned permissions
    public function show($id)
    {
        $role = Role::findOrFail($id); // Find the role by ID or fail if not found
        $permissions = Permission::all(); // Retrieve all available permissions
        $rolePermissions = $role->permissions->pluck('id')->toArray(); // Get an array of current permission IDs for the role
        

        return view('backend.role.show')
            ->with('permissions', $permissions)
            ->with('role_id', $role->id) // Pass the role ID
            ->with('rolePermissions', $rolePermissions); // Pass the current permissions
    }



    // Update the role's permissions
    public function update(Request $request, $id) {
        // Validate the request to ensure 'permission' is an array and is required
        
        $request->validate([
            'permission' => 'required|array'
        ]);
    
        // Find the role by ID, or fail if not found
        $role = Role::findOrFail($id);
    
        // Sync the role's permissions with the selected permissions in the request
        $role->permissions()->sync($request->permission);
    
        // Clear permission and role cache
        Artisan::call('permission:cache-reset');
    
        // Redirect to the role index page with a success message
        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }
}
