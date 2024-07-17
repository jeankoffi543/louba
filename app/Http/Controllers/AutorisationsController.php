<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AutorisationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 5);
        //
        $permissions = Permission::paginate($perPage, ['*'], 'page', $page);
        return response()->json([
            'error' => false,
            'data' => $permissions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $permissions = ['create_signalement', 'read_signalement', 'update_signalement', 'edit_signalement', 'delete_signalement', 'read_comment','edit_comment', 'create_comment', 'delete_comment', 'update_comment', 'transfert_signalement', 'class_without_continuation', 'class_without_continuation_callback', 'create_user','edit_user', 'read_user', 'update_user', 'delete_user', 'create_habilete', 'read_habilete', 'update_habilete', 'delete_habilete', 'edit_habilete', 'create_admin', 'edit_admin', 'read_admin', 'update_admin', 'delete_admin', 'create_permission', 'read_permission', 'update_permission', 'delete_permission','edit_permission', 'create_role', 'read_role', 'update_role', 'delete_role','edit_role', 'export_rapport', 'show_dashboard', 'admin_settings'];
        
        $array = [];
        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                $array[] = Permission::create(['name' => $permission]);
            }
        }
        return response()->json([
            'error' => false,
            'data' => $array
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $permission = Permission::findOrFail($id);
        return response()->json([
            'error' => false,
            'data' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        return response()->json([
            'error' => false,
            'data' => $permission
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return response()->json([
            'error' => false,
            'data' => $permission
        ]);
    }
}
