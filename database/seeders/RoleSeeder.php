<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("role")->insertOrIgnore([
            "id" => 1,
            "nom_role" => "Superadmin",
            "description_role" => "Gestion des réclamations",
            "created_at" => NULL,
            "updated_at" => NULL,
        ]);
    }
}
