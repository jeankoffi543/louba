<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Habilete;
use App\Facades\Manager as WorkFlow;
use App\Helpers\SendSmS;
use App\Mail\GlobalSenderMail;
use App\Models\PageLock;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class DemandeController extends Controller
{

    public static function home()
    {
        return view('visiteur.wellcome');
    }

    public function show($id)
    {
        $workFlow = WorkFlow::tranmettreDemande($id, request('type'));

        if (/* $workFlow['demande']->status_demande === "REJECTED" && !$workFlow['isOwner'] */request('type') === 'REJECTED' || request('type') === 'TRANSMITTED')
            return redirect()->action([DemandeController::class, 'get4admin']);

        return view('admin.demande-show', $workFlow);
    }

    public static function getFichierProduction()
    {
        $importations = DB::table('importation_document')->get();
        return view('admin.fichier_production', ['importations' => $importations]);
    }

    // ------------------------------------------------------------
    public static function postFichierproduction(Request $request)
    {
        $data = $request->all();
        $rules = [
            'document1' => 'required|mimes:csv,txt',
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->with('error_message', 'Veuillez importer un fichier valide.');
        }

        $file1 = $request->file('document1');

        // if (in_array($file1->getClientOriginalExtension(), ['php']))
        $now = new DateTime();
        $now = $now->format('YmdHis');

        $namefile1 = $now . '-' . $file1->getClientOriginalName();
        $destinationPath = 'uploads';
        $file1->move($destinationPath, $namefile1);

        $nbredoc_importer = 0;
        $nbredoc_total = 0;
        $file = "uploads/" . $namefile1;
        $rows = [];
        if (($open = fopen($file, "r")) !== FALSE) {
            $i = 0;
            // while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
            //     $rows[] = $data;
            //     $row = implode(', ', $data) . "<br>";
            //     if($i == 2) dd($rows);
            //     $i++;
            //     $importations = DB::table('importation_document')->get();
            //     $ligne_email = 0;
            //     $ligne_code_document = 2;
            //     //echo $data[$ligne_email]."<br>";

            //     $demandes = DB::table('demande')
            //         ->where('code_demande', $data[$ligne_code_document])
            //         ->join('point_enrolement', 'point_enrolement.id_pe', '=', 'demande.id_point_enrolement')
            //         ->join('client', 'client.id', '=', 'demande.id_client')
            //         ->get();

            //     $demandei = DB::table('demande')
            //         ->where('code_demande', $data[$ligne_code_document])
            //         ->join('point_enrolement', 'point_enrolement.id_pe', '=', 'demande.id_point_enrolement')
            //         ->join('client', 'client.id', '=', 'demande.id_client')
            //         ->first();

            //     $nbredoc_total++;

            //     if ($demandes->count() > 0) {
            //         $nbredoc_importer++;

            //         DB::table('demande')
            //             ->where('code_demande', $data[$ligne_code_document])
            //             ->update([
            //                 'production_disponible' => 1,
            //                 'date_production' => date('Y-m-d'),
            //                 'fichier' => $namefile1,
            //             ]);

            //         $message_sms = "Votre document No [" . $data[$ligne_code_document] . "] est disponible, passez le recuperer au point d enrollement " . $demandei->nom_pe;

            //         $curl = new \GuzzleHttp\Client();
            //         $url = "https://smswanwaran.com/index.php";
            //         $response = $curl->request('GET', $url, ['query' => [
            //             'app' => "ws",
            //             'u' => "theonemonk",
            //             "from" => "OMNIFORM",
            //             'h' => "67a3e2c5fab0c9f5e4df3286de3f7b5d",
            //             'op' => "pv",
            //             'to' => "224" . $demandei->telephone_client,
            //             'msg' => $message_sms,
            //         ]]);
            //     }
            // }
            $di = 0;
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                if ($nbredoc_total > 0) $rows[] = $data;
                $demande = Demande::where('numero_document', $data[0])
                    ->update([
                        'production_disponible' => 1,
                        'date_production' => new DateTime(),
                        'fichier' => $namefile1,
                    ]);

                $demande = Demande::where('recepice_number', $data[0])->with(['client', 'point_enrolement'])->first();
                if ($demande) {
                    // $demande = Demande::where('recepice_number', $data[0])->with(['client', 'point_enrolement'])->first();
                    $message_sms = "Votre Recepissé n° [" . $data[0] . "] est disponible, passez le recuperer au point d enrollement " . $demande->point_enrolement->nom_pe;
                    $sms = new SendSmS();
                    $sms->send(optional($demande->client)->telephone_client, $message_sms);

                    $subject = "RETRAIT DE DOCUMENT";
                    Mail::to(optional($demande->client)->email_client)->send(new GlobalSenderMail($message_sms, $subject, []));

                    $nbredoc_importer++;
                }
                $nbredoc_total++;
            }
            fclose($open);
        }


        $demandei = DB::table('importation_document')
            ->insert([
                'date' => date('Y-m-d'),
                'message' => $nbredoc_importer . " Importé(s) sur " . $nbredoc_total,
                'fichier' => $namefile1,
                'date_register' => new DateTime(),
            ]);

        flash('Importation reussi avec succes');

        return redirect()->back()->with('success_message', 'Document(s) importé(s) avec succès');
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
                return redirect('/rdv')->with('flashMessage', "Echec: identifiant OMNIFORM incorrect ");
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

                $message_sms = "Votre identifiant OMNIFORM est : " . $code_oni . "\n Ce identifiant unique vous permet de suivre vos documents sur " . env('APP_URL');
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
					veuillez vous l'identifiant OMNIFORM envoyer au telephone ou creer un nouveau compte sans  ");
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
        $authUser = auth()->user();
        return view('admin.demande', [
            'demandes' => WorkFlow::getDemandeByHabilete($authUser, request('status')),
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

    public function manage(Request $request)
    {
        WorkFlow::manage($request);

        if ($request->request_type === "gestion-pre-demande-valider" || $request->request_type === "gestion-demande-rejeter") {
            return redirect()->route('pre.demande')->with('success_message', 'Enregistrée avec succès.');
        }
        return redirect()->route('demande.show', ['id' => $request->demande_id])->with('success_message', 'Enregistrée avec succès.');
    }

    public function getFichierProductionListe(Request $request)
    {
        $authUser = auth()->user();
        return view('admin.demande', [
            'demandes' => WorkFlow::getDemandeByHabilete($authUser, request('status')),
        ]);
    }

    public function preDemande()
    {
        $authUser = auth()->user();

        if (request('status') === "REJECTED") {
            return view('admin.pre-demande', [
                'demandes' => WorkFlow::getDemandeByHabilete($authUser, 'PRE-DEMANDE_' . request('status')),
            ]);
        } else if (request('status') === "TRANSMITTED") {
            return view('admin.pre-demande', [
                'demandes' => WorkFlow::getDemandeByHabilete($authUser, 'PRE-DEMANDE_' . request('status')),
            ]);
        }

        return view('admin.pre-demande', [
            'demandes' => WorkFlow::getDemandeByHabilete($authUser, "PRE-DEMANDE"),
        ]);
    }

    public function preDemandeShow($id)
    {
        $demande = Demande::query()
            ->where('id', $id)->with('client', 'piece_jointes')->first();

        return view('admin.pre-demande-show', ["demande" => $demande]);
    }

    public function manageCount(Request $request)
    {
        return response()->json([
            'data' => WorkFlow::countUsers($request),
        ]);
    }
}
