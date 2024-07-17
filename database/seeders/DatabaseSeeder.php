<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            PointEnrolmentSeeder::class,
            UserSeeder::class,
            ServiceSeeder::class,
            PointEnrolementLienTypeDocumentSeeder::class,
            ProductSeed::class,
            SlideSeeder::class,
            TeamSeeder::class,
            ActualitySeeder::class,
            PartnersSeed::class,
            SocialLinkSeed::class,
        ]);
    }
}
