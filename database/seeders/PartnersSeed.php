<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PartnersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partners')->insertOrIgnore([
            [
                "path" => Storage::url("partners/ecobank-bg-white.jpg"),
                "name" => "Eco bank",
            ],
            [
                "path" => Storage::url("partners/dcpaf.png"),
                "name" => "Direction centrale de la Police aux frontières"
            ],
            [
                "path" => Storage::url("partners/iris.png"),
                "name" => "IRIS Corporation Berhad"
            ],
            [
                "path" => Storage::url("partners/bsic.jpg"),
                "name" => "BSIC Guinée"
            ],
            [
                "path" => Storage::url("partners/orange-money.png"),
                "name" => "Orange Money"
            ],
            [
                "path" => Storage::url("partners/fbn.webp"),
                "name" => "FBN Bank Guinée"
            ],
            [
                "path" => Storage::url("partners/etrang.jpeg"),
                "name" => "Ministère des Affaires Étrangères"
            ],
            [
                "path" => Storage::url("partners/mari-fala.png"),
                "name" => "Mari Fala"
            ],
            [
                "path" => Storage::url("partners/radian.png"),
                "name" => "Radian"
            ],
        ]);
    }
}
