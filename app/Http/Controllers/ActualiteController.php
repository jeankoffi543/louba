<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ActualiteController extends Controller
{

    public static function getdata()
    {
		$actualites = DB::table('contenu_site')
        ->where('type','actualite')
        ->orderBy('id','DESC')
        ->get();
    	return $actualites;
    }


    public static function oneActicle($id)
    {
        $actualite = DB::table('contenu_site')
            ->where('id', $id)
            ->first();

        $actualiteCounter = DB::table('contenu_site')
            ->where('id', $id)
            ->get();

        //dd($actualiteCounter->count());

        if ($actualiteCounter->count() == 0) return redirect('/actualite');

        return view('visiteur.actualiteLire', ['actualite' => $actualite]);
    }


    public static function getActualities()
    {
        $actualites = DB::table('contenu_site')
            ->where('type', 'actualite')
            ->orderBy('id', 'DESC')
            ->get();

        return view('visiteur.actualite', [
            'actualites' => $actualites,
        ]);
    }


    public static function insert(Request $request)
    {
    	DB::table('users')->insert([
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

        DB::table('users')
         ->where('id', $request->id)
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
