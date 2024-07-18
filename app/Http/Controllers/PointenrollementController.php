<?php

namespace App\Http\Controllers;

use App\Models\PointEnrolement;
use App\Models\PointEnrolementLienTypeDocument;
use App\Models\PointEnrolementProduct;
use App\Models\Product;
use App\Models\PublicHoliday;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointenrollementController extends Controller
{


    public static function get()
    {
        $pointenrollements = PointEnrolement::with('services')->get();
        $jourferiers = PublicHoliday::all();
        $produits = Service::all();
        $produits_lk = []; // DB::table('point_enrolement_lien_type_document')->get()

        //dd($users);
        return view('admin.pointenrollement.index', [
            'pointenrollements' => $pointenrollements,
            'jourferiers' => $jourferiers,
            'produits' => $produits,
            'produits_lk' => $produits_lk,
        ]);
    }


    public static function index()
    {

        $pointenrollements = PointEnrolement::with('services')->get();
        $jourferiers = PublicHoliday::all();
        $produits = Service::all();
        $produits_lk = []; // DB::table('point_enrolement_lien_type_document')->get()

        //dd($users);


        return view('admin.pointenrollement.index', [
            'pointenrollements' => $pointenrollements,
            'jourferiers' => $jourferiers,
            'produits' => $produits,
            'produits_lk' => $produits_lk,
        ]);
    }


    public function details($id)
    {

        $pointEnrolement = PointEnrolement::find($id);

        $availableProduct = PointEnrolementProduct::with('services')->where('id_point_enrolement', $id)->get();

        $products  = Service::all();
        return view('admin.pointenrollement.details', compact('pointEnrolement', 'products', 'availableProduct'));
    }

    public static function insert(Request $request)
    {

        $pointEnrolements = new PointEnrolement();
        $pointEnrolements->nom_pe = $request->nom_pe;
        $pointEnrolements->capacite_maximale_jour_pe = $request->capacite_maximale_jour_pe;
        $pointEnrolements->save();
        $pointEnrolements->services()->attach($request->services);
        // DB::table('point_enrolement')->insert([
        //     'nom_pe' => $request->nom_pe,
        //     'capacite_maximale_jour_pe' => $request->capacite_maximale_jour_pe,
        // ]);

        return redirect()->back()->with('success_message', 'Point d\'enrolement enregistré');
    }


    public function update(Request $request, $id)
    {

        $pointEnrolement = PointEnrolement::where('id_pe', $id)->first();

        try {
            $pointEnrolement->nom_pe = $request->nom_pe;
            $pointEnrolement->capacite_maximale_jour_pe = $request->capacite_maximale_jour_pe;

            $pointEnrolement->update();
            $pointEnrolement->services()->sync($request->services);

            return redirect()->back()->with('success_message', 'Point d\'enrolement mis à jour');
        } catch (Exception $e) {
            dd($e);
        }
    }


    //jour ferier





    public static function linkProduct(Request $request, $id)
    {

        $id_point_enrolement = $id;


        $pointEnrolement = PointEnrolement::where('id_pe', $id_point_enrolement)->first();
            $pointEnrolement->services()->attach($request->service_id);

        if ($pointEnrolement) {

            return redirect()->route('pointenrollement.details', $id_point_enrolement)->with('success_message', 'Ce produit a été ajouté au point d\'enrolement');
        } else {
            return redirect()->route('pointenrollement.details', $id_point_enrolement)->with('error_message', 'Ce produit est déja présent sur ce point d\'enrolement');
        }
    }


    public static function unlinkProduct($idProduct, $id_point_enrolement)
    {

        try {

            $pointEnrolement = PointEnrolement::where('id_pe', $id_point_enrolement)
                ->first();
            $pointEnrolement->services()->detach($idProduct);

            return redirect()->route('pointenrollement.details', $id_point_enrolement)->with('success_message', 'Ce produit a été rétiré au point d\'enrolement');
        } catch (Exception $e) {
            dd($e);
        }
    }
}
