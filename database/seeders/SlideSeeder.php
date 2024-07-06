<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("slider")->insertOrIgnore([
            0 => [
                "id" => 1,
                "tagdur" => "sl1",
                "titre" => "Passeport, pièce d'identité, extraits de naissance, obtenez tous vos documents administratifs en ligne",
                "paragraphe1" => "Tout étranger doit, pour entrer en République de Guinée être titulaire d'un passeport ou d'un titre de voyage en tenant lieu et en cours de validité, revêtu d'un visa.",
                "paragraphe2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                "image" => Storage::url("sliders/images/bg1.png"),
                "imagebg" => Storage::url("sliders/backgrounds/slider-bg-1.jpg"),
                "boutton" => "non",
                "couleur" => "#000000",
                "date_mise_a_jour" => Date::now()->format("Y-m-d H:i:s"),
                "created_at" => NULL,
                "updated_at" => NULL,
            ],
            1 => [
                "id" => 2,
                "tagdur" => "sl2",
                "titre" => "Une demande en ligne, un rendez-vous et une livraison",
                "paragraphe1" => "Vous souhaitez consulter un document administratif, par exemple un certificat d'urbanisme ou un dossier administratif ? Nous nous en occupons!",
                "paragraphe2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                "image" => Storage::url("sliders/images/passport.png"),
                "imagebg" => Storage::url("sliders/backgrounds/slider-bg-3.jpg"),
                "boutton" => "non",
                "couleur" => "#000000",
                "date_mise_a_jour" => Date::now()->format("Y-m-d H:i:s"),
                "created_at" => NULL,
                "updated_at" => NULL,
            ],
            2 => [
                "id" => 3,
                "tagdur" => "sl3",
                "titre" => "Faire la demande de document administratif n'a jamais été aussi simple",
                "paragraphe1" => "en un clic 2 ligne de formulaire et c'est tout :",
                "paragraphe2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                "image" => Storage::url("sliders/images/sl6-rmbg.png"),
                "imagebg" => Storage::url("sliders/backgrounds/sl50.png"),
                "boutton" => "non",
                "couleur" => "#000000",
                "date_mise_a_jour" => Date::now()->format("Y-m-d H:i:s"),
                "created_at" => NULL,
                "updated_at" => NULL,
            ],
            3 => [
                "id" => 4,
                "tagdur" => "sl4",
                "titre" => "Rectifier simplement les erreurs de frappe de vos documents administratifs",
                "paragraphe1" => "Le téléservice de LOUBA vous assistera en un bref délai!",
                "paragraphe2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                "image" => Storage::url("sliders/images/sl7-rmbg.png"),
                "imagebg" => Storage::url("sliders/backgrounds/slider-bg-2.jpg"),
                "boutton" => "non",
                "couleur" => "#000000",
                "date_mise_a_jour" => Date::now()->format("Y-m-d H:i:s"),
                "created_at" => NULL,
                "updated_at" => NULL,
            ],
            4 => [
                "id" => 5,
                "tagdur" => "sl5",
                "titre" => "Document concernant une personne tierce ? Pas de problème",
                "paragraphe1" => "Vous êtes son mandataire avec les documents requis à l'appui, alors le document est communicable si l'administration peut préserver la confidentialité des informations en masquant les informations personnelles.",
                "paragraphe2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                "image" => Storage::url("sliders/images/sl8.png"),
                "imagebg" => Storage::url("sliders/backgrounds/slider-bg-3.jpg"),
                "boutton" => "oui",
                "couleur" => "#000000",
                "date_mise_a_jour" => Date::now()->format("Y-m-d H:i:s"),
                "created_at" => NULL,
                "updated_at" => NULL,
            ],

        ]);

    }
}
