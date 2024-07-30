<?php

namespace App\Http\Controllers;

use App\Helpers\CinetPay;
use App\Helpers\SendSmS;
use App\Http\Requests\RegisterClientRequest;
use App\Mail\AttachmentTicketAppointmentMail;
use App\Mail\AttachmentTicketMail;
use App\Models\Client;
use App\Models\Demande;
use App\Models\Paiement;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PDF;
use App\Exceptions\ErrorException;
use App\Mail\GlobalSenderMail;
use App\Mail\PreRendezVousDemandeMail;
use App\Mail\RendezVousDemandeMail;
use App\Models\AdminAction;
use App\Models\Historique;
use App\Models\IndexTraitement;
use App\Models\PointEnrolement;
use App\Models\PublicHoliday;
use App\Models\Service;
use DateTime;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use const Grpc\STATUS_CANCELLED;


class ClientController extends Controller
{


    public static function update(Request $request)
    {

        DB::table('client')->where('id_role', $request->id_role)->update(['nom_role' => $request->nom_role, 'description_role' => $request->description_role,]);

        return redirect('/role');
    }


    public static function actif(Request $request)
    {
        DB::table('client')->where('id', $request->id)->update(['actif_client' => $request->actif,]);

        return redirect(route('client'));
    }

    public static function index()
    {
        $clients = DB::table('client')->get();
        return view('admin.client', ['clients' => $clients,]);
    }



    // ============================================== API USED =============================


