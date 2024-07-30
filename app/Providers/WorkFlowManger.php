<?php

namespace App\Providers;

use App\Helpers\SendSmS;
use App\Mail\AttachmentTicketAppointmentMail;
use App\Mail\GlobalSenderMail;
use App\Mail\SimpleMail;
use App\Models\AdminAction;
use App\Models\Commentaire;
use App\Models\Demande;
use App\Models\Habilete;
use App\Models\Historique;
use App\Models\IndexTraitement;
use App\Models\Traitement;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WorkFlowManger
{
   public function userCan($permission)
   {
      $permission = explode(',', $permission);
      $checker = false;
      $user = auth()->user();
      if ($user->id_role === 1) return true;
      if ($user->id_role && $user->id_role === 4) {
         if ($user) {
            $habilete = Habilete::where('id', $user->habilete_id)->with('permissions')->first()->permissions->pluck('libelle');
            // $habilete = Habilete::where('id', 3)->with('permissions')->first()->permissions->pluck('libelle')->toArray();
            if (count(array_intersect($permission, $habilete->toArray())) > 0) {
               $checker = true;
            }
         }
      }
      if (!$checker) abort(404, 'Forbidden');
      return $checker;
   }

   public function getDemandeByHabilete(?User $user, ?string $status = null): ?\Illuminate\Database\Eloquent\Collection
   {
      $demandes = Demande::query();
      if ($user && $user->id_role === 4) {
         $demandes = IndexTraitement::where('habilete_id', $user->habilete_id)
            ->join('demande', 'demande.id', '=', 'index_traitement.id_demande')
            ->where('id_point_enrolement', $user->id_point_enrolement);

         if ($status && $status === "REJECTED") $demandes = $demandes->where('status_demande', $status);
         else if ($status && $status === "TRANSMITTED") {
            $demandes = Traitement::select('id_demande')->where('habilete_id', $user->habilete_id)->groupBy('id_demande')->get()->pluck('id_demande')->toArray();

            return  Demande::whereIn('id', $demandes)
               ->where('id_point_enrolement', $user->id_point_enrolement)
               ->whereIn('status_demande', ['PENDDING', 'OPEN', 'SUSPENDED', 'RESETTED', 'CLOSED'])
               ->with('product', 'service', 'client', 'point_enrolement', 'piece_jointes')->get();
         } else if ($status && $status === "CLOSED") {
            $demandes = Traitement::select('id_demande')->where('habilete_id', $user->habilete_id)->groupBy('id_demande')->get()->pluck('id_demande')->toArray();

            return  Demande::whereIn('id', $demandes)
               ->where('id_point_enrolement', $user->id_point_enrolement)
               ->whereIn('status_demande', ['CLOSED'])
               ->with('product', 'service', 'client', 'point_enrolement', 'piece_jointes')->get();
         } else if ($status && $status === "PRODUCED") {

            $demandes = $demandes->where('production_disponible', 1)->where('id_point_enrolement', $user->id_point_enrolement);
         } else if ($status && $status === "PRE-DEMANDE") {

            return Demande::where('predemande_step', '=', 1)->with('product', 'service', 'client', 'point_enrolement', 'piece_jointes')->get();
         } else if ($status && $status === "PRE-DEMANDE_REJECTED") {
            
            return Demande::where('predemande_step', '=', 1)->where('status_demande', '=', 'REJECTED')->with('product', 'service', 'client', 'point_enrolement', 'piece_jointes')->get();
         } else if ($status && $status === "PRE-DEMANDE_TRANSMITTED") {
            return Demande::where('predemande_step', '=', 2)->with('product', 'service', 'client', 'point_enrolement', 'piece_jointes')->get();
         }else {
            $demandes = $demandes->whereIn('status_demande', ['PENDDING', 'OPEN', 'SUSPENDED', 'RESETTED', 'NEW'])->where('id_point_enrolement', $user->id_point_enrolement)->where('predemande_step', '>', 2);
         }

         $demandes = $demandes->with('demandes.product', 'demandes.service', 'demandes.client', 'demandes.point_enrolement', 'demandes.piece_jointes');
      } else {
         $demandes = $demandes->whereIn('status_demande', ['PENDDING', 'OPEN', 'SUSPENDED', 'RESETTED', 'NEW', 'CLOSED']);
         $demandes = $demandes->with('product', 'service', 'client', 'point_enrolement', 'piece_jointes');
      }
      return $demandes->get();
   }

   public function tranmettreDemande($id, $type)
   {
      $this->userCan('gestion-demandes,consulter-demande');
      $demandeId = $id;
      // Check if not end
      $demande = Demande::find($id);
      $workflowStatus = "PENDING";
      $user = auth()->user();

      $historiques = Historique::where('demande_id', $demandeId)->orderBy('created_at', 'desc')->with('client')->with('user')->with('commentaires')->get();

      if (!$demande) return;

      if ($demande->predemande_step == 1 || $demande->predemande_step == 2) {
         return [
            'demande' => $demande,
            'circuit' => null,
            'workflowStatus' => null,
            'historiques' => $historiques,
            'isTransmitted' => false,
            'isOwner' => false,
         ];
      }

      $habiletes = optional($demande->service)->habiletes;
      $habiletes = is_array($habiletes) ? $habiletes : (is_null($habiletes) ? [] : json_decode($habiletes, true));
      $habilete_position = intval($demande->habilete_position);

      if ((count($habiletes) - 1) === $habilete_position) $workflowStatus = 'END_OF_WORKFLOW';


      $outputArray = [];

      foreach ($habiletes as $item) {
         $outputArray[] = json_decode($item);
      }

      $habiletes = $outputArray;

      // Check if is owner
      $isOwner = in_array($user->habilete_id, $habiletes[$habilete_position]);

      $habiletes_array = [];

      if (count($habiletes) > 0) {
         foreach ($habiletes as $id) {
            $habilete = Habilete::whereIn('id', $id)->get();
            $habiletes_array[] = $habilete;
         }
      }

      if ($type && $isOwner) {
         if ($type === 'TRANSMITTED' && $workflowStatus !== 'END_OF_WORKFLOW' && $this->userCan('gestion-demandes')) {
            $habiletes = $habiletes_array[$habilete_position]->pluck('id')->toArray();

            foreach ($habiletes as $item) {
               $IndexTraitement = IndexTraitement::where('habilete_id', $item);
               if ($IndexTraitement) $IndexTraitement->delete();
            }

            $habiletes = $habiletes_array[$habilete_position + 1]->pluck('id')->toArray();
            foreach ($habiletes as $item) {
               $data1 = [
                  'habilete_id' => intval($item),
                  'id_demande' => $demande->id,
               ];
               IndexTraitement::create($data1);
            }

            $habiletes = $habiletes_array[$habilete_position]->pluck('id')->toArray();
            foreach ($habiletes as $item) {
               $data2 = [
                  'habilete_id' => intval($item),
                  'id_demande' => $demande->id,
                  'action' => 'TRANSMITTED',
               ];

               AdminAction::create($data2);
            }

            $demande->habilete_position = intval($demande->habilete_position) + 1;
            $demande->status_demande = 'PENDDING';
            $demande->save();

            $traitement = new Traitement();
            $traitement->id_demande = $demande->id;
            $traitement->habilete_id = $user->habilete_id;
            $traitement->user_id = $user->id;
            $traitement->action = 'TRANSMITTED';
            $traitement->save();

            // Commentaire
            $historique = new Historique();
            $historique->description = " Transfert de la demande";
            $historique->demande_id =  $demande->id;
            $historique->user_id = auth()->user()->id;
            $historique->save();
         } else if ($type === 'REJECTED' && $habilete_position > 0 && $this->userCan('possibilite-rejeter-dossier')) {
            $habiletes = $habiletes_array[$habilete_position]->pluck('id')->toArray();
            foreach ($habiletes as $item) {
               $IndexTraitement = IndexTraitement::where('habilete_id', $item);
               if ($IndexTraitement) $IndexTraitement->delete();
            }
            $habiletes = $habiletes_array[$habilete_position - 1]->pluck('id')->toArray();

            foreach ($habiletes as $item) {
               $data1 = [
                  'habilete_id' => intval($item),
                  'id_demande' => $demande->id,
               ];

               IndexTraitement::create($data1);
            }

            $habiletes = $habiletes_array[$habilete_position]->pluck('id')->toArray();

            foreach ($habiletes as $item) {
               $data2 = [
                  'habilete_id' => intval($item),
                  'id_demande' => $demande->id,
                  'action' => 'REJECTED',
               ];

               AdminAction::create($data2);
            }

            $demande->habilete_position = intval($demande->habilete_position) - 1;
            $demande->status_demande = 'REJECTED';
            $demande->save();

            // Commentaire
            $historique = new Historique();
            $historique->description = " Rejet de la demande";
            $historique->demande_id =  $demande->id;
            $historique->user_id = auth()->user()->id;
            $historique->save();
         } else if ($type === "SUSPENDED" && $this->userCan('possibilite-suspendre-dossier')) {
            $demande->status_demande = 'SUSPENDED';
            $demande->save();
            // Commentaire
            $historique = new Historique();
            $historique->description = "Suspension de la demande";
            $historique->demande_id =  $demande->id;
            $historique->user_id = auth()->user()->id;
            $historique->save();
         } else if ($type === "RECALLED_SUSPENDED" && $this->userCan('possibilite-de-rapeller-dossier-suspendu')) {
            $demande->status_demande = 'PENDDING';
            $demande->save();

            // Commentaire
            $historique = new Historique();
            $historique->description = "Rappel de la demande";
            $historique->demande_id =  $demande->id;
            $historique->user_id = auth()->user()->id;
            $historique->save();
         }
      }


      $currentUserIndexTraitement = IndexTraitement::where('id_demande', $demandeId)->where('habilete_id', $user->habilete_id)->first();
      $currentUserAdminAction = AdminAction::where('id_demande', $demandeId)->where('habilete_id', $user->habilete_id)->first();
      $isTransmitted = (!$currentUserIndexTraitement && $currentUserAdminAction) ? true : false;
      $isOwner = in_array($user->habilete_id, $outputArray[$demande->habilete_position]);

      return [
         'demande' => $demande,
         'circuit' => $habiletes_array,
         'workflowStatus' => $workflowStatus,
         'isTransmitted' => $isTransmitted,
         'isOwner' => $isOwner,
         'historiques' => $historiques,
      ];
   }

   public function manage(Request $request)
   {
      $demande = Demande::where('id', $request->demande_id)->first();

      if ($request->request_type === "ajouter-numero-recepisse" && $this->userCan("ajouter-numero-recepisse")) {
         $demande->recepice_number = $request->recepice_number;
         $demande->save();


         // Commentaire
         $historique = new Historique();
         $historique->description = "Ajout d'un numéro de recepisse";
         $historique->demande_id =  $request->demande_id;
         $historique->user_id = auth()->user()->id;
         $historique->save();

         if ($request->commentaire) {
            $commentaire = new Commentaire();
            $commentaire->description = $request->commentaire;
            $commentaire->historique_id = $historique->id;
            $commentaire->save();
         }
      } 
      else if ($request->request_type === "possibilite-changer-date-rendez-vous" && $this->userCan("possibilite-changer-date-rendez-vous")){
         $demande->date_rdv_demande = new DateTime($request->date_rdv_demande);
         $demande->save();
          // Commentaire
          $historique = new Historique();
          $historique->description = "Changement de date de rendez-vous";
          $historique->demande_id =  $request->demande_id;
          $historique->user_id = auth()->user()->id;
          $historique->save();
 
          if ($request->commentaire) {
             $commentaire = new Commentaire();
             $commentaire->description = $request->commentaire;
             $commentaire->historique_id = $historique->id;
             $commentaire->save();
          }
      }
      else if ($request->request_type === "ajouter-numero-document" && $this->userCan("ajouter-numero-document")) {
         $demande->numero_document = $request->numero_document;
         $demande->save();

         // Commentaire
         $historique = new Historique();
         $historique->description = "Ajout d'un numéro de document";
         $historique->demande_id =  $request->demande_id;
         $historique->user_id = auth()->user()->id;
         $historique->save();

         if ($request->commentaire) {
            $commentaire = new Commentaire();
            $commentaire->description = $request->commentaire;
            $commentaire->historique_id = $historique->id;
            $commentaire->save();
         }
      } else if ($request->request_type === "acquittement-delivrance-document" && $this->userCan("acquittement-delivrance-document")) {
         $demande->status_demande = "CLOSED";
         $demande->save();

         // Commentaire
         $historique = new Historique();
         $historique->description = "Acquittement de la delivrance du document";
         $historique->demande_id =  $request->demande_id;
         $historique->user_id = auth()->user()->id;
         $historique->save();

         if ($request->commentaire) {
            $commentaire = new Commentaire();
            $commentaire->description = $request->commentaire;
            $commentaire->historique_id = $historique->id;
            $commentaire->save();
         }
      } else if ($request->request_type === "gestion-pre-demande-valider" && $this->userCan("gestion-pre-demande")) {
         $demande->predemande_step = 2;
         $demande->save();

         // Commentaire
         $historique = new Historique();
         $historique->description = "Validation de la pre-demande";
         $historique->demande_id =  $request->demande_id;
         $historique->user_id = auth()->user()->id;
         $historique->save();

         if ($request->commentaire) {
            $commentaire = new Commentaire();
            $commentaire->description = $request->commentaire;
            $commentaire->historique_id = $historique->id;
            $commentaire->save();
         }
      } else if ($request->request_type === "possibilite-d-envoyer-sms" && $this->userCan("possibilite-d-envoyer-sms")) {
         $destinataire = $request->destinataire;
         $contenu = $request->contenu;
         $groupe = $this->getGroupe($destinataire, $demande);
         if ($destinataire === "demandeur") {
            $sender = optional($demande->client)->telephone_client;
            $newSms = new SendSmS();
            $newSms->send($sender, $contenu);
         } 
         else {
            if (isset($groupe) && count($groupe) > 0) {
               $groupe = $groupe->pluck('id')->toArray();
               foreach ($groupe as $key => $value) {
                  $sender = User::where("habilete_id", $value)->get()->pluck('telephone')->toArray();
                  if (count($sender) > 0) {
                     foreach ($sender as $key2 => $value2) {
                        $newSms = new SendSmS();
                        $newSms->send($value2, $contenu);
                     }
                  }
               }
            }
         }

         // Commentaire
         $historique = new Historique();
         $historique->description = " Envoi d'un SMS";
         $historique->demande_id =  $request->demande_id;
         $historique->user_id = auth()->user()->id;
         $historique->save();

         if ($request->commentaire) {
            $commentaire = new Commentaire();
            $commentaire->description = $request->commentaire;
            $commentaire->historique_id = $historique->id;
            $commentaire->save();
         }
      } else if ($request->request_type === "possibilite-d-envoyer-mail" && $this->userCan("possibilite-d-envoyer-mail")) {
         $destinataire = $request->destinataire;
         $contenu = $request->contenu;
         $groupe = $this->getGroupe($destinataire, $demande);

         $attachments = [];

         if ($request->hasFile("pieces_jointes")) {

            foreach ($request->file('pieces_jointes') as $file) {
               $extension = $file->getClientOriginalExtension();
               $uuid = (string)Str::uuid() . '.' . $extension;
               $file->storeAs('public/documents/', $uuid);
               $filePath = storage_path('app/public/documents/' . $uuid);
               $attachments[] = $filePath;
            }
         }

         $message = $contenu;
         $subject = "Commentaire de demande: " . $demande->code_demande;
         if ($destinataire === "demandeur") {
            $sender = optional($demande->client)->email_client;
            Mail::to($sender)->send(new GlobalSenderMail($message, $subject, $attachments));
         } else {
            if (isset($groupe) && count($groupe) > 0) {
               $groupe = $groupe->pluck('id')->toArray();
               foreach ($groupe as $key => $value) {
                  $sender = User::where("habilete_id", $value)->get()->pluck('email')->toArray();
                  if (count($sender) > 0) {
                     foreach ($sender as $key2 => $value2) {
                        Mail::to($value2)->send(new GlobalSenderMail($message, $subject, $attachments));
                     }
                  }
               }
            }
         }

         // Commentaire
         $historique = new Historique();
         $historique->description = " Envoi d'un mail";
         $historique->demande_id =  $request->demande_id;
         $historique->user_id = auth()->user()->id;
         $historique->save();

         if ($request->commentaire) {
            $commentaire = new Commentaire();
            $commentaire->description = $request->commentaire;
            $commentaire->historique_id = $historique->id;
            $commentaire->save();
         }
      } else if ($request->request_type === "gestion-pre-demande-rejeter" && $this->userCan("gestion-pre-demande")) {
         $demande->predemande_step = 1;
         $demande->status_demande = "REJECTED";
         $demande->save();

         // Commentaire
         $historique = new Historique();
         $historique->description = " Rejeter la pre-demande";
         $historique->demande_id =  $request->demande_id;
         $historique->user_id = auth()->user()->id;
         $historique->save();

         if ($request->commentaire) {
            $commentaire = new Commentaire();
            $commentaire->description = $request->commentaire;
            $commentaire->historique_id = $historique->id;
            $commentaire->save();
         }
      } else {
         abort(404, 'Forbidden');
      }
   }

   public function getGroupe($step, Demande $demande)
   {
      if ($step === "demandeur") {
         return null;
      }
      $user = auth()->user();
      $habiletes = optional($demande->service)->habiletes;
      $habiletes = is_array($habiletes) ? $habiletes : (is_null($habiletes) ? [] : json_decode($habiletes, true));
      $habilete_position = intval($demande->habilete_position);
      if ((count($habiletes) - 1) === $habilete_position) return null;
      $outputArray = [];

      foreach ($habiletes as $item) {
         $outputArray[] = json_decode($item);
      }

      $habiletes = $outputArray;

      // Check if is owner
      $isOwner = in_array($user->habilete_id, $habiletes[$habilete_position]);
      $habiletes_array = [];

      if ($isOwner) {
         if (count($habiletes) > 0) {
            foreach ($habiletes as $id) {
               $habilete = Habilete::whereIn('id', $id)->get();
               $habiletes_array[] = $habilete;
            }
         }
         if (isset($habiletes_array[$habilete_position + $step])) return $habiletes_array[$habilete_position + $step];
      }

      return null;
   }

   public function countUsers(Request $request)
   {
      $demande = Demande::where('id', $request->demande_id)->first();
      $destinataire = $request->destinataire;
      $groupe = $this->getGroupe($destinataire, $demande);
      $user = auth()->user();
      $data = [];
      $count = 0;

      if ($destinataire === "demandeur") {
         $data['count'] = 1;
      } else {
         if (isset($groupe) && count($groupe) > 0) {
            $groupe = $groupe->pluck('id')->toArray();
            foreach ($groupe as $key => $value) {
               $sender = User::where("habilete_id", $value)->get()->pluck('telephone')->toArray();
               if (count($sender) > 0) {
                  foreach ($sender as $key2 => $value2) {
                     $count++;
                  }
               }
            }
         }
         $data['count'] = $count;
      }

      if ($request->request_type === "possibilite-d-envoyer-count-user" && $this->userCan("possibilite-d-envoyer-sms,possibilite-d-envoyer-mail")) {
         return $data;
      }
   }
}
