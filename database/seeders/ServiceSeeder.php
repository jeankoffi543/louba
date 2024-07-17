<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("service")->insertOrIgnore([
            0 => [
                "id" => 1,
                "name" => "Service VIP",
                "image" => Storage::disk('public')->url("services/vip.png"),
                "created_at" => Date::now()->format("Y-m-d H:i:s"),
                "updated_at" => Date::now()->format("Y-m-d H:i:s"),
                "is_public" => true,
                "visible_in_flow" => true,

            ],
            1 => [
                "id" => 2,
                "name" => "Service Express",
                "image" => Storage::disk('public')->url("services/urgence.png"),
                "created_at" => Date::now()->format("Y-m-d H:i:s"),
                "updated_at" => Date::now()->format("Y-m-d H:i:s"),
                "is_public" => true,
                "visible_in_flow" => true,

            ],
            2 => [
                "id" => 3,
                "name" => "Statut de mon document",
                "image" => Storage::disk('public')->url("services/doc.png"),
                "created_at" => Date::now()->format("Y-m-d H:i:s"),
                "updated_at" => Date::now()->format("Y-m-d H:i:s"),
                "is_public" => true,
                "visible_in_flow" => false,

            ],
            3 => [
                "id" => 4,
                "name" => "Trouver un centre",
                "image" => Storage::disk('public')->url("services/place.png"),
                "created_at" => Date::now()->format("Y-m-d H:i:s"),
                "updated_at" => Date::now()->format("Y-m-d H:i:s"),
                "is_public" => true,
                "visible_in_flow" => false,

            ],
            4 => [
                "id" => 5,
                "name" => "Service Ordinaire",
                "image" => Storage::disk('public')->url("services/service-de-qualite.png"),
                "created_at" => Date::now()->format("Y-m-d H:i:s"),
                "updated_at" => Date::now()->format("Y-m-d H:i:s"),
                "is_public" => false,
                "visible_in_flow" => true,
            ],
        ]);
    }
}
