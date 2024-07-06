<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\Models\Habilete;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{

    public function index($id)
    {
        $permissions = Permission::get();
        $groupe = Habilete::with('permissions')->find($id);
        return view('admin.workflow.permission', compact('permissions', 'groupe'));
    }

    public function habiletePermissions(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make(
            $data,
            [
                'habilete_id' => 'required|numeric|exists:habiletes,id',
                'permissions' => 'required|array',
                'permission.*' => 'string|exists:permissions,libelle',
                'action' => 'required|in:add,delete',
            ]
        );
        if ($validator->passes()) {

            if ($data['action'] == 'delete') {
                foreach ($data['permissions'] as $key => $value) {

                    $permission = Permission::where('libelle', $value)->first();
                    if ($permission) {
                        \DB::table('habilete_permission')->where('habilete_id', $data['habilete_id'])->where('permission_id', $permission->id)->delete();
                    }
                    // $permission_id = Permission::where('libelle', $value)->first()->id;

                }
                return response()->json([
                    'error' => false,
                    'message' => "Suppression des permissions effectuée !"
                ], 200);
            } else if ($data['action'] == 'add') {
                \DB::table('habilete_permission')->where('habilete_id', $data['habilete_id'])->delete();
                foreach ($data['permissions'] as $key => $value) {

                    $permission = Permission::where('id', $value)->first();

                    if ($permission) {
                        \DB::table('habilete_permission')->insert(['habilete_id' => $data['habilete_id'], 'permission_id' => $permission->id]);
                    }
                }
                return redirect()->back()->with('success_message', 'Les permissions ont été ajoutées avec succès');
            }
        } else {

            return redirect()->back()->with('error_message', 'Les permissions n\'ont pas étés ajoutées');

        }
    }
}
