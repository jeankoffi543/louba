@extends('client.layout')


@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Paiement</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Paiement</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">


                                <div class="card-body">
                                    <h5 class="card-title">Montant Net a payer <span></span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>

                                        </div>
                                        <div class="ps-3">
                                            <h6>10.000 GNF</h6>
                                            <span class="text-success small pt-1 fw-bold">+3%</span> <span
                                                class="text-muted small pt-2 ps-1">frais</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->


                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">


                                <div class="card-body">
                                    <h5 class="card-title">Document demandé
                                        <span>| {{$maDemande->id}}</span></h5>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{$maDemande->nom}}</h6>
                                            <span class="text-success small pt-1 fw-bold"></span> <span
                                                class="text-muted small pt-2 ps-1"></span>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->


                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-cahrd cushtomers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Informations sur la personne <span></span></h5>

                                    <div class="activity-item d-flex">
                                        <div class="activite-label">Nom</div>
                                        <div class="activity-content" style="word-wrap: break-word;">
                                            <a href="#"
                                               class="fw-bold text-dark"> {{$maDemande->prenom_client}} {{$maDemande->nom_client}}</a>
                                        </div>
                                    </div><!-- End activity item-->

                                    <div class="activity-item d-flex">
                                        <div class="activite-label">Email</div>
                                        <div class="activity-content" style="word-wrap: break-word;">
                                            {{$maDemande->email_client}}
                                        </div>
                                    </div><!-- End activity item-->

                                    <div class="activity-item d-flex">
                                        <div class="activite-label">Date Naissance</div>
                                        <div class="activity-content">
                                            {{$maDemande->date_naissance_client}}
                                        </div>
                                    </div><!-- End activity item-->


                                    <div class="activity-item d-flex">
                                        <div class="activite-label">Date rendez-vous</div>
                                        <div class="activity-content">
                                            {{$maDemande->date_rdv_demande }}
                                        </div>
                                    </div><!-- End activity item-->


                                </div>
                            </div>

                        </div><!-- End Customers Card -->


                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                    <!-- Recent Activity -->
                    <div class="card">


                        <div class="card-body">
                            <h5 class="card-title" style="opacity:0">Paiement</h5>

                            <div class="activity">


                                <script src="https://cdn.cinetpay.com/seamless/main.js"></script>
                                <style>
                                    .sdk {
                                        display: block;
                                        position: absolute;
                                        background-position: center;
                                        text-align: center;
                                        left: 50%;
                                        top: 50%;
                                        transform: translate(-50%, -50%);
                                    }

                                    .copyright {
                                        display: none
                                    }

                                    .text-decoration-none {
                                        display: none
                                    }
                                </style>
                                <script>
                                    function checkout() {
                                        CinetPay.setConfig({
                                            apikey: '796105011638c90b6458524.35019820',//   YOUR APIKEY
                                            site_id: '204022',//YOUR_SITE_ID
                                            notify_url: 'http://louba.poc-demo.com/cinetpayNotify',
                                            mode: 'PRODUCTION'
                                        });
                                        CinetPay.getCheckout({
                                            transaction_id: Math.floor(Math.random() * 100000000).toString(), // YOUR TRANSACTION ID
                                            amount: 10000,
                                            currency: 'GNF',
                                            channels: 'ALL',
                                            description: 'paiement',
                                            //Fournir ces variables pour le paiements par carte bancaire
                                            customer_name: "{{$maDemande->prenom_asker}}",//Le nom du client
                                            customer_surname: "{{$maDemande->nom_asker}}",//Le prenom du client
                                            customer_email: "{{$maDemande->email_asker}}",//l'email du client
                                            customer_phone_number: "088767611",//l'email du client
                                            customer_address: "BP 0000",//addresse du client
                                            customer_city: "Conakry",// La ville du client
                                            customer_country: "GN",// le code ISO du pays
                                            customer_state: "GN",// le code ISO l'état
                                            customer_zip_code: "" // code postal

                                        });
                                        CinetPay.waitResponse(function (data) {
                                            if (data.status == "REFUSED") {
                                                if (alert("Votre paiement a échoué")) {
                                                    window.location.reload();
                                                }
                                            } else if (data.status == "ACCEPTED") {
                                                if (alert("Votre paiement a été effectué avec succès")) {
                                                    window.location.reload();
                                                }
                                            }
                                        });
                                        CinetPay.onError(function (data) {
                                            console.log(data);
                                        });
                                    }
                                </script>
                                <div class="sdk">
                                    <button onclick="checkout()">Paiement mobile</button>
                                </div>


                                <!-- Le conteneur des boutons PayPal -->
                                <div style="display:none" id="paypal-boutons"></div>

                                <!-- 1. Importation de la SDK JavaScript PayPal -->
                                <script
                                    src="https://www.paypal.com/sdk/js?client-id=AbKxXLKd7gfuvdmVvuijDzhWr-mId8zuuQkJLud563sI3GEaznL2dcC9KJNcqUIZobkJf8yu1DpXFTCH"></script>
                                <script>
                                    // 2. Afficher le bouton PayPal
                                    paypal.Buttons({

                                        // 3. Configurer la transaction
                                        createOrder: function (data, actions) {

                                            // Les produits à payer avec leurs details
                                            var produits = [
                                                {
                                                    name: "Document 1",
                                                    description: "Description du produit 1",
                                                    quantity: 1,
                                                    unit_amount: {value: 9.9, currency_code: "USD"}
                                                },
                                                {
                                                    name: "Document 2",
                                                    description: "Description du produit 2",
                                                    quantity: 1,
                                                    unit_amount: {value: 8.0, currency_code: "USD"}
                                                }
                                            ];

                                            // Le total des produits
                                            var total_amount = produits.reduce(function (total, product) {
                                                return total + product.unit_amount.value * product.quantity;
                                            }, 0);

                                            // La transaction
                                            return actions.order.create({
                                                purchase_units: [{
                                                    items: produits,
                                                    amount: {
                                                        value: total_amount,
                                                        currency_code: "USD",
                                                        breakdown: {
                                                            item_total: {value: total_amount, currency_code: "USD"}
                                                        }
                                                    }
                                                }]
                                            });
                                        },

                                        // 4. Capturer la transaction après l'approbation de l'utilisateur
                                        onApprove: function (data, actions) {
                                            return actions.order.capture().then(function (details) {

                                                // Afficher Les details de la transaction dans la console
                                                console.log(details);

                                                // On affiche un message de succès
                                                alert(details.payer.name.given_name + ' ' + details.payer.name.surname + ', votre transaction est effectuée. Vous allez recevoir une notification très bientôt lorsque nous validons votre paiement.');

                                            });
                                        },

                                        // 5. Annuler la transaction
                                        onCancel: function (data) {
                                            alert("Transaction annulée !");
                                        }

                                    }).render("#paypal-boutons");

                                </script>

                                <style>
                                    .paypal-powered-by > .paypal-button-text, .paypal-powered-by > .paypal-logo {
                                        display: none;
                                        vertical-align: middle;
                                        height: 16px;
                                        line-height: 16px;
                                        font-size: 11px;
                                    }
                                </style>


                            </div>

                        </div>
                    </div><!-- End Recent Activity -->


                </div><!-- End Right side columns -->

            </div>
        </section>

    </main>

@stop
