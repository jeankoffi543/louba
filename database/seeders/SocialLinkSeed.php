<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SocialLinkSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("socials")->insertOrIgnore([

            0 => [

                "image" => Storage::url("socials/facebook.svg"),
                "name" => "facebook",
                "link" => "",
                "created_at" => now(),
                "updated_at" => now()
            ],
            1 => [

                "image" => Storage::url("socials/instagram.svg"),
                "name" => "instagram",
                "link" => "",
                "created_at" => now(),
                "updated_at" => now()
            ],
            2 => [

                "image" => Storage::url("socials/twitter.svg"),
                "name" => "twitter",
                "link" => "",
                "created_at" => now(),
                "updated_at" => now()
            ],
            3 => [

                "image" => Storage::url("socials/snapchat.svg"),
                "name" => "snapshat",
                "link" => "",
                "created_at" => now(),
                "updated_at" => now()
            ],
        ]);
    }
}