    /**
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function register_client(RegisterClientRequest $clientRequest): JsonResponse
    {
        try {

            $client = new Client();
            $client->nom_client = request()->nom;
            $client->prenom_client = request()->prenom;
            $client->telephone_client = request()->telephone;
            $client->email_client = request()->email;
            // $client->password = bcrypt(request()->telephone);
            $client->password = Hash::make(request()->telephone);

            $username = request()->email;
            $numero = request()->telephone;

            if ($client->save()) {
                $message_sms = "Bienvenue sur la plateforme de prise de rendez-vous. Votre accès OMNIForm est: \nidentifiant: " . request()->email . "\n Mot de passe: " . request()->telephone;
                try {
                    // $mailMsg = "Cher Utilisateur, Votre inscription à la plateforme de prise de rendez-vous est désormais effective.Votre nom d'utilisateur est : $username Votre mot de passe est : $numero de téléphone";

                    // Mail::to(request()->email)->send(new AttachmentTicketAppointmentMail($mailMsg));

                    Mail::to(request()->email)->send(new GlobalSenderMail($message_sms, "CREATION DE COMPTE", []));
                    $newSms = new SendSmS();
                    $newSms->send(request()->telephone, $message_sms);
                } catch (GuzzleException $e) {
                    // throw new ErrorException("Erreur d'envoi du message , ressayez ultérieurement.");
                }

                // $infoUserClient = DB::table('client')->where('email_client', request()->email)->where('password_client', request()->telephone)->first();
                $infoUserClient = $client;

                session(['infoUserClient' => $infoUserClient]);

                $token = auth('apiJwt')->attempt([
                    'password' => request()->telephone,
                    "email_client" => request()->email
                ]);

                $data['message'] = "ok";
                $data['token'] = "$token";
                $data['client'] = $infoUserClient;
                return response()->json($data);
            }
            throw new ErrorException("Erreur de traitement , ressayez ultérieurement.");
        } catch (ErrorException $e) {
            //            header("Erreur", true, 500);
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login_client(Request $request)
    {

        try {
            $client = Client::where('email_client', $request->email)->first();
            if (Hash::check($request->password, $client->password)) {

                $token = auth('apiJwt')->attempt([
                    // 'password' => $request->password,
                    'password' => $request->password,
                    "email_client" => $request->email
                ]);

                if (!$token) {
                    $data['message'] = "Echec connection : Email ou mot de passe incorrect";
                    $data['client'] = null;
                    return response()->json($data, 421);
                }

                $users = auth('apiJwt')->user();
                if ($users->actif_client == 0) {
                    $data['message'] = "Echec connection : Utilisateur suspendu";
                    $data['client'] = null;

                    return response()->json($data, 421);
                }
                session(['infoUserClient' => $users]);

                $data['message'] = "ok";
                $data['client'] = $users;
                $data['token'] = $token;
                return response()->json($data,)->cookie("infoUserClient", $users->id);
            }

            $data['message'] = "Echec connection : Email ou mot de passe incorrect";
            $data['client'] = null;
            return response()->json($data, 500);
        } catch (Exception $exception) {
            $data['message'] = "Echec connection : Email ou mot de passe incorrect";
            $data['client'] = null;
            $data['error'] = $exception->getMessage();
            return response()->json($data, 500);
        }
    }

    /**
     * @return JsonResponse
     */
    public function user_info()
    {
        try {
            $client = auth('apiJwt')->user();
            //            $users = Client::where('id', '=', $clientId)->first();

            session(['infoUserClient' => $client]);
            $data['message'] = "ok";
            $data['client'] = $client;
            return response()->json($data,);
        } catch (Exception $exception) {
            $data['message'] = "Compte introuvable";
            $data['client'] = null;
            return response()->json($data, 500);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function get_appointment_client(Request $request)
    {

        try {
            $clientId = auth('apiJwt')->user()->id;
            $demandes = Demande::where('id_sender', $clientId)->with(["point_enrolement", "product", "client", 'sender', "service"])->get()->toArray();;

            for ($i = 0; $i < count($demandes); $i++) {

                $demandes[$i]["paiement"] = Paiement::where('id_demande', '=', $demandes[$i]["id"])->first();
            }

            $data['message'] = "ok";
            $data['demandes'] = $demandes;
            return response()->json($data);
        } catch (Exception $ex) {
            $data['message'] = "Aucune demande";
            $data['description'] = $ex->getMessage();
            $data['demandes'] = [];
            return response()->json($data, 500);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    // public function save_appointment_client(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $userConnected = auth('apiJwt')->user();

    //         $demande = new Demande();

    //         $type_demande = "Nouvelle demande";
    //         if ($request->type_request == "renouvelement") {
    //             $type_demande = "Renouvelement";
    //         } elseif ($request->type_request == "duplicata") {
    //             $type_demande = "Duplicata";
    //         } else {
    //             $type_demande = "Nouvelle demande";
    //         }

    //         //$demande->id_client = $client->id;
    //         $client = Client::all()
    //             ->where('telephone_client', '=', $request->telephone)
    //             ->where('email_client', '=', $request->email)->first();

    //         if (!$client) {
    //             $newClient = new Client();
    //             $newClient->nom_client = $request->nom;
    //             $newClient->prenom_client = $request->prenom;
    //             $newClient->email_client = $request->email;
    //             $newClient->genre_client = $request->gender == "H" ? "Homme" : "Femme";
    //             $newClient->telephone_client = $request->telephone;
    //             $newClient->adresse_client = $request->lieu_de_residence;
    //             $newClient->date_naissance_client = Carbon::createFromFormat('Y-m-d', $request->date_naissance)->toDateTime();
    //             $newClient->password = bcrypt($request->telephone);
    //             $newClient->created_at = now();
    //             $newClient->save();
    //             $message_sms = "Votre access OMNIFORM est \n identifiant:" . $request->email . "\n Mot de passe: " . $request->telephone;
    //             try {
    //                 $newSms = new SendSmS();
    //                 $newSms->send($request->telephone, $message_sms);
    //             } catch (GuzzleException $e) {
    //                 throw new ErrorException("Erreur d'envoi du message , ressayez ultérieurement.");
    //             }

    //             $client = $newClient;
    //         }

    //         $code_oni = "GN" . $client->id . substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);
    //         $demande->id_sender = $userConnected->id;
    //         $demande->nationality = $request->nationality;
    //         $demande->nationality_state = $request->nationality_state;
    //         $demande->profession = $request->profession;
    //         $demande->height = $request->height;
    //         $demande->complexion = $request->complexion;
    //         $demande->hair_color = $request->hair_color;
    //         $demande->eye_color = $request->eye_color;
    //         $demande->father_first_name = $request->father_first_name;
    //         $demande->father_last_name = $request->father_last_name;
    //         $demande->mother_first_name = $request->mother_first_name;
    //         $demande->mother_last_name = $request->mother_last_name;
    //         $demande->numero_recu = $request->numero_recu;
    //         $demande->id_client = $client->id;
    //         $demande->date_rdv_demande = Carbon::createFromFormat('Y-m-d', $request->date_rdv_demande)->toDateTime();
    //         $demande->id_product = $request->id_type_document;
    //         $demande->id_service = $request->id_type_service;
    //         $demande->id_point_enrolement = $request->id_point_enrolement;
    //         $demande->code_demande = $code_oni;
    //         $demande->type_request = $type_demande;
    //         $demande->habilete_position = 0;
    //         $demande->created_at = now();

    //         if ($request->hasFile("document1")) {

    //             $document1 = $request->file('document1');
    //             $validFiles = true; // Indicateur pour vérifier si tous les fichiers sont valides
    //             if (is_array($document1) && count($document1) > 0) {
    //                 foreach ($document1 as $key => $file) {
    //                     $extension = $file->getClientOriginalExtension();
    //                     $uuid = (string)Str::uuid() . '.' . $extension;
    //                     $file->storeAs('public/documents/', $uuid);
    //                     $demande->document_url = Storage::url('documents/' . $uuid);
    //                 }
    //             } else {
    //                 $extension = $document1->getClientOriginalExtension();
    //                 $uuid = (string)Str::uuid() . '.' . $extension;
    //                 $document1->storeAs('public/documents/', $uuid);
    //                 $demande->document_url = Storage::url('documents/' . $uuid);
    //             }
    //         }
    //         if ($request->hasFile("document2")) {

    //             $document2 = $request->file('document2');
    //             if (is_array($document2) && count($document2) > 0) {
    //                 foreach ($document2 as $key => $file) {
    //                     $extension = $file->getClientOriginalExtension();
    //                     $uuid = (string)Str::uuid() . '.' . $extension;
    //                     /** @var UploadedFile $file */
    //                     $file->storeAs('public/clients/', $uuid);
    //                     $demande->avatar_url = Storage::url('clients/' . $uuid);
    //                 }
    //             }else{
    //                 $extension = $document2->getClientOriginalExtension();
    //                 $uuid = (string)Str::uuid() . '.' . $extension;
    //                 /** @var UploadedFile $file */
    //                 $document2->storeAs('public/clients/', $uuid);
    //                 $demande->avatar_url = Storage::url('clients/' . $uuid);
    //             }
    //         }

    //         $demande->save();

    //         // Index traitement
    //         $service = Service::where('id', $demande->id_service)->first();
    //         $habilete_position = $demande->habilete_position;
    //         $habiletes = json_decode(json_encode($service->habiletes), true);
    //         $habiletes = array_map(function ($item) {
    //             return json_decode($item, true);
    //         }, $habiletes);

    //         if (is_array($habiletes) && count($habiletes) > 0 && $habilete_position < count($habiletes)) {
    //             $currentHabiletes = $habiletes[$habilete_position];
    //             if (is_array($currentHabiletes) && count($currentHabiletes) > 0) {
    //                 foreach ($currentHabiletes as $habilete) {
    //                     $data1 = [
    //                         'habilete_id' => intval($habilete),
    //                         'id_demande' => $demande->id,
    //                     ];

    //                     $data2 = [
    //                         'habilete_id' => intval($habilete),
    //                         'id_demande' => $demande->id,
    //                         'action' => 'create',
    //                     ];

    //                     IndexTraitement::create($data1);
    //                     AdminAction::create($data2);
    //                 }
    //             } else {
    //                 $data1 = [
    //                     'habilete_id' => intval($currentHabiletes),
    //                     'id_demande' => $demande->id,
    //                 ];

    //                 $data2 = [
    //                     'habilete_id' => intval($currentHabiletes),
    //                     'id_demande' => $demande->id,
    //                     'action' => 'create',
    //                 ];

    //                 IndexTraitement::create($data1);
    //                 AdminAction::create($data2);
    //             }
    //         }


    //         $URL_DOWNLOAD = env('APP_URL') . "/recuPdf/$code_oni";
    //         $SATUS_DEMANDE = env('APP_URL') . "/site#/personal-space/appointment/documents";
    //         $message_sms = "Votre code document OMNIFORM est " . $code_oni . "\n Veuillez suivre le parcours ici $SATUS_DEMANDE \n et telecharger votre recu sur $URL_DOWNLOAD";

    //         $newSms = new SendSmS();
    //         try {
    //             $newSms->send($request->telephone, $message_sms);
    //         } catch (GuzzleException $e) {
    //             throw new ErrorException("Erreur d'envoi du message , ressayez ultérieurement.");
    //         }
    //         // send mail in client
    //         $pdf = PDF::loadView('client.attestationAppointmentPdf', ['title' => 'Recu', 'date' => date('d-m-Y'), 'maDemande' => $demande, 'code_demande' => $demande->code_demande,]);

    //         $demandeSave = Demande::with(['client', 'sender', 'product', 'point_enrolement'])->where("id", "=", $demande->id)->first();

    //         $dataAttachment = [
    //             'title' => 'Reçu de prise de rendez-vous OMNIFORM SERVICE : ' . optional(demandeSave->product)->nom,
    //             'body' => "Votre demande a été enregistré. $message_sms"
    //         ];

    //         $attachment = [
    //             'name' => 'recu_rendez_vous.pdf',
    //             'data' => $pdf->output()
    //         ];

    //         try {
    //             Mail::to( optional($demandeSave->client)->email_client)->send(new AttachmentTicketAppointmentMail($dataAttachment, $attachment));
    //         } catch (Exception $ex) {
    //             DB::rollBack();
    //             $data["demande"] = null;
    //             $data["message"] = "Echèc de l'enregistré l'envoi de votre recu a échoué";
    //             $data["details"] = $ex->getMessage();
    //             return response()->json($data);
    //         }
    //         DB::commit();
    //         $data["status"] = 200;
    //         $data["message"] = "Demande enregistré";
    //         $data["demande"] = $demande;


    //         return response()->json($data);
    //     } catch (Exception $ex) {
    //         DB::rollBack();
    //         $data["demande"] = null;
    //         $data["message"] = "Echèc de l'enregistré";
    //         $data["details"] = $ex->getMessage();
    //         return response()->json($data, 500);
    //     }
    // }

    public function save_appointment_client(Request $request)
    {
        try {

            // Today
            $date_rdv_demande = Carbon::createFromFormat('Y-m-d', $request->date_rdv_demande)->toDateTime();
            $demandeToday = Demande::where('id_point_enrolement', $request->id_point_enrolement)
                ->whereDate('date_rdv_demande', $date_rdv_demande);

            $demandeCount = $demandeToday->count();
            $pointEnrolement = PointEnrolement::find($request->id_point_enrolement);

            if ($demandeCount >= optional($pointEnrolement)->capacite_maximale_jour_pe) {
                $data["demande"] = null;
                $data["message"] = "Capacité maximum atteinte pour ce point d'enrolement en la date choisie";
                return response()->json($data);
            }

            DB::beginTransaction();
            $userConnected = auth('apiJwt')->user();

            $demande = Demande::where('id', $request->id_demande)->with('client')->first();

            // $type_demande = "Nouvelle demande";
            // if ($request->type_request == "renouvelement") {
            //     $type_demande = "Renouvelement";
            // } elseif ($request->type_request == "duplicata") {
            //     $type_demande = "Duplicata";
            // } else {
            //     $type_demande = "Nouvelle demande";
            // }

            // $demande->id_client = $client->id;

            // if (!$client) {
            //     $newClient = new Client();
            //     $newClient->nom_client = $request->nom;
            //     $newClient->prenom_client = $request->prenom;
            //     $newClient->email_client = $request->email;
            //     $newClient->genre_client = $request->gender == "H" ? "Homme" : "Femme";
            //     $newClient->telephone_client = $request->telephone;
            //     $newClient->adresse_client = $request->lieu_de_residence;
            //     $newClient->date_naissance_client = Carbon::createFromFormat('Y-m-d', $request->date_naissance)->toDateTime();
            //     $newClient->password = bcrypt($request->telephone);
            //     $newClient->created_at = now();
            //     $newClient->save();
            //     $message_sms = "Votre access OMNIFORM est \n identifiant:" . $request->email . "\n Mot de passe: " . $request->telephone;
            //     try {
            //         $newSms = new SendSmS();
            //         $newSms->send($request->telephone, $message_sms);
            //     } catch (GuzzleException $e) {
            //         // throw new ErrorException("Erreur d'envoi du message , ressayez ultérieurement.");
            //     }

            //     $client = $newClient;
            // }
            // if(!$client){
            //     $client = $userConnected;
            // }

            $code_oni = "GN" . $demande->client->id . substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);

            $demande->id_sender = $userConnected->id;
            $demande->numero_recu = $request->numero_recu;
            // $demande->id_client = $client->id;
            $demande->date_rdv_demande = $date_rdv_demande;
            // $demande->id_product = $request->id_type_document;
            $demande->id_service = $request->id_type_service;
            $demande->id_point_enrolement = $request->id_point_enrolement;
            // $demande->code_demande = $code_oni;
            // $demande->type_request = $type_demande;
            $demande->predemande_step = 3;
            $demande->habilete_position = 0;
            $demande->updated_at = now();

            // if ($request->hasFile("document1")) {

            //     $document1 = $request->file('document1');
            //     $validFiles = true; // Indicateur pour vérifier si tous les fichiers sont valides
            //     if (is_array($document1) && count($document1) > 0) {
            //         foreach ($document1 as $key => $file) {
            //             $extension = $file->getClientOriginalExtension();
            //             $uuid = (string)Str::uuid() . '.' . $extension;
            //             $file->storeAs('public/documents/', $uuid);
            //             $demande->document_url = Storage::url('documents/' . $uuid);
            //         }
            //     } else {
            //         $extension = $document1->getClientOriginalExtension();
            //         $uuid = (string)Str::uuid() . '.' . $extension;
            //         $document1->storeAs('public/documents/', $uuid);
            //         $demande->document_url = Storage::url('documents/' . $uuid);
            //     }
            // }
            // if ($request->hasFile("document2")) {

            //     $document2 = $request->file('document2');
            //     if (is_array($document2) && count($document2) > 0) {
            //         foreach ($document2 as $key => $file) {
            //             $extension = $file->getClientOriginalExtension();
            //             $uuid = (string)Str::uuid() . '.' . $extension;
            //             /** @var UploadedFile $file */
            //             $file->storeAs('public/clients/', $uuid);
            //             $demande->avatar_url = Storage::url('clients/' . $uuid);
            //         }
            //     }else{
            //         $extension = $document2->getClientOriginalExtension();
            //         $uuid = (string)Str::uuid() . '.' . $extension;
            //         /** @var UploadedFile $file */
            //         $document2->storeAs('public/clients/', $uuid);
            //         $demande->avatar_url = Storage::url('clients/' . $uuid);
            //     }
            // }

            $demande->save();

            // Index traitement
            $service = Service::where('id', $demande->id_service)->first();
            $habilete_position = $demande->habilete_position;
            $habiletes = json_decode(json_encode($service->habiletes), true);
            $habiletes = array_map(function ($item) {
                return json_decode($item, true);
            }, $habiletes);

            if (is_array($habiletes) && count($habiletes) > 0 && $habilete_position < count($habiletes)) {
                $currentHabiletes = $habiletes[$habilete_position];
                if (is_array($currentHabiletes) && count($currentHabiletes) > 0) {
                    foreach ($currentHabiletes as $habilete) {
                        try {
                            DB::beginTransaction();

                            $data1 = [
                                'habilete_id' => intval($habilete),
                                'id_demande' => $demande->id,
                            ];

                            $data2 = [
                                'habilete_id' => intval($habilete),
                                'id_demande' => $demande->id,
                                'action' => 'create',
                            ];

                            IndexTraitement::create($data1);
                            AdminAction::create($data2);

                            DB::commit();
                        } catch (\Exception $e) {
                            DB::rollBack();
                            // Handle the exception or log it
                        }
                    }
                } else {
                    try {
                        DB::beginTransaction();

                        $data1 = [
                            'habilete_id' => intval($currentHabiletes),
                            'id_demande' => $demande->id,
                        ];

                        $data2 = [
                            'habilete_id' => intval($currentHabiletes),
                            'id_demande' => $demande->id,
                            'action' => 'create',
                        ];

                        IndexTraitement::create($data1);
                        AdminAction::create($data2);
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                    }
                }
            }


            $URL_DOWNLOAD = env('APP_URL') . "/recuPdf/$code_oni";
            $SATUS_DEMANDE = env('APP_URL') . "/site#/personal-space/appointment/documents";
            $message_sms = "Votre code document OMNIFORM est " . $code_oni . "\n Veuillez suivre le parcours ici $SATUS_DEMANDE \n et telecharger votre recu sur $URL_DOWNLOAD";

            $subject = "Email de confirmation de prise rendez-vous pour le service : " . optional($demande->service)->name;

            $newSms = new SendSmS();
            try {
                $newSms->send($request->telephone, $message_sms);
            } catch (GuzzleException $e) {
                // throw new ErrorException("Erreur d'envoi du message , ressayez ultérieurement.");
            }
            // send mail in client
            $pdf = PDF::loadView('client.attestationAppointmentPdf', ['title' => 'Recu', 'date' => date('d-m-Y'), 'maDemande' => $demande, 'code_demande' => $demande->code_demande,]);

            $demandeSave = Demande::with(['client', 'sender', 'product', 'point_enrolement'])->where("id", "=", $demande->id)->first();

            $dataAttachment = [
                'title' => 'Reçu de prise de rendez-vous OMNIFORM SERVICE : ' . optional($demandeSave->product)->nom,
                'body' => "Votre demande a été enregistré. $message_sms"
            ];

            $attachment = [
                'name' => 'recu_rendez_vous.pdf',
                'data' => $pdf->output()
            ];

            try {
                // Mail::to(optional($demandeSave->client)->email_client)->send(new AttachmentTicketAppointmentMail($dataAttachment, $attachment));
                $detail = [
                    'username' => $userConnected->nom_client,
                    'date' => $demande->date_rdv_demande->format('d-m-Y'),
                    'point_enrolement' => optional($demande->point_enrolement)->nom_pe,
                    'code_demande' => $demande->code_demande,
                    'telephone' => optional($demande->client)->telephone_client,
                    'service' => optional($demande->product)->name,
                ];

                Mail::to($userConnected->email_client)->send(new RendezVousDemandeMail($subject, $detail, $attachment));
            } catch (Exception $ex) {
                // DB::rollBack();
                // $data["demande"] = null;
                // $data["message"] = "Echèc de l'enregistré l'envoi de votre recu a échoué";
                // $data["details"] = $ex->getMessage();
                // return response()->json($data);
            }
            DB::commit();
            $data["status"] = 200;
            $data["message"] = "Demande enregistré";
            $data["demande"] = $demande;

            // Commentaire
            $historique = new Historique();
            $historique->description = "Création d'une nouvelle demande";
            $historique->demande_id =  $demande->id;
            $historique->client_id = $userConnected->id;
            $historique->save();

            return response()->json($data);
        } catch (Exception $ex) {
            DB::rollBack();
            $data["demande"] = null;
            $data["message"] = "Echèc de l'enregistré";
            $data["details"] = $ex->getMessage();
            return response()->json($data, 500);
        }
    }

    public function save_predemande_client(Request $request)
    {
        try {
            DB::beginTransaction();
            $userConnected = auth('apiJwt')->user();

            $demande = new Demande();

            $type_demande = "Nouvelle demande";
            if ($request->type_request == "renouvelement") {
                $type_demande = "Renouvelement";
            } elseif ($request->type_request == "duplicata") {
                $type_demande = "Duplicata";
            } else {
                $type_demande = "Nouvelle demande";
            }

            //$demande->id_client = $client->id;
            $client = Client::all()
                ->where('telephone_client', '=', $request->telephone)
                ->where('email_client', '=', $request->email)->first();

            if (!$client) {
                $newClient = new Client();
                $newClient->nom_client = $request->nom;
                $newClient->prenom_client = $request->prenom;
                $newClient->email_client = $request->email;
                $newClient->genre_client = $request->gender == "H" ? "Homme" : "Femme";
                $newClient->telephone_client = $request->telephone;
                $newClient->adresse_client = $request->lieu_de_residence;
                $newClient->date_naissance_client = Carbon::createFromFormat('Y-m-d', $request->date_naissance)->toDateTime();
                $newClient->password = bcrypt($request->telephone);
                $newClient->created_at = now();
                $newClient->save();
                $message_sms = "Votre access OMNIFORM est \n identifiant:" . $request->email . "\n Mot de passe: " . $request->telephone;
                try {
                    $newSms = new SendSmS();
                    $newSms->send($request->telephone, $message_sms);
                } catch (GuzzleException $e) {
                    // throw new ErrorException("Erreur d'envoi du message , ressayez ultérieurement.");
                }

                $client = $newClient;
            }

            $code_oni = "GN" . $client->id . substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);
            $demande->id_sender = $userConnected->id;
            $demande->nationality = $request->nationality;
            $demande->nationality_state = $request->nationality_state;
            $demande->profession = $request->profession;
            $demande->height = $request->height;
            $demande->complexion = $request->complexion;
            $demande->hair_color = $request->hair_color;
            $demande->eye_color = $request->eye_color;
            $demande->father_first_name = $request->father_first_name;
            $demande->father_last_name = $request->father_last_name;
            $demande->mother_first_name = $request->mother_first_name;
            $demande->mother_last_name = $request->mother_last_name;
            $demande->numero_recu = $request->numero_recu;
            $demande->address = $request->address;
            $demande->birth_address = $request->birth_address;
            $demande->id_client = $client->id;
            $demande->id_product = null;
            $demande->id_service = null;
            $demande->id_point_enrolement = null;
            $demande->code_demande = $code_oni;
            $demande->type_request = $type_demande;
            $demande->predemande_step = 1;
            $demande->habilete_position = 0;
            $demande->created_at = now();
            $fileUrls = [];

            if ($request->hasFile("document1")) {
                $document1 = $request->file('document1');
                $validFiles = true; // Indicateur pour vérifier si tous les fichiers sont valides
                if (is_array($document1) && count($document1) > 0) {
                    foreach ($document1 as $key => $file) {
                        $extension = $file->getClientOriginalExtension();
                        $uuid = (string)Str::uuid() . '.' . $extension;
                        $file->storeAs('public/documents/', $uuid);

                        $fileUrls[] = Storage::url('documents/' . $uuid);
                    }
                } else {
                    $extension = $document1->getClientOriginalExtension();
                    $uuid = (string)Str::uuid() . '.' . $extension;
                    $document1->storeAs('public/documents/', $uuid);
                    $fileUrls[] = Storage::url('documents/' . $uuid);
                }
            }
            if ($request->hasFile("document2")) {

                $document2 = $request->file('document2');
                if (is_array($document2) && count($document2) > 0) {
                    foreach ($document2 as $key => $file) {
                        $extension = $file->getClientOriginalExtension();
                        $uuid = (string)Str::uuid() . '.' . $extension;
                        /** @var UploadedFile $file */
                        $file->storeAs('public/clients/', $uuid);
                        $demande->avatar_url = Storage::url('clients/' . $uuid);
                    }
                } else {
                    $extension = $document2->getClientOriginalExtension();
                    $uuid = (string)Str::uuid() . '.' . $extension;
                    /** @var UploadedFile $file */
                    $document2->storeAs('public/clients/', $uuid);
                    $demande->avatar_url = Storage::url('clients/' . $uuid);
                }
            }
            $demande->document_url = implode(',', $fileUrls);

            $demande->save();

            $newSms = new SendSmS();
            $message_sms = "Votre pré-demande a été enregistée. Merci de votre confiance";
            try {
                $newSms->send($request->telephone, $message_sms);
            } catch (GuzzleException $e) {
                // throw new ErrorException("Erreur d'envoi du message , ressayez ultérieurement.");
            }

            $demandeSave = Demande::with(['client', 'sender',])->where("id", "=", $demande->id)->first();

            $dataAttachment = [
                'title' => 'Pré-demande: ' . $demandeSave->code_demande,
                'body' => "Votre demande a été enregistré. $message_sms"
            ];

            $attachment = [
                'name' => '',
                'data' => ""
            ];

            try {
                $detail = [
                    'username' => $userConnected->nom_client,
                ];

                $subject = "Email de confirmation de la pré-demande ";
                Mail::to($userConnected->email_client)->send(new PreRendezVousDemandeMail($subject, $detail, []));
            } catch (Exception $ex) {
                // DB::rollBack();
                // $data["demande"] = null;
                // $data["message"] = "Echèc de l'enregistré l'envoi de votre recu a échoué";
                // $data["details"] = $ex->getMessage();
                // return response()->json($data);
            }
            DB::commit();
            $data["status"] = 200;
            $data["message"] = "Pré-demande enregistrée";
            $data["demande"] = $demande;


            return response()->json($data);
        } catch (Exception $ex) {
            DB::rollBack();
            $data["demande"] = null;
            $data["message"] = "Echèc de l'enregistré";
            $data["details"] = $ex->getMessage();
            return response()->json($data, 500);
        }
    }

    /**
     * @param $code_demande
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public   function voirStatutDeMaDemande($code_demande)
    {

        // ->where('id_client',  session('infoUserClient')->id)
        $maDemande = DB::table('demande')->where('code_demande', $code_demande)
            ->join('products', 'products.id', '=', 'demande.id_product')
            ->join('client', 'client.id', '=', 'demande.id_client')
            ->first();


        //dd($maDemande->count());

        return view('client.voirStatutDeMaDemande', ['maDemande' => $maDemande]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public static function get_one_appointment_client(Request $request)
    {

        $maDemande = Demande::where('id', $request->id)->with(['client', 'product', 'service', 'point_enrolement'])->first();
        $maDemande['paiement'] = Paiement::where('id_demande', $request->id)->first();

        $historiques = Historique::where('demande_id', $request->id)->orderBy('created_at', 'desc')->with('client')->with('user')->with('commentaires')->get();


        $data['demande'] = $maDemande;
        $data['historiques'] = $historiques;
        $data['message'] = "ok";

        return response()->json($data);
    }

    public static function get_one_appointment_by_id($id)
    {
        $today = Carbon::today();
        if (request('today')) {
            $today = Carbon::parse(request('today'))->toDateTime();
        }

        $pointEnrolement = PointEnrolement::find($id);

        // Today
        $demandeToday = Demande::where('id_point_enrolement', $id)
            ->whereDate('date_rdv_demande', $today)
            ->with(['client', 'product', 'service', 'point_enrolement']);


        $data['pointEnrolement'] = $pointEnrolement;
        $data['message'] = "ok";
        $data['countToday'] = $demandeToday->count();

        return response()->json($data);
    }
    /**
     * @param $code_demande
     * @return mixed
     */
    public static function generatePDF($code_demande)
    {
        $maDemande = Demande::with(['client', 'product', 'point_enrolement'])
            ->where('code_demande', $code_demande)
            ->first();

        $predemandeQrcode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate($maDemande->code_demande));
        $timbreQrcode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate($maDemande->numero_recu));


        $pdf = PDF::loadView('client.attestationAppointmentPdf', ['title' => 'Recu', 'date' => date('y-m-d'), 'maDemande' => $maDemande, 'code_demande' => $maDemande->code_demande, 'predemandeQrcode' => $predemandeQrcode, 'timbreQrcode' => $timbreQrcode]);
        return $pdf->download('recu_oni_' . $code_demande . '.pdf');
    }

