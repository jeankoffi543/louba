<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SelectServiceController extends Controller
{
    //

    public static function articleService($tag)
    {
        $article = DB::table('contenu_site')
        ->where('tagDur',$tag)
        ->first();
        return view('visiteur.service', ['article'=>$article]);
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




        public static function getdata_seervice()
    {
         return DB::table('select_service')->get();

    }

    public static function get4admin_seervice()
    {if( session('infoUser') == Null )return redirect('admin_oni');

         $seervices = DB::table('select_service')->get();

        return view('admin.seervice', [
        			'seervices' => $seervices,
        			]);

    }


    public static function delete4admin_seervice($id)
    {if( session('infoUser') == Null )return redirect('admin_oni');

        DB::table('select_service')
        ->where('id_product', $id)
        ->delete();

        return redirect('seervice');

    }


    public static function add4admin_seervice(Request $request)
    {if( session('infoUser') == Null )return redirect('admin_oni');

        $file1 = $request->file('newimage1');
	    $extension_ban = ['php'];
	   	if(  in_array($file1->getClientOriginalExtension(), $extension_ban))
	   	{
	   		return redirect('seervice')->with('flashMessage', "Mauvaise extension du fichier ");
	   	}
	   	else
	   	{
			//Move Uploaded File
	     	$namefile1 = time().'-'.$file1->getClientOriginalName();
	      	$destinationPath = 'uploads/';
	      	$file1->move($destinationPath,$namefile1);

	   	}

        DB::table('select_service')
         ->insert([
   		  'nom_type_document' => $request->nom,
  		  'descrption_type_document' => $request->description,
  		  'image_type_document' => $namefile1,
         ]);

        return redirect('seervice');

    }


    public static function modify4admin_seervice(Request $request)
    {if( session('infoUser') == Null )return redirect('admin_oni');

        DB::table('select_services')
         ->where('id_type_document', $request->id)
         ->update([
   		  'nom_type_document' => $request->nom,
  		  'descrption_type_document' => $request->description,
  		  'image_type_document' => $namefile1,
         ]);

        return redirect('seervice');

    }




    public static function modifyimage4admin_seervice(Request $request)
    {if( session('infoUser') == Null )return redirect('admin_oni');

    	$file1 = $request->file('newimage1');
	    $extension_ban = ['php'];
	   	if(  in_array($file1->getClientOriginalExtension(), $extension_ban) )
	   	{
	   		return redirect('seervice')->with('flashMessage', "Mauvaise extension du fichier ");
	   	}
	   	else
	   	{
			//Move Uploaded File
	     	$namefile1 = time().'-'.$file1->getClientOriginalName();
	      	$destinationPath = 'uploads/';
	      	$file1->move($destinationPath,$namefile1);
	   	}

        DB::table('select_service')
         ->where('id_type_document', $request->id)
         ->update([
   		  'image_type_document' => '/'.$destinationPath.$namefile1,
         ]);

        return redirect('seervice');

    }



    public static function modifysecondimage4admin_seervice(Request $request)
    {if( session('infoUser') == Null )return redirect('admin_oni');

    	$file1 = $request->file('newimage1');
	    $extension_ban = ['php'];
	   	if(  in_array($file1->getClientOriginalExtension(), $extension_ban) )
	   	{
	   		return redirect('seervice')->with('flashMessage', "Mauvaise extension du fichier ");
	   	}
	   	else
	   	{
			//Move Uploaded File
	     	$namefile1 = time().'-'.$file1->getClientOriginalName();
	      	$destinationPath = 'uploads/';
	      	$file1->move($destinationPath,$namefile1);
	   	}

        DB::table('select_services')
         ->where('id_type_document', $request->id)
         ->update([
   		  'image_type_document' => '/'.$destinationPath.$namefile1,
         ]);

        return redirect('seervice');
    }
}
