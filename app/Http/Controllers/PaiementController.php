<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PaiementController extends Controller
{




	public static function cinetpayNotifyJs($id)
	{
		DB::table('users')->insert([
			'nom' => $request->message,
			'email' => 1,
			'telephone' => 1,
			'password' => 123456,
			'id_role' => 1,
			'id_point_enrolement' => 1,
		]);

		return redirect('/users');
	}

	public static function cinetpayNotify(Request $request)
	{
		DB::table('users')->insert([
			'nom' => $request->message,
			'email' => 1,
			'telephone' => 1,
			'password' => 123456,
			'id_role' => 1,
			'id_point_enrolement' => 1,
		]);

		return redirect('/users');
	}


	public static function get()
	{
		$paiements = DB::table('paiement')->get();

		return view('admin.paiement', [
			'paiements' => $paiements,
		]);
	}


	public static function index()
	{
		$paiements = DB::table('paiement')->get();
		return view('admin.paiement', [
			'paiements' => $paiements,
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

		return redirect('/users');
	}
}
