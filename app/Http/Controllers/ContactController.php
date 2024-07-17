<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContactController extends Controller
{



    public static function get()
    {
        //$type_documents = DB::table('products')->get();
        //return $type_documents;
       # dd($type_documents);
       return view('visiteur.contact', [
       		'type_documents' => 'type_documents',
        			]);
    }


    public static function insert(Request $request)
    {
    	DB::table('contact')->insert([
   		 'nom_prenom' => $request->nom_prenom,
  		  'email' => $request->email,
  		  'telephone' => $request->telephone,
  		  'sujet' => $request->sujet,
  		  'message' => $request->message,
		]);

	return redirect(route('contact'));

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