    /**
     * @param Request $request
     * @return JsonResponse|void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cinetpay_notify(Request $request)
    {
        //  dd($request->all());
        $input = $request->all();

        Log::info("notifyCinetPay => content :", $input);

        $id_transaction = $input['cpm_trans_id'];
        $cpm_currency = $input['cpm_currency'];
        $payment_method = $input['payment_method'];
        $cel_phone_num = $input['cel_phone_num'];
        $cpm_phone_prefixe = $input['cpm_phone_prefixe'];
        // apiKey
        $apikey = env('CINETPAY_APP_KEY_PUBLIC'); //$marchand["apikey"];

        try {

            // siteId
            $site_id = $input['cpm_site_id'];

            $CinetPay = new CinetPay($site_id, $apikey, false);

            //Log::info("notifyCinetPay => CinetPay :", $CinetPay->getData());

            //On recupère le statut de la transaction dans la base de donnée
            /* $commande->set_transactionId($id_transaction);
                 //Il faut s'assurer que la transaction existe dans notre base de donnée
             * $commande->getCommandeByTransId();
             */

            $transaction_reference = $id_transaction; // code_demande_id_demande_id_pay_time

            if (empty($transaction_reference)) {
                return response()->json(["status" => "REFUSED", 'error' => ['message' => "Transaction not found", 'transaction_reference' => $transaction_reference],]);
            }
            $splits = explode("_", $transaction_reference);
            Log::info("cinetpayNotify => explode:", ["splits" => $splits]);

