<?php

namespace Database\Seeders;

use Akaunting\Apexcharts\Options\Stroke;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("equipe")->insertOrIgnore([
            0 => [
                "id" => 1,
                "nom_prenom" => "nom et prenom1",
                "poste" => "DG",
                "description" => "charger de la direction generale",
                "image" => Storage::url("team/member-1.jpg"),
            ],
            1 => [
                "id" => 2,
                "nom_prenom" => "nom et prenom1",
                "poste" => "comptable",
                "description" => "charger de la direction generale",
                "image" => Storage::url("team/member-1.jpg"),
            ],
            2 => [
                "id" => 3,
                "nom_prenom" => "nom et prenom1",
                "poste" => "DGA",
                "description" => "charger de la direction generale",
                "image" => Storage::url("team/member-1.jpg"),
            ],
            3 => [
                "id" => 4,
                "nom_prenom" => "nom et prenom1",
                "poste" => "Directeur d operation",
                "description" => "charger de la direction generale",
                "image" => Storage::url("team/member-1.jpg"),
            ],
        ]);

    }

}
