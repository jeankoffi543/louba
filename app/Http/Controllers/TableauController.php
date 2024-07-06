<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class TableauController extends Controller
{


	public function get4adminChart()
	{




		$mtnData = [5000000, 2500000, 500000, 7600000];
		$orgData = [5000000, 2500000, 500000, 7600000];
		$bankData = [5000000, 2500000, 500000, 7600000];
		$rdvPieData = [35, 15, 50];
		$typeServiceData = [5, 3, 92];
		$labels = ['Semaine 1', 'Semaine 2', 'Semaine 3', 'Semaine 4'];
		$rdvPieLabels = ['ACQUITES', 'RDV PRIS', 'EN ATTENTES'];
		$typeServiceLabels = ['VIP', 'SANTE', 'NORMAL'];

		$distributionPasseportData = [13000, 8000, 5000, 10000];



		return view('admin.tableau-dashboard', compact(['mtnData', 'orgData', 'labels', 'bankData', 'rdvPieData', 'rdvPieLabels', 'typeServiceData', 'typeServiceLabels', 'distributionPasseportData']));
	}


	public static function get4admin()
	{
		if (session('infoUser') == Null) return redirect('admin_oni');

		/*
		    $statTodays = DB::table('demande')
		    ->where('date', date('Y-m-d'))
		    ->get();

		    $statYesterdays1 = DB::table('demande')
		    ->where('date', date('Y-m-d')-2)
		    ->get();

		    for( $i=0; $i<10; $i++ )
		    {
			$statDay = DB::table('demande')
			->where('date', date('Y-m-d')-$i)
			->get();
			}
        	//dd($users);
        	*/

		$pointenrollements = DB::table('point_enrolement')->get();
		return view('admin.tableau', ['pointenrollements' => $pointenrollements]);
	}




	public static function statMonthStatut($month, $statut)
	{
		if ($statut == "ALL")
			$stat = DB::table('demande')
				->where('date_rdv_demande', 'LIKE', '%-' . $month . '-%')
				->get();
		else
			$stat = DB::table('demande')
				->where('date_rdv_demande', 'LIKE', '%-' . $month . '-%')
				->where("status_demande", $statut)
				->get();

		return $stat->count();
	}



	public static function statAnneeStatut($annee, $statut)
	{
		if ($statut == "ALL")
			$stat = DB::table('demande')
				->where('date_rdv_demande', 'LIKE', '%' . $annee . '-%')
				->get();
		else
			$stat = DB::table('demande')
				->where('date_rdv_demande', 'LIKE', '%' . $annee . '-%')
				->where("status_demande", $statut)
				->get();

		return $stat->count();
	}




	public static function stat_AnneeStatutPointenrolement($annee, $statut, $id_pointenrolement)
	{
		$stat = DB::table('demande')
			->where('date_rdv_demande', 'LIKE', '%' . $annee . '-%')
			->where("status_demande", $statut)
			->where("id_point_enrolement", $id_pointenrolement)
			->get();

		return $stat->count();
	}

	/*
	$purchases = DB::table('transactions')
    ->join('categories', 'transactions.category_id', '=', 'categories.id')
    ->where('categories.kind', '=', 1)
    ->sum('transactions.amount');
	*/
}
