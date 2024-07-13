<?php

namespace App\Providers;

use App\Models\AdminAction;
use App\Models\Demande;
use App\Models\Habilete;
use App\Models\IndexTraitement;
use App\Models\Traitement;
use App\Models\User;

class WorkFlowManger
{
   public function getDemandeByHabilete(?User $user, ?string $status = null): ?\Illuminate\Database\Eloquent\Collection
   {
      $demandes = Demande::query();
      if ($user && $user->id_role === 4) {
         $demandes = IndexTraitement::where('habilete_id', $user->habilete_id)
            ->join('demande', 'demande.id', '=', 'index_traitement.id_demande')
            ->where('id_point_enrolement', $user->id_point_enrolement);
         if ($status && $status === "REJECTED") $demandes = $demandes->where('status_demande', $status);
         else if ($status && $status === "TRANSMITTED") {
            $demandes = Traitement::where('habilete_id', $user->habilete_id)
               ->join('demande', 'demande.id', '=', 'traitements.id_demande')
               ->where('id_point_enrolement', $user->id_point_enrolement)
               ->whereIn('status_demande', ['PENDING', 'OPEN', 'SUSPENDED']);
         }else{
            $demandes = $demandes->whereIn('status_demande', ['PENDING', 'OPEN', 'SUSPENDED']);
         }
         $demandes = $demandes->with('demandes.product', 'demandes.service', 'demandes.client', 'demandes.point_enrolement');
      }
      return $demandes->get();
   }

   public function tranmettreDemande($id, $type)
   {
      $demandeId = $id;
      // Check if not end
      $demande = Demande::find($id);
      $workflowStatus = "PENDING";
      $user = auth()->user();

      if (!$demande) return;

      $habiletes = $demande->service->habiletes;
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
         if ($type === 'TRANSMITTED' && $workflowStatus !== 'END_OF_WORKFLOW') {
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
         } else if ($type === 'REJECTED' && $habilete_position > 0) {
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
      ];
   }
}