            // Recuperation de la ligne de la transaction dans votre base de données

            if (empty($splits) || count($splits) != 4) {
                Log::error("Transaction error", ["status" => "REFUSED", 'message' => "Transaction not found", 'transaction_reference' => $transaction_reference]);

                return response()->json(["status" => "REFUSED", 'error' => ['message' => "Transaction not found", 'transaction_reference' => $transaction_reference],]);
            }

            $paiement = Paiement::where("id_pay", "=", $splits[2])->first();
            $demande = Demande::with(['client', 'product', 'point_enrolement'])->where("id", "=", $splits[1])->first();
            Log::info("cinetpayNotify => paiement:", ["paiement" => $paiement]);

            $responseData = null;
            if ($paiement != null) {
                $CinetPay->getPayStatus($id_transaction, $site_id);
                $amount = $CinetPay->chk_amount;
                $currency = $CinetPay->chk_currency;
                $message = $CinetPay->chk_message;
                $code = $CinetPay->chk_code;
                $metadata = $CinetPay->chk_metadata;
                $metadata = $CinetPay->chk_payment_date;

                //$paiement->exist = true;
                $paiement->id_pay = $splits[2];
                $paiement->amount_pay = $CinetPay->chk_amount;
                $paiement->reference_pay = $transaction_reference;
                $paiement->date_pay = $CinetPay->chk_payment_date;
                $paiement->cpm_currency = $CinetPay->chk_currency;
                $paiement->payment_method = $CinetPay->chk_payment_method;
                $paiement->cel_phone_num = $cel_phone_num;
                $paiement->cpm_phone_prefixe = $cpm_phone_prefixe;
                $paiement->updated_at = now();

                Log::info('cinetpayNotify', ["code" => $code, "paiement" => $paiement],);

                switch ($code) {
                    case '00':
                        $paiement->update();
                        $URL_DOWNLOAD_RECU = $_SERVER['APP_URL'] . "/recuPdf/" . $demande->code_demande;
                        $STATUS_DEMANDE_URL = env('APP_URL') . "/site#/personal-space/my-appointments/documents";

                        $message_sms = "Felicitation! Vous venez de payer $amount GNF pour un passeport . \nFrais 0 GNF . Téléchargez votre recu ici $URL_DOWNLOAD_RECU \nMerci";
                        $message_email = "Votre paiement à été validé \n reference de paiement:" . $transaction_reference . "\n montant: " . $amount;
                        //                        $curl = new \GuzzleHttp\Client();
                        //                        $url = "https://smswanwaran.com/index.php";
                        //                        $response = $curl->request('GET', $url, ['query' => ['app' => "ws", 'u' => "theonemonk",  "from" => "OMNIFORM", 'h' => "67a3e2c5fab0c9f5e4df3286de3f7b5d", 'op' => "pv", 'to' => "224" .  optional($demande->client)->telephone_client, 'msg' => $message_sms,]]);
                        $newSms = new SendSmS();
                        try {
                            $newSms->send(optional($demande->client)->telephone_client, $message_sms);
                        } catch (GuzzleException $e) {
                            throw new ErrorException("Erreur d'envoi du message , ressayez ultérieurement.");
                        }
                        // send ticket an email

                        $pdf = PDF::loadView('client.recuPdf', ['title' => 'Recu', 'date' => date('y-m-d'), 'maDemande' => $demande, 'code_demande' => $demande->code_demande,]);


                        $data = [
                            'title' => 'Reçu de paiement OMNIFORM SERVICE : ' . optional($demande->product)->nom,
                            'body' => $message_email . "\nVotre code document OMNIFORM est " . $demande->code_demande . "\n Veuillez suivre le parcours ici $STATUS_DEMANDE_URL \net télécharger votre recu sur $URL_DOWNLOAD_RECU"
                        ];


                        $attachment = [
                            'name' => 'recu_paiement.pdf',
                            'data' => $pdf->output()
                        ];

                        Mail::to(optional($demande->client)->email_client)->send(new AttachmentTicketMail($data, $attachment));


                        return response()->json(['data' => $paiement, "status" => "ACCEPTED", 'message' => 'paiement éfféctué'], 200);

                    case 'FAILED':
                    case 'CANCELLED':
                    case 'EXPIRED':
                        return response()->json(["status" => "REFUSED", 'data' => null, 'message' => "Échec de l'opération"], 402);
                    default:
                        return response()->json(["status" => "REFUSED", 'message' => 'MISSING_TRANSACTION_STATUS']);
                }
            }
        } catch (Exception $e) {
            Log::error("notifyCinetPay => Exception :", [$e->getMessage(), $e->getLine(), $e]);
            error_log("Caught $e");
            return response()->json(['data' => null, "status" => "REFUSED", 'message' => "Échec de l'opération"]);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function init_pay_demande(Request $request, $id)
    {

        try {
            $demande = Demande::query()->where('id', $request->id)->with(['client', 'product'])->first();
            $apikey = env('CINETPAY_APP_KEY_PUBLIC');
            $site_id = env('CINETPAY_SITE_ID');
            $notify_url = env('APP_URL') . '/api/cinetpayNotify';
            $return_url = env('APP_URL') . '/site#/personal-space/my-appointments/documents';
            $mode = 'PRODUCTION';
            $amount = "200"; //optional($demande->product)->prix;
            $currency = 'XOF';
            $channels = 'ALL';
            $description = 'paiement';
            //Fournir ces variables pour le paiements par carte bancaire
            $customer_name = $demande->prenom_asker; //Le nom du client
            $customer_surname = $demande->nom_asker; //Le prenom du client
            $customer_email = $demande->email_asker; //l'email du client
            $customer_phone_number = $demande->telephone_asker;
            $customer_address = $demande->adresse_asker; //addresse du client
            $customer_city = "Conakry"; // La ville du client
            $customer_country = "GN"; // le code ISO du pays
            $customer_state = "GN"; // le code ISO l'état
            $customer_zip_code = ""; // code postal

            //            $paiement = new Paiement();
            //            $paiement->amount_pay = $amount;
            //            $paiement->reference_pay = null;
            //            $paiement->id_client =  optional($demande->client)->id_client;
            //            $paiement->id_demande = $request->id;
            //            $paiement->created_at = now();
            $paiement = Paiement::query()->where('id_demande', $demande->id)->first();
            Log::info("init_pay_demande => get first Paiement :", ["paiement" => $paiement]);
            if (!$paiement) {
                $paiement = Paiement::query()->create([
                    "amount_pay" => $amount,
                    "reference_pay" => null,
                    "id_client" =>  optional($demande->client)->id,
                    "id_demande" => $request->id,
                    "created_at" => now()
                ]);
            }

            //            $hasSave = $paiement->save();
            $transaction_id = $demande->code_demande . "_" . $demande->id . "_" . $paiement->id_pay . "_" . time();
            Log::info("init_pay_demande => transaction_id:", ["transaction_id" => $transaction_id]);

            $url = "https://api-checkout.cinetpay.com/v2/payment";
            $params = [
                "transaction_id" => $transaction_id,
                "amount" => $amount,
                "currency" => $currency,
                "description" => $description,
                "channels" => $channels,
                "customer_id" => "" .  optional($demande->client)->id,
                "customer_name" => $customer_name,
                "return_url" => $return_url
            ];
            return response()->json([
                'data' => [
                    "url" => $url,
                    "config" => [
                        "apikey" => $apikey,
                        "site_id" => $site_id,
                        "notify_url" => $notify_url,
                        "mode" => $mode
                    ],
                    "params" => $params,
                ]
            ], 200);
        } catch (Exception $exception) {
            Log::error("init_pay_demande => Exception:", ["exception" => $exception->getMessage(), "getLine" => $exception->getLine()]);

            return response()->json(["data" => null, "message" => $exception->getMessage(),]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update_password_client(Request $request)
    {
        try {

            $client = auth('apiJwt')->user();

            if ($client) {
                DB::table('client')->where('id', $client->id)->update(
                    [
                        'password' => bcrypt($request->newPassword),
                    ]
                );
                return response()->json([
                    "message" => "Votre mot de passe vient d'etre changer !",
                    "status" => 200
                ], 200);
            } else {
                return response()->json([
                    "message" => 'Echec de la misse à jour du mot de passe!',
                    "status" => 304
                ], 500);
            }
        } catch (Exception $ex) {
            return response()->json([
                "message" => 'Echec de la misse à jour du mot de passe!',
                "description" => $ex->getMessage(),
                "status" => 500
            ], 500);
        }
    }


    public static function getCurrentPublicHoliday(Request $request)
    {
        try {
            // Holidays
            $start = $request->query('start');
            $end = $request->query('end');

            $events = PublicHoliday::whereBetween('start', [$start, $end])
                ->get(['title', 'start']);

            return response()->json($events);
        } catch (\Exception $ex) {
            return response(500)->json([
                "error" => $ex->getMessage(),
                "file" => $ex->getFile(),
                "line" => $ex->getLine(),
            ]);
        }
    }
}
