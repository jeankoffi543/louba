<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PointEnrolementLienTypeDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table("point_enrolement_products")->insertOrIgnore([
            0 => [
                "id" => 1,
                "id_point_enrolement" => 1,
                "id_product" => 3,
            ],
            1 => [
                "id" => 2,
                "id_point_enrolement" => 2,
                "id_product" => 1,
            ],
            2 => [
                "id" => 3,
                "id_point_enrolement" => 3,
                "id_product" => 1,
            ],
            3 => [
                "id" => 4,
                "id_point_enrolement" => 4,
                "id_product" => 4,
            ]
        ]);
    }
}
