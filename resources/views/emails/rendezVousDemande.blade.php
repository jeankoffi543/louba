    <p>Bonjour {{ $username }},</p>
    <p>Votre rendez-vous pour déposer votre demande de {{ $service }} est fixé<br>
        - le {{ $date }}<br>
        - au service {{ $point_enrolement }}</p>

    <p>Si vous souhaitez consulter le plan d'accès au site: <a href="{{ env('APP_URL') }}"> cliquez-ici.</a></p>
    <p>Le numéro de téléphone utilisé pour la prise de rendez-vous {{ $telephone }} vous sera demandé sur place.</p>

    <!-- Rest of your HTML content -->

    <p>
        Vous pouvez modifier la date et/ou l'heure de votre rendez-vous en cliquant ICI. Le choix d'un nouveau rendez-vous
        annulera automatiquement celui-ci. Si vous souhaitez changer de lieu pour déposer votre dossier, vous devrez
        préalablement annuler ce rendez-vous en <a href="{{ env('APP_URL') }}"> cliquant-ici.</a>.
        <br><br>

        Pour un meilleur fonctionnement du service public, nous vous remercions également de penser à annuler votre
        rendez-vous si vous ne pouvez pas venir en <a href="{{ env('APP_URL') }}"> cliquant-ici.</a>.
        <br>
        Préparez votre rendez-vous pour qu’il se déroule dans les meilleures conditions :
        - Effectuez une pré-demande en ligne sur le site de <a href="http://police-nationale.gov.gn/"> la DGPN.</a>
        - La liste des pièces justificatives à fournir est disponible sur servicedidentite.gov.gn. Munissez-vous
        impérativement des originaux des documents demandés en version papier. Tout dossier incomplet peut entraîner le
        refus d’enregistrer votre demande de titre d’identité.
        - Achetez la valeur du document via une banque autorisée ICI (pas de vente sur place)
        - Arrivez à l’heure au rendez-vous. En cas de retard ou si vous êtes trop en avance, le service est susceptible de
        refuser le dépôt de votre demande.
        <br>
        Nous vous rappelons que la présence du bénéficiaire est obligatoire. L'enfant mineur doit être accompagné d’un
        parent (détenteur de l’autorité parentale) ou d’un représentant légal.
        <br>
        Toutes les informations sur <a href="http://police-nationale.gov.gn/"> la DGPN.</a>.

    </p>

    <p>Cordialement,<br>
        Le DCPAF</p>
