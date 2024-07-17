<!DOCTYPE html>

<html>

<head>

    <title>Recu ONI</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        tr {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 2px solid black;
            padding: 10px;
            border-collapse: collapse;
            width: 200px;
        }

        div {
            text-align: center;
        }

        table {
            text-align: center;
        }

        .donnees {
            font-weight: bold
        }

        tr,
        td {
            border: none;
            text-align: center;
        }

        p {
            text-align: left;
            font-size: 0.8rem;
            line-height: 8px;
        }
    </style>

</head>


<body style="font-familly:sans-serif">
    <div>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 50px; padding: 5px;"><img
                        src="https://cdn.pixabay.com/photo/2013/07/12/19/20/arrow-154593_960_720.png" alt=""
                        style="width: 50px; height: 50px"></td>
                <td style="text-align: center;">
                    <h4>Récapitulatif de la pré-demande de passeport</h4>
                </td>
                <td style="width: 50px; padding: 5px;"><img
                        src="https://cdn.pixabay.com/photo/2013/07/12/19/20/arrow-154593_960_720.png" alt=""
                        style="width: 50px; height: 50px"></td>
            </tr>

            <tr>
                <td colspan="3">
                    <h4> État civil de la personne mineure</h4>
                </td>
            </tr>

            <tr>
                <td>
                    @if (isset($predemandeQrcode))
                        <img src="data:image/png;base64, {!! $timbreQrcode !!}">
                    @endif
                    <br>
                    <b>Numéro du réçu</b>
                    <br>
                    <br>
                    <b> {{ $maDemande->numero_recu }}</b>
                </td>

                <td style="text-align: center">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="text-align: center">PHOTOGRAPHIE</td>
                        </tr>
                        <tr>
                            <td style="text-align: center">
                                <div style="border: 8px solid black; height: 200px; width: 160px; position: relative">
                                    <h4
                                        style="position: absolute; top: 40%; left: 50%; transform: translate(-50%, -50%);">
                                        Photo à coller
                                    </h4>
                                </div>
                            </td>
                        </tr>
                    </table>

                </td>

                <td>
                    <p>
                        @if (isset($predemandeQrcode))
                            <img src="data:image/png;base64, {!! $predemandeQrcode !!}">
                        @endif
                        <br>
                        <br>
                        <br>
                        <b>Numéro de pré-demande</b>
                        <br>
                        <br>
                        <b> {{ $maDemande->code_demande }}</b>
                    </p>
                </td>
            </tr>
        </table>

        <p>
            Genre : <span style="text-transform: uppercase"> {{ $maDemande->client->genre_client }}</span>
        </p>

        <p>
            Nom (de l'acte de naissance) : <span style="text-transform: uppercase">
                {{ $maDemande->client->nom_client }}</span>
        </p>

        <p>
            Prénom(s) : <span style="text-transform: uppercase"> {{ $maDemande->client->prenom_client }}</span>
        </p>

        <p>
            Né(e) le : <span style="text-transform: uppercase; margin-right: 40px">
                {{ \Carbon\Carbon::parse($maDemande->client->date_naissance_client)->format('d-m-Y') }}
            </span>

            A: {{ $maDemande->client->adresse_client }}
        </p>

        <p>
            Taille : <span style="text-transform: uppercase; margin-right: 40px">
                {{ $maDemande->height }} CM</span>

            Couleur des yeux: {{ $maDemande->eye_color }}
        </p>
        <p>Père</p>
        <p>
            Nom : <span style="text-transform: uppercase; margin-right: 40px">
                {{ $maDemande->father_last_name }}</span>
        </p>
        <p>Prénoms : <span style="text-transform: uppercase; margin-right: 40px">
                {{ $maDemande->father_first_name }}</span></p>

        <p>Mère</p>
        <p>
            Nom : <span style="text-transform: uppercase; margin-right: 40px">
                {{ $maDemande->mother_last_name }}</span>
        </p>
        <p>Prénoms : <span style="text-transform: uppercase; margin-right: 40px">
                {{ $maDemande->mother_first_name }}</span></p>

        <p>Date du rendez-vous : <span style="text-transform: uppercase; margin-right: 40px">
                {{ \Carbon\Carbon::parse($maDemande->date_rdv_demande)->format('d-m-Y') }}
            </span></p>

        <p>Point de l'enrolement : <span style="text-transform: uppercase; margin-right: 40px">
                {{ $maDemande->point_enrolement->nom_pe }}</span></p>

        <p>Montant à payer : <span style="text-transform: uppercase; margin-right: 40px">
                {{ $maDemande->product->prix }} GNF</span></p>
        <br>
        <p>
            Je certifie l'exactitude de ces déclarations.
        </p>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="text-align: left">
                    Date: {{ $date }}
                    <p><strong> Signature du demandeur en âge de signer</strong></p>
                    <p style="font-size: 0.6rem;"><strong> (signature à effectuer en mairie </strong></p>
                    <p style="font-size: 0.6rem;"><strong> à l'encre noire et sans déborder du cadre) </strong></p>
                </td>
                <td style="text-align: left">
                    <div style="width: 100%; height: 100px; border: 8px solid black">
                    </div>
                </td>
            </tr>
        </table>
        <p>
            <strong style="font-size: 0.6rem;">
                Rappel : Toute fausse déclaration est passible des peines d’emprisonnement et des amendes prévues par
                les articles 441-6 et 441-7 du code pénal. Le droit d’accès aux
                informations prévu par la loi n°78-17 du 6 janvier 1978 relative à l’informatique, aux fichiers et aux
                libertés, s’exerce auprès de la préfecture ou de la sous-préfecture de
                votre résidence
            </strong>
        </p>
    </div>
</body>

</html>