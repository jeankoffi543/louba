<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Habilete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemandeController extends Controller
{

    public static function home()
    {
        return view('visiteur.wellcome');
    }

    public function show($id)
    {
        $circuit = [];

        $demande = Demande::find($id)->with(['client', 'product', 'service', 'point_enrolement'])->first();
        if($demande){
            $habiletes = $demande->service->habiletes;
            $habiletes = is_array($habiletes) ? $habiletes : (is_null($habiletes) ? [] : json_decode($habiletes, true));
            $outputArray = [];

            foreach ($habiletes as $item) {
                $outputArray[] = json_decode($item);
            }

            $habiletes = $outputArray;

            $habiletes_array = [];
            
            if (count($habiletes) > 0) {
                foreach ($habiletes as $id) {
                    $habilete = Habilete::whereIn('id', $id)->get();
                    $habiletes_array[] = $habilete;
                }
            }

        }
        return view('admin.demande-show', ['demande' => $demande, 'circuit' => $habiletes_array]);
    }

    public static function getFichierProduction()
    {
        $importations = DB::table('importation_document')->get();
        return view('admin.fichier_production', ['importations' => $importations]);
    }

    // ------------------------------------------------------------
    public static function postFichierproduction(Request $request)
    {
        $file1 = $request->file('document1');

        if (in_array($file1->getClientOriginalExtension(), ['php']))
            return redirect('/404');

        $namefile1 = time() . '-' . $file1->getClientOriginalName();
        $destinationPath = 'uploads';
        $file1->move($destinationPath, $namefile1);

        $nbredoc_importer = 0;
        $nbredoc_total = -1;

        if (($open = fopen("uploads/" . $namefile1, "r")) !== FALSE) {
            while (($data = fgetcsv($open, 1000, ";")) !== FALSE) {
                $importations = DB::table('importation_document')->get();
                $ligne_email = 0;
                $ligne_code_document = 2;
                //echo $data[$ligne_email]."<br>";


                $demandes = DB::table('demande')
                    ->where('code_demande', $data[$ligne_code_document])
                    ->join('point_enrolement', 'point_enrolement.id_pe', '=', 'demande.id_point_enrolement')
                    ->join('client', 'client.id', '=', 'demande.id_client')
                    ->get();

                $demandei = DB::table('demande')
                    ->where('code_demande', $data[$ligne_code_document])
                    ->join('point_enrolement', 'point_enrolement.id_pe', '=', 'demande.id_point_enrolement')
                    ->join('client', 'client.id', '=', 'demande.id_client')
                    ->first();

                $nbredoc_total++;

                if ($demandes->count() > 0) {
                    $nbredoc_importer++;

                    DB::table('demande')
                        ->where('code_demande', $data[$ligne_code_document])
                        ->update([
                            'production_disponible' => 1,
                            'date_production' => date('Y-m-d'),
                            'fichier' => $namefile1,
                        ]);

                    $message_sms = "Votre document No [" . $data[$ligne_code_document] . "] est disponible, passez le recuperer au point d enrollement " . $demandei->nom_pe;

                    $curl = new \GuzzleHttp\Client();
                    $url = "https://smswanwaran.com/index.php";
                    $response = $curl->request('GET', $url, ['query' => [
                        'app' => "ws",
                        'u' => "theonemonk",
                        "from" => "LOUBA",
                        'h' => "67a3e2c5fab0c9f5e4df3286de3f7b5d",
                        'op' => "pv",
                        'to' => "224" . $demandei->telephone_client,
                        'msg' => $message_sms,
                    ]]);
                }
            }
            fclose($open);
        }


        $demandei = DB::table('importation_document')
            ->insert([
                'date' => date('Y-m-d'),
                'message' => $nbredoc_importer . " Importé(s) sur " . $nbredoc_total,
                'fichier' => $namefile1,
            ]);

        flash('Importation reussi avec succes');

        return redirect()->back();
    }


    // --------------------------------------------------------------
    public static function rdv2(Request $request)
    {

        if ($request->code_oni) {
            $code_onis = DB::table('client')
                ->where('code_oni', $request->code_oni)
                ->get();

            //dd($code_onis);

            if ($code_onis->count() == 0)
                return redirect('/rdv')->with('flashMessage', "Echec: identifiant LOUBA incorrect ");
            else {
                $client_information = DB::table('client')
                    ->where('code_oni', $request->code_oni)
                    ->first();
                session(['client_information' => $client_information]);
                //dd(session('client_information'));
            }
        }

        $file1 = $request->file('document1');
        $file2 = $request->file('document2');

        //echo 'File Name: '.$file->getClientOriginalName();
        //echo 'File Size: '.$file->getSize();
        //echo 'File Mime Type: '.$file->getMimeType();

        $extension_ban = ['php'];
        if (
            in_array($file1->getClientOriginalExtension(), $extension_ban) or
            in_array($file2->getClientOriginalExtension(), $extension_ban)
        ) {
            return redirect('/rdv')->with('flashMessage', "Mauvaise extension du fichier ");
        } else {
            //Move Uploaded File
            $namefile1 = time() . '-' . $file1->getClientOriginalName();
            $destinationPath = 'uploads';
            $file1->move($destinationPath, $namefile1);

            $namefile2 = time() . '-' . $file2->getClientOriginalName();
            $destinationPath = 'uploads';

            $file2->move($destinationPath, $namefile2);
        }

        $point_enrolements = DB::table('point_enrolement_lien_type_document')
            ->join('point_enrolement', 'point_enrolement.id_pe', '=', 'point_enrolement_lien_type_document.id_point_enrolement')
            ->get()
            ->unique('id_point_enrolement');
        //dd($point_enrolements);

        $jourferiers = DB::table('jourferier')->get();

        //dd($request,$namefile1,$namefile2);
        //return \Redirect::route('/rdv',['param1'=>'param1_value','param2'=>'param2_value']);
        return view('visiteur.rdv', [
            'request' => $request,
            'document1' => $namefile1,
            'document2' => $namefile2,
            'point_enrolements' => $point_enrolements,
            'jourferiers' => $jourferiers,
        ]);
    }

    public static function rdv3(Request $request)
    {

        $client = DB::table('client')
            ->where('telephone_client', $request->telephone)
            ->get();

        //dd(session('client_information'),$request);

        if (session('client_information') and $request->code_oni != NULL) {
            /*
            $request->genre = session('client_information')->genre_client;
            $request->nom = session('client_information')->nom_client;
            $request->prenom = session('client_information')->prenom_client;
            $request->email = session('client_information')->email_client;
            $request->telephone = session('client_information')->telephone_client;
            $request->date_naissance = session('client_information')->date_naissance_client;
            $request->lieu_de_residence = session('client_information')->adresse_client;
            */

            $code_oni = session('client_information')->code_oni;

            $client = DB::table('client')
                ->where('telephone_client', session('client_information')->telephone_client)
                ->first();


            DB::table('demande')->insert([
                'document1_demande' => $request->document1,
                'document2_demande' => $request->document2,
                'id_client' => $client->id,
                'date_rdv_demande' => $request->date_rdv_demande,
                'id_product' => $request->id_type_document,
                'type_service' => $request->type_service_passport,
                'id_point_enrolement' => $request->id_point_enrolement,
                'code_demande' => $code_oni,
            ]);

            return redirect('/suivreMesDocuments');
        } else { //session not exist

            if ($client->count() == 0) {


                $code_oni = $request->telephone . "-rz-" . substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);

                DB::table('client')->insert([
                    'nom_client' => $request->nom,
                    'prenom_client' => $request->prenom,
                    'email_client' => $request->email,
                    'telephone_client' => $request->telephone,
                    'adresse_client' => $request->lieu_de_residence,
                    'date_naissance_client' => $request->date_naissance,
                    'code_oni' => $code_oni,
                ]);


                $client = DB::table('client')
                    ->where('telephone_client', $request->telephone)
                    ->first();


                session(['client_information' => $client]);

                DB::table('demande')->insert([
                    'document1_demande' => $request->document1,
                    'document2_demande' => $request->document2,
                    'id_client' => $client->id,
                    'date_rdv_demande' => $request->date_rdv_demande,
                    'id_product' => $request->id_type_document,
                    'type_service' => $request->type_service_passport,
                    'id_point_enrolement' => $request->id_point_enrolement,
                    'code_demande' => $code_oni,
                ]);

                $message_sms = "Votre identifiant LOUBA est : " . $code_oni . "\n Ce identifiant unique vous permet de suivre vos documents sur louba-gn.com";
                //dd($message_sms,$request->telephone);


                /*
                use Illuminate\Support\Facades\Http;

                 $response = Http::get('http://my.domain.com/test.php', [
                     'key1' => $id,
                     'key2' => 'Test',
                 ]);

                 if ($response->failed()) {
                    // return failure
                 } else {
                    // return success
                 }

                */

                $curl = new \GuzzleHttp\Client();
                $url = "https://smswanwaran.com/index.php";
                $response = $curl->request('GET', $url, ['query' => [
                    'app' => "ws",
                    'u' => "theonemonk",
                    "from" => "LOUBA",
                    'h' => "67a3e2c5fab0c9f5e4df3286de3f7b5d",
                    'op' => "pv",
                    'to' => "224" . $request->telephone,
                    'msg' => $message_sms,
                ]]);

                //dd($response->getBody());
                return redirect('/suivreMesDocuments');
            } else {
                return redirect('/rdv')->with('flashMessage', "Ce numero telephone est deja lier a un compte,
					veuillez vous l'identifiant LOUBA envoyer au telephone ou creer un nouveau compte sans  ");
            }
        }
    }


    public static function suivreMesDocuments(Request $request)
    {
        if (session('client_information')) {
            $demandes = DB::table('demande')
                ->where('code_demande', session('client_information')->code_oni)
                ->join('point_enrolement', 'point_enrolement.id_pe', '=', 'demande.id_point_enrolement')
                ->join('client', 'client.id', '=', 'demande.id_client')
                ->join('products', 'products.id', '=', 'demande.id_product')
                ->get();
            //dd($request->demande);
            return view('visiteur.statutDocument', [
                'demandes' => $demandes,
                'code_demande' => session('client_information')->code_oni,
            ]);
        } else {
            return view('visiteur.statutDocument');
        }
    }


    public static function suivreMesDocumentsSearch(Request $request)
    {

        $demandes = DB::table('demande')
            ->where('code_demande', $request->code_demande)
            ->join('point_enrolement', 'point_enrolement.id_pe', '=', 'demande.id_point_enrolement')
            ->join('client', 'client.id', '=', 'demande.id_client')
            ->join('products', 'products.id', '=', 'demande.id_product')
            ->get();

        //dd($request);
        //dd($request->demande);
        return view('visiteur.statutDocument', [
            'demandes' => $demandes,
            'code_demande' => $request->demande,
        ]);
    }

    public static function search_documents($code_demande)
    {

        $demandes = DB::table('demande')
            ->where('code_demande', $code_demande)
            ->join('point_enrolement', 'point_enrolement.id_pe', '=', 'demande.id_point_enrolement')
            ->join('client', 'client.id', '=', 'demande.id_client')
            ->join('products', 'products.id', '=', 'demande.id_product')
            ->get();

        //dd($request);
        //dd($request->demande);
        return response()->json([
            'demandes' => $demandes,
            'code_demande' => $code_demande,
        ]);
    }


    public static function get4admin()
    {
        $demandes = Demande::with('product', 'service', 'client', 'point_enrolement')->get();

        return view('admin.demande', [
            'demandes' => $demandes,
        ]);
    }

    public static function search4admin(Request $request)
    {
        $demandes = DB::table('demande')
            ->where('code_demande', $request->code_demande)
            ->join('point_enrolement', 'point_enrolement.id_pe', '=', 'demande.id_point_enrolement')
            ->join('client', 'client.id', '=', 'demande.id_client')
            ->join('product', 'product.id', '=', 'demande.id_product')
            ->get();

        return view('admin.demande', [
            'demandes' => $demandes,
        ]);
    }

    public static function get(Request $request)
    {
        if ($request->code_demande) {
            $demandes = DB::table('demande')
                ->where('code_demande', $request->code_demande)
                ->join('point_enrolement', 'point_enrolement.id_pe', '=', 'demande.id_point_enrolement')
                ->join('client', 'client.id', '=', 'demande.id_client')
                ->join('product', 'product.id', '=', 'demande.id_product')
                ->get();

            return view('visiteur.statutDocument', [
                'demandes' => $demandes,
                'code_demande' => $request->code_demande,
            ]);
        } else
            return redirect('suivreMesDocments');
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


    public static function updateStatus(Request $request)
    {

        DB::table('demande')
            ->where('id', $request->id_demande)
            ->update([
                'status_demande' => $request->status_demande,
                'date_traitement_demande' => date('Y-m-d'),
                'raison_status_demande' => $request->raison_demande,
            ]);

        return redirect('/demande');
    }
}
