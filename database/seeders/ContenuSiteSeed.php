<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ContenuSiteSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("contenu_site")->insertOrIgnore([

            0 => [
                "id" => 3,
                "tagdur" => "directeur-general",
                "titre" => "A propos de nous ?",
                "paragraphe1" => '<p>Nous sommes la société qui produit les passeports et autres documents biométriques pour les Guinéens vivant en République de Guinée et ceux vivant à l\'étranger.
                Depuis près de 8 ans, notre mission est de fournir aux demandeurs des documents sûrs et Rables. Nous nous sommes fixés des défis qui nous ont permis de délivrer l\'un des meilleurs passeports biométriques en termes de qualité.
                La contribution à la mission d\'octroi de documents aux étrangers souhaitant venir sur le territoire Guinéen soit pour un séjour, soit pour s\'y installer, constitue pour nous une énorme fierté.</p>',
                "paragraphe2" => "La contribution à la mission d'octroi de documents aux étrangers souhaitant venir sur le territoire Guinéen soit pour un séjour, soit pour s'y installer, constitue pour nous une énorme fierté.
                Aujourd'hui, nous sommes en phase de lancement du projet pour l'obtention du casier judiciaire sécurisé.
                Nos services permettent aux demandeurs d'accélérer leur processus d'obtention de documents et de garantir la sécurité de l'outil de production.",
                "image" => "/imgg/group.jpg",
                "date_mise_a_jour" => Date::now()->format("Y-m-d H:i:s"),
                "type" => "article",
                "created_at" => NULL,
                "updated_at" => NULL,
            ],
            1 => [
                "id" => 4,
                "tagdur" => "service-vip",
                "titre" => "service vip",
                "paragraphe1" => '<p><u>loremm ipsum dolor sit</u> amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>',
                "paragraphe2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                "image" => "/imgg/passportd.jpg",
                "date_mise_a_jour" => Date::now()->format("Y-m-d H:i:s"),
                "type" => "article",
                "created_at" => NULL,
                "updated_at" => NULL,
            ],
            2 => [
                "id" => 5,
                "tagdur" => "procedure-d-urgence",
                "titre" => "service vip",
                "paragraphe1" => '<p><u>loremm ipsum dolor sit</u> amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>',
                "paragraphe2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                "image" => "/imgg/passportd.jpg",
                "date_mise_a_jour" => Date::now()->format("Y-m-d H:i:s"),
                "type" => "article",
                "created_at" => NULL,
                "updated_at" => NULL,
            ],
            3 => [
                "id" => 6,
                "tagdur" => "oni-en-chiffre",
                "titre" => "ONI en chiffre",
                "paragraphe1" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                "paragraphe2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                "image" => "/uploads/1669326241-evacuation.png",
                "date_mise_a_jour" => Date::now()->format("Y-m-d H:i:s"),
                "type" => "article",
                "created_at" => NULL,
                "updated_at" => NULL,
            ],
            4 => [
                "id" => 7,
                "tagdur" => "presentation",
                "titre" => "Présentation",
                "paragraphe1" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                "paragraphe2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                "image" => "/uploads/1669343488-three-dots2.svg",
                "date_mise_a_jour" => Date::now()->format("Y-m-d H:i:s"),
                "type" => "article",
                "created_at" => NULL,
                "updated_at" => NULL,
            ],
        ]);

    }
}
