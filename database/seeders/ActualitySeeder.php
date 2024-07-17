<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ActualitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("actuality")->insertOrIgnore([
            0 => [
                "id" => 1,
                "tagdur" => "actualite1",
                "titre" => "actualite1",
                "paragraphe1" => '<p>Lorem ipsum dolor sit amet, <span style="color:#FF0000">consectetur</span> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>',
                "paragraphe2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                "image" => Storage::url("actualities/passportd.jpg"),
                "created_at" => Date::now(),
                "updated_at" => Date::now(),
            ],
            1 => [
                "id" => 2,
                "tagdur" => "actualite2",
                "titre" => "actualite2",
                "paragraphe1" => '<p>Lorem ipsum dolor sit amet, <span style="color:#FF0000">consectetur</span> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>',
                "paragraphe2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                "image" => Storage::url("actualities/passportd.jpg"),
                "created_at" => Date::now(),
                "updated_at" => Date::now(),
            ]
        ]);

    }
}
