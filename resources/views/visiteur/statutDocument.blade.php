@extends('visiteur.layoutvisiteur')


@section('content')
    @include('visiteur.style')
    <style>
        .sr-only1 {
            font-weight: bold;
            margin-left: 10px;
            color: #000;
        }


        .oooo {
            margin-bottom: 10px
        }


        .byline {
            text-align: center;
            font-size: 18px;
        }

        .byline a {
            text-decoration: none;
            color: #ce0000;
        }

        #gradient {
            width: 0;
            height: 50px;
            margin: 0 auto;
            border-radius: 100%;
            -webkit-box-shadow: 0 50px 200px 150px rgba(255, 255, 255, 0.93);
            -moz-box-shadow: 0 50px 200px 150px rgba(255, 255, 255, 0.93);
            box-shadow: 0 50px 200px 150px rgba(255, 255, 255, 0.93);
        }

        .searchbox {
            background-color: #fffbf8;
            padding: 13px;
            width: 335px;
            margin: 100px auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            border-radius: 6px;
            -webkit-box-shadow: 0 2px 4px 0 rgba(72, 72, 72, 0.83),
            0 10px 15px 0 rgba(126, 126, 126, 0.12),
            0 -2px 6px 1px rgba(199, 199, 199, 0.55) inset,
            0 2px 4px 2px rgba(255, 255, 255, 0.83) inset;
            -moz-box-shadow: 0 2px 4px 0 rgba(72, 72, 72, 0.83),
            0 10px 15px 0 rgba(126, 126, 126, 0.12),
            0 -2px 6px 1px rgba(199, 199, 199, 0.55) inset,
            0 2px 4px 2px rgba(255, 255, 255, 0.83) inset;
            box-shadow: 0 2px 4px 0 rgba(72, 72, 72, 0.83),
            0 10px 15px 0 rgba(126, 126, 126, 0.12),
            0 -2px 6px 1px rgba(199, 199, 199, 0.55) inset,
            0 2px 4px 2px rgba(255, 255, 255, 0.83) inset;
        }

        input[type="search"] {
            width: 400px;
            height: 55px;
            padding-left: 15px;
            border-radius: 6px;
            border: none;
            color: #939393;
            font-weight: 500;
            background-color: #fffbf8;
            -webkit-box-shadow: 0 -2px 2px 0 rgba(199, 199, 199, 0.55),
            0 1px 1px 0 #fff,
            0 2px 2px 1px #fafafa,
            0 2px 4px 0 #b2b2b2 inset,
            0 -1px 1px 0 #f2f2f2 inset,
            0 15px 15px 0 rgba(41, 41, 41, 0.09) inset;
            -moz-box-shadow: 0 -2px 2px 0 rgba(199, 199, 199, 0.55),
            0 1px 1px 0 #fff,
            0 2px 2px 1px #fafafa,
            0 2px 4px 0 #b2b2b2 inset,
            0 -1px 1px 0 #f2f2f2 inset,
            0 15px 15px 0 rgba(41, 41, 41, 0.09) inset;
            box-shadow: 0 -2px 2px 0 rgba(199, 199, 199, 0.55),
            0 1px 1px 0 #fff,
            0 2px 2px 1px #fafafa,
            0 2px 4px 0 #b2b2b2 inset,
            0 -1px 1px 0 #f2f2f2 inset,
            0 15px 15px 0 rgba(41, 41, 41, 0.09) inset;
        }

        button[type="submit"] {
            height: 30px;
            background-repeat: no-repeat;
            background-position: 10px 5px;
            background-color: transparent;
            -webkit-background-size: 20px 20px;
            background-size: 20px 20px;
            border: none;
            cursor: pointer;
        }

        input[type="search"]:focus {
            outline: 0;
        }

    </style>


    <div class="page-title">
        <div class="container clearfix">

            <div class="sixteen columns" style='background-image: url(imgg/passeportbg.png);'>
                <h1>Statut Document</h1>
            </div>

        </div><!-- End Container -->
    </div><!-- End Page title -->




    <div class="container clearfix" style="text-align:center">


        <form method="POST" action="/suivreMesDocuments">
            @csrf

            <div class="waviy" style="color:black">
                <h3 style="display:inline;color:#ffc107;font-weight:normal">Verifier le statut de votre Document</h3>


            </div>
            <input styte="width:80%;max-width:500px" name="code_demande" type="search" id="form1" class="form-control"
                   placeholder="Code Demande (recu par sms ou par email)"
                   value="<?php if( isset($code_demande) ) echo $code_demande; ?>" required/>
            <input type="hidden" name="view" value="control"/>


            <button type="submit"><a class="button medium color">Verifier <i class="icon-search"></i></a></button>
        </form>

    </div><!-- End Container -->


    @if( isset($demandes) )

        @if(  $demandes->count() == 0 )

            <div style="text-align:center;margin-top:30px">Aucun resultat trouver avec les code <span
                    style="font-weight:bold;color:black">{{$code_demande}}</span></div>

        @else

            @foreach( $demandes as $demande )
                <!-- Start main content -->
                <div class="container main-content clearfix">


                    <div class="two-thirds column bottom-3">
                        <h3 class="title bottom-2">Code demande : {{$demande->code_demande}}</h3>


                        <div class="form-group mb-2 oooo">
                            <label for="staticEmail2" class="sr-only">Statut Demande : </label>
                            <label for="staticEmail2" class="sr-only1">
                                @if( $demande->status_demande == -1 )
                                    Echec: dossier non conforme
                                @elseif( $demande->status_demande == 0 )
                                    En attente de rendez-vous
                                @elseif( $demande->status_demande == 1 )
                                    Rendez-vous fait, maintenant en attente de retrait
                                @elseif( $demande->status_demande == 2 )
                                    retrait
                                @elseif( $demande->status_demande == -2 )
                                    en attente de paiement
                                @else

                                @endif
                            </label>
                        </div>

                        <div class="form-group mb-2 oooo">
                            <label for="staticEmail2" class="sr-only">Document Demande : </label>
                            <label for="staticEmail2" class="sr-only1">
                            {{$demande->nom_type_document}}
                        </div>

                        <div class="form-group mx-sm-3 mb-2 oooo">
                            <label for="inputPassword2" class="sr-only">Point d'enrolement : </label>
                            <label for="staticEmail2" class="sr-only1">{{$demande->nom_pe}}</label>
                        </div>

                        <div class="form-group mx-sm-3 mb-2 oooo">
                            <label for="inputPassword2" class="sr-only">Contact Point d'enrolement : </label>
                            <label for="staticEmail2" class="sr-only1">{{$demande->telephone_pe}}</label>
                        </div>

                        <div class="form-group mx-sm-3 mb-2 oooo">
                            <label for="inputPassword2" class="sr-only">Date d'enrolement : </label>
                            <label for="staticEmail2" class="sr-only1">{{$demande->date_enregistrement_demande}}</label>
                        </div>


                            <?php
                            /*
                               <div class="form-group mx-sm-3 mb-2 oooo">
                                <label for="inputPassword2" class="sr-only" style="opacity:0" >Statut paaiement : </label>
                             <!-- Le conteneur des boutons PayPal -->
                            <div id="paypal-boutons"></div>

                            <!-- 1. Importation de la SDK JavaScript PayPal -->
                            <script src="https://www.paypal.com/sdk/js?client-id=AbKxXLKd7gfuvdmVvuijDzhWr-mId8zuuQkJLud563sI3GEaznL2dcC9KJNcqUIZobkJf8yu1DpXFTCH"></script>
                            <script>
                                // 2. Afficher le bouton PayPal
                                paypal.Buttons({

                                    // 3. Configurer la transaction
                                    createOrder : function (data, actions) {

                                        // Les produits à payer avec leurs details
                                        var produits = [
                                            {
                                                name : "Produit 1",
                                                description : "Description du produit 1",
                                                quantity : 1,
                                                unit_amount : { value : 9.9, currency_code : "USD" }
                                            },
                                            {
                                                name : "Produit 2",
                                                description : "Description du produit 2",
                                                quantity : 1,
                                                unit_amount : { value : 8.0, currency_code : "USD" }
                                            }
                                        ];

                                        // Le total des produits
                                        var total_amount = produits.reduce(function (total, product) {
                                            return total + product.unit_amount.value * product.quantity;
                                        }, 0);

                                        // La transaction
                                        return actions.order.create({
                                            purchase_units : [{
                                                items : produits,
                                                amount : {
                                                    value : total_amount,
                                                    currency_code : "USD",
                                                    breakdown : {
                                                        item_total : { value : total_amount, currency_code : "USD" }
                                                    }
                                                }
                                            }]
                                        });
                                    },

                                    // 4. Capturer la transaction après l'approbation de l'utilisateur
                                    onApprove : function (data, actions) {
                                        return actions.order.capture().then(function(details) {

                                            // Afficher Les details de la transaction dans la console
                                            console.log(details);

                                            // On affiche un message de succès
                                            alert(details.payer.name.given_name + ' ' + details.payer.name.surname + ', votre transaction est effectuée. Vous allez recevoir une notification très bientôt lorsque nous validons votre paiement.');

                                        });
                                    },

                                    // 5. Annuler la transaction
                                    onCancel : function (data) {
                                        alert("Transaction annulée !");
                                    }

                                }).render("#paypal-boutons");

                            </script>
                              </div>

                            <style>
                            .paypal-powered-by > .paypal-button-text, .paypal-powered-by > .paypal-logo {
                              display: none;
                              vertical-align: middle;
                              height: 16px;
                              line-height: 16px;
                              font-size: 11px;
                            }
                            </style>
                            */
                            ?>

                    </div><!-- End Methodology -->


                    <div class="one-third column bottom-3">
                        <h3 class="title bottom-2" style='display:none'>La procedure</h3>

                        <ul class="check-list why" style='display:none'>
                            <li><a href="#">Prenez rendez-vous</a></li>
                            <li><a href="#">Presentez-vous au point d'enrollement a la date choisie</a></li>
                            <li><a href="#">Representez-vous au point d'enrollemnent pour le retrait de votre
                                    document</a></li>
                        </ul><!-- End check-list -->

                    </div><!-- End Why Choose Us -->


                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
                          integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
                    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
                            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

                    <style>

                        .leaflet-container {
                            height: 400px;
                            width: 600px;
                            max-width: 100%;
                            max-height: 100%;
                        }

                        .leaflet-bottom {
                            display: none;
                        }
                    </style>


                    <div id="map" style="width: 100%; height: 400px;border:2px solid green"></div>
                    <script>

                        const map = L.map('map').setView([{{$demande->longitude_pe}}, {{$demande->latitude_pe}}], 13);

                        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        }).addTo(map);

                        const marker = L.marker([{{$demande->longitude_pe}}, {{$demande->latitude_pe}}]).addTo(map)
                            .bindPopup('<b>Point d enrolement de </b><br />{{$demande->nom_pe}}').openPopup();


                        map.on('click', onMapClick);

                    </script>


                </div><!-- <<< End Container >>> -->

            @endforeach

        @endif

    @endif

@stop
