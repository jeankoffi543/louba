<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoleController extends Controller
{




    public static function get()
    {

        $roles = Role::latest()->get();

        return view('admin.role', compact('roles'));
    }


    public static function insert(Request $request)
    {
        DB::table('role')->insert([
            'nom_role' => $request->nom_role,
            'description_role' => $request->description_role,
        ]);

        return redirect()->back()->with('success_message', 'Le role a été ajouté avec succès');
    }


    //
    public static function update(Request $request, Role $role)
    {

        try {
            $role->nom_role = $request->nom_role;
            $role->description_role = $request->description_role;

            $role->update();
            return redirect()->back()->with('success_message', 'Le role a été mis à jour avec succès');
        } catch (Exception $e) {
            dd($e);
        }
    }
}
