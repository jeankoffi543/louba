<?php

namespace App\Providers;

use App\Models\Habilete;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('kcan', function ($permission) {
            $user = auth()->user();
            $checker = false;
            if ($user) {
                // $habilete = Habilete::where('id', $user->habilete_id)->with('permissions')->first()->permissions->pluck('libelle');
                $habilete = Habilete::where('id', 3)->with('permissions')->first()->permissions->pluck('libelle')->toArray();
                if (in_array($permission, $habilete)) {
                    $checker = true;
                }
            }
            return $checker;
        });

        Blade::directive('dstatus', function ($status) {
            $demande = "Nouveau";
            $color = "#f6b93b";
            switch ($status) {
                case "NEW":
                    $demande = "Nouveau";
                    $color = "#f6b93b";
                    break;
                case "REJECTED":
                    $demande = "Rejeté";
                    $color = "#e55039";
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
                case "PENDING_PAY":
                    $demande = "En attente de paiement";
                    $color = "#f39c12";
                    break;
            }
        
            return "<a href='#' class='btn' style='background-color: $color;'>$demande</a>";
        });

    }
}
