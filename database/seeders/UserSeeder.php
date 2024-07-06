<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("users")->insertOrIgnore([
            "id" => 1,
            "nom" => "Ibrahima Sory Junior TOURE",
            "email" => "toureisjunior@gmail.com",
            "telephone" => "628748484",
            "email_verified_at" => NULL,
            "password" => Hash::make("123456"),
            "id_role" => 1,
            "id_point_enrolement" => 1,
            "actif" => 1,
            "remember_token" => NULL,
        ]);
    }
}
