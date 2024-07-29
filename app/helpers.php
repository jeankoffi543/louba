<?php
if (!function_exists('formatStatus')) {
   function formatStatus($status)
   {
      $demande = "Nouveau";
      $color = "#008000";
      switch ($status) {
         case "NEW":
            $demande = "Nouveau";
            $color = "#008000";
            break;
         case "REJECTED":
            $demande = "Rejeté";
            $color = "#e55039";
            break;
            case "RESETTED":
               $demande = "Réinitialisé";
               $color = "#e55009";
               break;
         case "CANCELED":
            $demande = "Annulé";
            $color = "#3498db";
            break;
         case "SUSPENDED":
            $demande = "Suspendu";
            $color = "#5256ad";
            break;
         case "CLOSED":
            $demande = "Fermé";
            $color = "#16a085";
            break;
         case "PENDDING":
            $demande = "En cours";
            $color = "#f39c12";
            break;
         case "PENDING_PAY":
            $demande = "En attente de paiement";
            $color = "#f39c21";
            break;
      }

      return ['color' => $color, 'label' => $demande];
   }
}
