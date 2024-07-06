<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("products")->insertOrIgnore([
            0 => [
                "id" => 1,
                "nom" => "Passeports",
                "image" => Storage::disk('public')->url("products/passe.png"),
                "prix" => 10000,
                "is_active" => true,
                "created_at" => Date::now()->format("Y-m-d H:i:s"),
                "updated_at" => Date::now()->format("Y-m-d H:i:s"),
                "flow_enable" => true,
                "select_service_is_required" => true,
            ],
            1 => [
                "id" => 2,
                "nom" => "E-Visa",
                "image" => Storage::disk('public')->url("products/visas.png"),
                "prix" => 10000,
                "is_active" => true,
                "created_at" => Date::now()->format("Y-m-d H:i:s"),
                "updated_at" => Date::now()->format("Y-m-d H:i:s"),
                "flow_enable" => false,
                "select_service_is_required" => false,

            ],
            2 => [
                "id" => 3,
                "nom" => "Carte de séjour",
                "image" => Storage::disk('public')->url("products/sejour.png"),
                "prix" => 10000,
                "is_active" => true,
                "created_at" => Date::now()->format("Y-m-d H:i:s"),
                "updated_at" => Date::now()->format("Y-m-d H:i:s"),
                "flow_enable" => true,
                "select_service_is_required" => true,


            ],
            3 => [
                "id" => 4,
                "nom" => "Casiers judiciaires",
                "image" => Storage::disk('public')->url("products/cass.png"),
                "prix" => 10000,
                "is_active" => true,
                "created_at" => Date::now()->format("Y-m-d H:i:s"),
                "updated_at" => Date::now()->format("Y-m-d H:i:s"),
                "flow_enable" => false,
                "select_service_is_required" => false,

            ],
        ]);

    }
}
