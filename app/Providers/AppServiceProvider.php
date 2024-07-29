<?php

namespace App\Providers;

use App\Models\Habilete;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

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
        $this->app->singleton(WorkFlowManger::class, function (Application $app) {
            return new WorkFlowManger();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('kcan', function ($permission) {
            $checker = false;
            $user = auth()->user();
            if ($user->id_role === 1) return true;
            if ($user->id_role && $user->id_role === 4) {
                $permission = explode(',', trim($permission));
                if ($user) {
                    $habilete = Habilete::where('id', $user->habilete_id)->with('permissions')->first()->permissions->pluck('libelle');
                    // $habilete = Habilete::where('id', 3)->with('permissions')->first()->permissions->pluck('libelle')->toArray();
                    if (count(array_intersect($permission, $habilete->toArray())) > 0) {
                        $checker = true;
                    }
                }
            }
            return $checker;
        });

        Blade::if('kis_superadmin', function () {
            $checker = false;
            $user = auth()->user();
            if ($user->id_role === 1) return true;
            return $checker;
        });

        Blade::directive('dstatus', function ($status) {
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
