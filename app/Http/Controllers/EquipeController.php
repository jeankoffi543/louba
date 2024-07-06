<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipeController extends Controller
{


    public static function getTeams()
    {

        return view('visiteur.equipe', [
            'equipes' => Equipe::all(),
        ]);
    }


    public static function insert(Request $request)
    {
        User::insert([
            'nom' => $request->nom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => 123456,
            'id_role' => $request->id_role,
            'id_point_enrolement' => $request->id_point_enrolement,
        ]);

        return redirect(route('user'));

    }


    //
    public static function update(Request $request)
    {

        User::where('id', $request->id)
            ->update([
                'nom' => $request->nom,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'password' => 123456,
                'id_role' => $request->id_role,
                'id_point_enrolement' => $request->id_point_enrolement,
            ]);

        return redirect(route('user'));
    }


}
