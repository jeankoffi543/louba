<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class PointEnrolmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("point_enrolement")->insertOrIgnore([
            [
                "id_pe" => 1,
                "nom_pe" => "Coléah",
                "capacite_maximale_jour_pe" => 10,
                "id_creation_pe" => Date::now()->format("Y-m-d H:i:s"),
                "longitude_pe" => "9.6412",
                "latitude_pe" => "-13.5784",
                "telephone_pe" => "620-111-222",
                "email_pe" => "contact@oni.gov.gn",
                "created_at" => NULL,
                "updated_at" => NULL,
            ],

            [
                "id_pe" => 2,
                "nom_pe" => "Kindia",
                "capacite_maximale_jour_pe" => 10,
                "id_creation_pe" => Date::now()->format("Y-m-d H:i:s"),
                "longitude_pe" => "9.6412",
                "latitude_pe" => "-13.5784",
                "telephone_pe" => "620-111-222",
                "email_pe" => "contact@oni.gov.gn",
                "created_at" => NULL,
                "updated_at" => NULL,
            ],
            [
                "id_pe" => 3,
                "nom_pe" => "Mamou",
                "capacite_maximale_jour_pe" => 10,
                "id_creation_pe" => Date::now()->format("Y-m-d H:i:s"),
                "longitude_pe" => "9.6412",
                "latitude_pe" => "-13.5784",
                "telephone_pe" => "620-111-222",
                "email_pe" => "contact@oni.gov.gn",
                "created_at" => NULL,
                "updated_at" => NULL,
            ],
            [
                "id_pe" => 4,
                "nom_pe" => "Labé",
                "capacite_maximale_jour_pe" => 10,
                "id_creation_pe" => Date::now()->format("Y-m-d H:i:s"),
                "longitude_pe" => "9.6412",
                "latitude_pe" => "-13.5784",
                "telephone_pe" => "620-111-222",
                "email_pe" => "contact@oni.gov.gn",
                "created_at" => NULL,
                "updated_at" => NULL,
            ],
            [
                "id_pe" => 5,
                "nom_pe" => "Kankan",
                "capacite_maximale_jour_pe" => 10,
                "id_creation_pe" => Date::now()->format("Y-m-d H:i:s"),
                "longitude_pe" => "9.6412",
                "latitude_pe" => "-13.5784",
                "telephone_pe" => "620-111-222",
                "email_pe" => "contact@oni.gov.gn",
                "created_at" => NULL,
                "updated_at" => NULL,
            ],
            [
                "id_pe" => 6,
                "nom_pe" => "N'Zérékoré",
                "capacite_maximale_jour_pe" => 10,
                "id_creation_pe" => Date::now()->format("Y-m-d H:i:s"),
                "longitude_pe" => "9.6412",
                "latitude_pe" => "-13.5784",
                "telephone_pe" => "620-111-222",
                "email_pe" => "contact@oni.gov.gn",
                "created_at" => NULL,
                "updated_at" => NULL,
            ],
            [
                "id_pe" => 7,
                "nom_pe" => "Faranah",
                "capacite_maximale_jour_pe" => 10,
                "id_creation_pe" => Date::now()->format("Y-m-d H:i:s"),
                "longitude_pe" => "9.6412",
                "latitude_pe" => "-13.5784",
                "telephone_pe" => "620-111-222",
                "email_pe" => "contact@oni.gov.gn",
                "created_at" => NULL,
                "updated_at" => NULL,
            ],
            [
                "id_pe" => 8,
                "nom_pe" => "Boké",
                "capacite_maximale_jour_pe" => 10,
                "id_creation_pe" => Date::now()->format("Y-m-d H:i:s"),
                "longitude_pe" => "9.6412",
                "latitude_pe" => "-13.5784",
                "telephone_pe" => "620-111-222",
                "email_pe" => "contact@oni.gov.gn",
                "created_at" => NULL,
                "updated_at" => NULL,
            ],

        ]);
    }
}
