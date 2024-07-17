<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReclammationController extends Controller
{


  	public static function getdata(){
  		return DB::table('reclammation')->get();
  	}

    public static function get()
    {
    if( session('infoUser') == Null )return redirect('admin_oni');
        $roles = self::getdata();

        //dd($role);
        return view('admin.role', [
        			'roles'=>$roles,
        			]);
    }


    public static function insert(Request $request)
    {
    	DB::table('reclammation')->insert([
   		  'nom_role' => $request->nom_role,
  		  'description_role' => $request->description_role,
		]);

	return redirect('/role');

    }


    //
    public static function traiter(Request $request)
    {

        DB::table('reclammation')
         ->where('id', $request->id)
         ->update([
   		 'traiter' => "oui",
   		 'status' => $request->status,
   		 'date_traitement' => date('Y-m-d H:i'),
         ]);

        return redirect('/reclammation');
    }



}
