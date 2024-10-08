 @extends('admin.layouts.base')


 @section('content')
     @php
         $colors = [
             '#f6b93b',
             '#e55039',
             '#3498db',
             '#5256ad',
             '#16a085',
             '#f39c12',
             '#e74c3c',
             '#9b59b6',
             '#434343',
             '#2ecc71',
             '#27ae60',
             '#2980b9',
         ];
     @endphp


     <main id="main" class="main">
         {{-- {{ $demande }} --}}
         <div class="container">
             <div class="row">
                 <div class="p-2">
                     @if ($isTransmitted)
                         <div class="alert alert-danger">TRANSFEREE </div>
                     @endif
                 </div>

                 <div class="col-12 col-md-3">
                     <div class="pagetitle">
                         <h1>Demande</h1>
                         <nav>
                             <ol class="breadcrumb">
                                 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                 <li class="breadcrumb-item active">Demande</li>
                             </ol>
                         </nav>
                     </div><!-- End Page Title -->
                 </div>
                 <div class="col-12 col-md-9">

                     <div class="d-flex flex-row align-items-center gap-1">
                         @if (
                             $demande->status_demande !== 'CLOSED' &&
                                 $demande->production_disponible !== 1 &&
                                 $demande->production_disponible !== true &&
                                 $demande->production_disponible !== '1' &&
                                 $demande->production_disponible !== 'true')
                             @if ($isOwner)

                                 <form action="#">
                                     <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
                                 </form>
                                 <!-- Votre contenu existant -->

                                 <!-- Modal Transparent pour verrouiller la page -->
                                 <div class="modal fade" id="lockModal" tabindex="-1" aria-labelledby="lockModalLabel"
                                     aria-hidden="true">
                                     <div class="modal-dialog modal-dialog-centered">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <h5 class="modal-title" id="lockModalLabel">Page en cours de modification
                                                 </h5>
                                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                             </div>
                                             <div class="modal-body">
                                                 Cette page est actuellement en cours de modification par un autre
                                                 administrateur : {{ optional(optional($isPageLock)->user)->nom }}. Merci de
                                                 patienter...
                                             </div>
                                         </div>
                                     </div>
                                     <!-- Pour rendre le modal transparent -->
                                     <style>
                                         .modal-backdrop.show {
                                             opacity: 0.5;
                                             /* Ajustez l'opacité pour le fond transparent */
                                         }
                                     </style>
                                 </div>

                                 @if ($workflowStatus !== 'END_OF_WORKFLOW' && $demande->status_demande !== 'SUSPENDED')
                                     @kcan('gestion-demandes')
                                         <button class="btn btn-primary" data-bs-toggle="modal"
                                             data-bs-target="#modalTransmettre">
                                             Transmettre</button>
                                     @endkcan
                                 @endif
                                 @kcan('possibilite-rejeter-dossier')
                                     <a class="btn btn-danger"
                                         href="{{ route('demande.show', ['id' => $demande->id, 'type' => 'REJECTED']) }}">
                                         Rejéter</a>
                                 @endkcan
                                 @kcan('possibilite-suspendre-dossier')
                                     @if ($demande->status_demande !== 'SUSPENDED')
                                         <a class="btn btn-warning"
                                             href="{{ route('demande.show', ['id' => $demande->id, 'type' => 'SUSPENDED']) }}">
                                             Suspendre</a>
                                     @endif
                                 @endkcan

                                 @kcan('possibilite-de-rapeller-dossier-suspendu')
                                     @if ($demande->status_demande === 'SUSPENDED')
                                         <a class="btn btn-success"
                                             href="{{ route('demande.show', ['id' => $demande->id, 'type' => 'RECALLED_SUSPENDED']) }}">
                                             Rappeller</a>
                                     @endif
                                 @endkcan


                                 @kcan('possibilite-ajouter-document')
                                     <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalAjouterDoc">
                                         Ajouter doc</button>
                                 @endkcan
                                 @kcan('possibilite-changer-date-rendez-vous')
                                     <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#changerDateRdv">
                                         Modifier date
                                         RDV </button>
                                 @endkcan

                                 @kcan('ajouter-numero-recepisse')
                                     <button class="btn btn-secondary" data-bs-toggle="modal"
                                         data-bs-target="#ajouterNumeroRecepisse">
                                         Ajouter Recepisse
                                     </button>
                                 @endkcan

                                 @kcan('ajouter-numero-document')
                                     <button class="btn btn-secondary" data-bs-toggle="modal"
                                         data-bs-target="#ajouterNumeroDocument">
                                         Ajouter numéro document
                                     </button>
                                 @endkcan

                                 @kcan('possibilite-d-envoyer-mail')
                                     <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#envoyerMail">
                                         Envoyer mail
                                     </button>
                                 @endkcan

                                 @kcan('possibilite-d-envoyer-sms')
                                     <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#envoyerSMS">
                                         Envoyer SMS
                                     </button>
                                 @endkcan

                                 @if ($workflowStatus === 'END_OF_WORKFLOW')
                                     @kcan('acquittement-delivrance-document')
                                         <button class="btn btn-success" data-bs-toggle="modal"
                                             data-bs-target="#livrerDocument">
                                             Livrer
                                         </button>
                                     @endkcan
                                 @endif
                             @endif
                         @endif
                     </div>
                 </div>
             </div>
         </div>

         <section class="section dashboard">
             <div class="row">

                 {{-- Alert --}}
                 @if (auth()->user()->id_role == 1)
                     <div class="p-2">
                         <div class="alert alert-success">Vous êtes connecté en tant que Administrateur. Seul les profils
                             acceuils peuvent effectuées des actions ici.</div>
                     </div>
                 @endif

                 <div class="p-2">
                     @if (Session::get('success_message'))
                         <div class="alert alert-success">{{ Session::get('success_message') }}</div>
                     @endif
                 </div>

                 <!-- Recent Sales -->
                 <div class="col-12">
                     <div class="card recent-sales overflow-auto"></div>
                     <div class="card-body bg-white rounded rounded-md p-2">
                         <div class="pagetitle">
                             <h1>Informations du client</h1>
                             <hr class="line bottom-3">
                         </div>

                         <div class="container">

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Type de la demande
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->type_request ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Numéro du reçu
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->numero_recu ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Nom & Prénom
                                 </div>
                                 <div class="col-9">
                                     {{ optional($demande->client)->nom_client ?? '-' }}
                                     {{ optional($demande->client)->prenom_client ?? '-' }}
                                 </div>
                             </div>


                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Genre
                                 </div>
                                 <div class="col-9">
                                     {{ optional($demande->client)->genre_client ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Nationnalité d'origine
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->nationality ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Status nationnalité
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->nationality_state ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Profession
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->profession ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Email
                                 </div>
                                 <div class="col-9">
                                     {{ optional($demande->client)->email_client ?? '-' }}
                                 </div>
                             </div>



                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     contact
                                 </div>
                                 <div class="col-9">
                                     {{ optional($demande->client)->telephone_client ?? '-' }}
                                 </div>
                             </div>



                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Adresse
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->address ?? '-' }}
                                 </div>
                             </div>


                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Date de naissance
                                 </div>
                                 <div class="col-9">
                                     {{ (new DateTime(optional($demande->client)->date_naissance_client))->format('d/m/Y') ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Lieu de naissance
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->birth_address ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Taille
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->height ?? '-' }}
                                 </div>
                             </div>


                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Teint
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->complexion ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Couleur des yeux
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->eye_color ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Couleur des cheveux
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->hair_color ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Nom & Prénom du père
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->father_last_name ?? '-' }} {{ $demande->father_first_name ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Nom & Prénom de la mère
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->mother_last_name ?? '-' }} {{ $demande->mother_first_name ?? '-' }}
                                 </div>
                             </div>


                         </div>

                         <br>
                         <br>

                         <div class="pagetitle">
                             <h1>Information de la demande</h1>
                             <hr class="line bottom-3">
                         </div>

                         <div class="container">

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Code demande
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->code_demande ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Status de la demande
                                 </div>
                                 <div class="col-9">
                                     {{ formatStatus($demande->status_demande)['label'] }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Numéro document
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->numero_document ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Recepisse
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->recepice_number ?? '-' }}
                                 </div>
                             </div>


                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Point d'enrolement
                                 </div>
                                 <div class="col-9">
                                     {{ optional($demande->point_enrolement)->nom_pe ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     capacité journalière
                                 </div>
                                 <div class="col-9">
                                     {{ optional($demande->point_enrolement)->capacite_maximale_jour_pe ?? '-' }}
                                 </div>
                             </div>


                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Date de demande
                                 </div>
                                 <div class="col-9">
                                     {{ (new DateTime($demande->created_at))->format('d/m/Y') ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Date du rendez-vous
                                 </div>
                                 <div class="col-9">
                                     {{ (new DateTime($demande->date_rdv_demande))->format('d/m/Y') ?? '-' }}
                                 </div>
                             </div>



                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Service
                                 </div>
                                 <div class="col-9">
                                     {{ optional($demande->service)->name ?? '-' }}
                                 </div>
                             </div>



                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Montant à payer
                                 </div>
                                 <div class="col-9">
                                     {{ optional($demande->service)->prix ?? '-' }} GNF
                                 </div>
                             </div>
                             @if ($circuit !== null)
                                 <div class="row align-items-center my-3">
                                     <div class="col-3 fw-bold">
                                         Circuit du traitement
                                     </div>
                                     <div class="col-9">
                                         <div class="d-flex flex-row justify-content-start align-items-center gap-1">
                                             @foreach ($circuit as $i => $habilete)
                                                 <div class="d-flex flex-column justify-content-center align-items-center">
                                                     @if (intval($demande->habilete_position) == $i)
                                                         <i class="bi bi-arrow-down"></i>
                                                     @endif
                                                     <div
                                                         class="d-flex flex-column justify-content-center align-items-center gap-1 p-2 {{ intval($demande->habilete_position) == $i ? 'border border-3' : '' }}">
                                                         @foreach ($habilete as $hab)
                                                             <div class="badge p-1"
                                                                 style="background-color: {{ $colors[array_rand($colors)] }}">
                                                                 {{ $hab->libelle }}
                                                             </div>
                                                         @endforeach

                                                     </div>
                                                 </div>

                                                 @if ($i < count($circuit) - 1)
                                                     <i class="bi bi-arrow-right"></i>
                                                 @endif
                                             @endforeach
                                         </div>

                                     </div>

                                 </div>
                             @endif
                         </div>


                         <br><br>
                         <div class="pagetitle">
                             <h1>Documents</h1>
                             <hr class="line bottom-3">
                         </div>
                         <div class="container">
                             <div class="row">
                                 <div class="col-12">
                                     <a href="{{ asset($demande->avatar_url) }}" target="_blank">Photo d'identité</a>
                                 </div>
                             </div>


                             <div class="row my-1">
                                 @if (count(explode(',', $demande->document_url)) > 0)
                                     @foreach (explode(',', $demande->document_url) as $j => $document_url)
                                         <div class="col-9">
                                             <div class="d-flex flex-row gap-2 align-items-center">

                                                 <div class="d-flex flex-column">
                                                     <a href="{{ asset($document_url) }}"
                                                         target="_blank">{{ last(explode('/', $document_url)) }}</a>
                                                 </div>
                                             </div>
                                         </div>
                                     @endforeach
                                 @endif

                             </div>
                         </div>
                         <br>

                         <br><br>
                         <div class="pagetitle">
                             <h1>Pièce jointe </h1>
                             <hr class="line bottom-3">
                         </div>
                         <div class="container">
                             <div class="row">

                                 <div class="row my-1">
                                     @if (count($demande->piece_jointes) > 0)
                                         @foreach ($demande->piece_jointes as $piece_jointe)
                                             <div class="col-3 fw-bold">
                                                 {{ $piece_jointe->libelle }} :
                                             </div>
                                             <div class="col-9">
                                                 <div class="d-flex flex-row gap-2 align-items-center">

                                                     <div class="d-flex flex-column">
                                                         @if ($piece_jointe->url !== null && count(explode(',', $piece_jointe->url)) > 0)
                                                             @foreach (explode(',', $piece_jointe->url) as $i => $url)
                                                                 <a href="{{ asset($url) }}"
                                                                     target="_blank">{{ $piece_jointe->libelle }}
                                                                     {{ $i + 1 }}</a>
                                                             @endforeach
                                                         @endif
                                                     </div>
                                                     <a
                                                         href="{{ route('piece_jointes.delete', ['id' => $piece_jointe->id]) }}"><i
                                                             class="bi bi-trash"></i></a>
                                                 </div>
                                             </div>
                                         @endforeach
                                     @endif

                                 </div>
                             </div>
                             <br>

                             <div class="pagetitle">
                                 <h1>Historiques</h1>
                                 <hr class="line bottom-3">
                                 <div class="container">
                                     <div class="row">
                                         <div class="col-12">
                                             {{-- <div class="bg-danger" style="width: 10px; height: 10px; border-radius: 50%">&nbsp;</div> --}}
                                             {{-- <div style="width: 4px; height: 100%; background-color: #0b5ed7">
                                                 &nbsp;
                                            </div> --}}

                                             @foreach ($historiques as $historique)
                                                 <div class=" d-flex gap-2">
                                                     <div class="vr" style="background-color: #0b5ed7;">
                                                     </div>
                                                     <div class="">
                                                         <p class="text-muted" style="font-size: 0.8rem;">
                                                             {{ $historique->created_at }}</p>
                                                         <p style="font-size: 0.8rem;">
                                                             <strong>{{ optional($historique->user)->nom ? optional($historique->client)->nom_client : '-' }}</strong>
                                                             : {{ $historique->description }}
                                                         </p>
                                                         <p style="font-size: 0.8rem;"> Commentaire :
                                                             @if (isset($historique->commentaires[0]))
                                                                 {{ $historique->commentaires[0]->description }}
                                                             @endif
                                                         </p>
                                                     </div>
                                                 </div>

                                                 <br>
                                             @endforeach
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
         </section>

         {{-- Modal start --}}
         @if ($circuit !== null)

             <div class="modal fade" id="modalTransmettre" tabindex="-1">
                 <div class="modal-dialog modal-dialog-scrollable">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title">Tranfert de demande</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal"
                                 aria-label="Close"></button>
                         </div>
                         <div class="modal-body">

                             <div class="row mb-3">
                                 <div class="col-12">
                                     La demande sera transféré au groupe:
                                 </div>
                                 <div class="col-12 text-wrap gap-2">
                                     @if ($workflowStatus !== 'END_OF_WORKFLOW')
                                         @foreach ($circuit[intval($demande->habilete_position) + 1] as $hab)
                                             <div class="badge p-1"
                                                 style="background-color: {{ $colors[array_rand($colors)] }}">
                                                 {{ $hab->libelle }}
                                             </div>
                                         @endforeach
                                     @endif
                                 </div>
                             </div>


                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                             <a type="submit"
                                 href="{{ route('demande.show', ['id' => $demande->id, 'type' => 'TRANSMITTED']) }}"
                                 class="btn btn-primary">Valider</a>
                         </div>




                     </div>
                 </div>
             </div>
         @endif
         <form method="POST" action="{{ route('piece_jointes.store') }}" enctype="multipart/form-data">
             @csrf

             <div class="modal fade" id="modalAjouterDoc" tabindex="-1">
                 <div class="modal-dialog modal-dialog-scrollable">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title">Ajouter une pièce jointe</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal"
                                 aria-label="Close"></button>
                         </div>
                         <div class="modal-body">

                             <input name="demande_id" type="hidden" value="{{ $demande->id }}">

                             <div class="row mb-3 g-2">
                                 <div class="col-12 col-lg-6 text-wrap gap-2">
                                     <label for="url">Selectioner des pèces jointes </label>
                                 </div>
                                 <div class="col-12 col-lg-6 text-wrap gap-2">
                                     <input id="url" type="file" class="form-control" name="url[]"
                                         accept=".jpg, .png, .pdf" multiple required>
                                 </div>

                                 <div class="col-12 col-lg-6 text-wrap gap-2">
                                     <label for="libelle">Libellé </label>
                                 </div>
                                 <div class="col-12 col-lg-6 text-wrap gap-2">
                                     <input id="libelle" type="text" name="libelle" required>
                                 </div>

                             </div>

                             <div class="row mb-3 g-2">
                                 <div class="col-12 col-lg-3 text-wrap gap-2">
                                     <label for="#commentairePj">Laisser un commentaire </label>
                                 </div>
                                 <div class="col-12 col-lg-9 text-wrap gap-2">
                                     <textarea class="form-control" id="#commentairePj" type="text" name="commentaire"> </textarea>
                                 </div>
                             </div>


                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                             <button type="submit" class="btn btn-primary">Valider</button>
                         </div>




                     </div>
                 </div>
             </div>
         </form>

         <form method="POST" action="{{ route('demande.manage') }}">
             @csrf

             <div class="modal fade" id="ajouterNumeroRecepisse" tabindex="-1">
                 <div class="modal-dialog modal-dialog-scrollable">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title">Ajouter numéro récepissé</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal"
                                 aria-label="Close"></button>
                         </div>
                         <div class="modal-body">

                             <input name="demande_id" type="hidden" value="{{ $demande->id }}">
                             <input name="request_type" type="hidden" value="ajouter-numero-recepisse">

                             <div class="row mb-3 g-2">
                                 <div class="col-12 col-lg-6 text-wrap gap-2">
                                     <label for="recepice_number">Numéro récepissé </label>
                                 </div>
                                 <div class="col-12 col-lg-6 text-wrap gap-2">
                                     <input id="recepice_number" type="text" name="recepice_number">
                                 </div>
                             </div>

                             <div class="row mb-3 g-2">
                                 <div class="col-12 col-lg-3 text-wrap gap-2">
                                     <label for="#commentaireAjouterRecepisse">Laisser un commentaire </label>
                                 </div>
                                 <div class="col-12 col-lg-9 text-wrap gap-2">
                                     <textarea class="form-control" id="#commentaireAjouterRecepisse" type="text" name="commentaire"> </textarea>
                                 </div>
                             </div>

                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                             <button type="submit" class="btn btn-primary">Valider</button>
                         </div>




                     </div>
                 </div>
             </div>
         </form>

         <form method="POST" action="{{ route('demande.manage') }}">
             @csrf

             <div class="modal fade" id="ajouterNumeroDocument" tabindex="-1">
                 <div class="modal-dialog modal-dialog-scrollable">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title">Ajouter numéro document</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal"
                                 aria-label="Close"></button>
                         </div>
                         <div class="modal-body">

                             <input name="demande_id" type="hidden" value="{{ $demande->id }}">
                             <input name="request_type" type="hidden" value="ajouter-numero-document">

                             <div class="row mb-3 g-2">
                                 <div class="col-12 col-lg-6 text-wrap gap-2">
                                     <label for="numero_document">Numéro du document </label>
                                 </div>
                                 <div class="col-12 col-lg-6 text-wrap gap-2">
                                     <input id="numero_document" type="text" name="numero_document">
                                 </div>
                             </div>

                             <div class="row mb-3 g-2">
                                 <div class="col-12 col-lg-3 text-wrap gap-2">
                                     <label for="#commentaireAjouterDoc">Laisser un commentaire </label>
                                 </div>
                                 <div class="col-12 col-lg-9 text-wrap gap-2">
                                     <textarea class="form-control" id="#commentaireAjouterDoc" type="text" name="commentaire"> </textarea>
                                 </div>
                             </div>



                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                             <button type="submit" class="btn btn-primary">Valider</button>
                         </div>




                     </div>
                 </div>
             </div>
         </form>

         @kcan('acquittement-delivrance-document')
             <form method="POST" action="{{ route('demande.manage') }}">
                 @csrf
                 <div class="modal fade" id="livrerDocument" tabindex="-1">
                     <div class="modal-dialog modal-dialog-scrollable">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title">Livrer le document</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                     aria-label="Close"></button>
                             </div>
                             <div class="modal-body">
                                 <input type="hidden" id="demande_id" name="demande_id" value="{{ $demande->id }}">
                                 <input type="hidden" id="request_type" name="request_type"
                                     value="acquittement-delivrance-document">
                                 <div class="row mb-3">
                                     Vous êtes sur le de livrer ce document.
                                     Confirmez-vous?
                                 </div>

                                 <div class="row mb-3 g-2">
                                     <div class="col-12 col-lg-3 text-wrap gap-2">
                                         <label for="#commentaireLivrerDoc">Laisser un commentaire </label>
                                     </div>
                                     <div class="col-12 col-lg-9 text-wrap gap-2">
                                         <textarea class="form-control" id="#commentairLivrerDoc" type="text" name="commentaire"> </textarea>
                                     </div>
                                 </div>


                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                 <button type="submit" class="btn btn-primary">Valider</button>
                             </div>




                         </div>
                     </div>
                 </div>
             </form>
         @endkcan

         @kcan('possibilite-d-envoyer-sms')
             <form method="POST" action="{{ route('demande.manage') }}">
                 @csrf

                 <div class="modal fade" id="envoyerSMS" tabindex="-1">
                     <div class="modal-dialog modal-dialog-scrollable">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title">Envoie de SMS</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                     aria-label="Close"></button>
                             </div>
                             <div class="modal-body">

                                 <input name="demande_id" type="hidden" value="{{ $demande->id }}">
                                 <input name="request_type" type="hidden" value="possibilite-d-envoyer-sms">

                                 <div class="row mb-3 g-2">
                                     <div class="col-12 col-lg-3 text-wrap gap-2">
                                         <label for="#smsDestinataire">Destinataire </label>
                                     </div>
                                     <div class="col-12 col-lg-9 text-wrap gap-2">
                                         <select class="form-select" name="destinataire" id="smsDestinataire"
                                             onchange="countUser(event, {{ $demande->id }},  '{{ csrf_token() }}')">
                                             <option value="1">Groupe suivant</option>
                                             <option value="-1">Groupe précédent</option>
                                             <option value="demandeur">Demandeur</option>
                                         </select>
                                         <p id="userCount">0 utilisateur(s)</p>
                                     </div>
                                 </div>

                                 <div class="row mb-3 g-2">
                                     <div class="col-12 col-lg-3 text-wrap gap-2">
                                         <label for="smsMsg">Entrer le message </label>
                                     </div>
                                     <div class="col-12 col-lg-9 text-wrap gap-2">
                                         <textarea class="form-control" id="smsMsg" name="contenu" oninput="checkSMSLength(event)"
                                             onkeypress="return validateSMS(event)"></textarea>
                                         <p id="charCount">0 caractères / 160</p>

                                     </div>
                                 </div>

                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                 <button type="submit" class="btn btn-primary" id="envoyerMsg" disabled>Valider</button>
                             </div>




                         </div>
                     </div>
                 </div>
             </form>
         @endkcan

         @kcan('possibilite-d-envoyer-mail')
             <form method="POST" action="{{ route('demande.manage') }}" enctype="multipart/form-data">
                 @csrf

                 <div class="modal fade" id="envoyerMail" tabindex="-1">
                     <div class="modal-dialog modal-dialog-scrollable">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title">Envoie de Mail</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                     aria-label="Close"></button>
                             </div>
                             <div class="modal-body">

                                 <input name="demande_id" type="hidden" value="{{ $demande->id }}">
                                 <input name="request_type" type="hidden" value="possibilite-d-envoyer-mail">

                                 <div class="row mb-3 g-2">
                                     <div class="col-12 col-lg-3 text-wrap gap-2">
                                         <label for="#mailDestinataire">Destinataire </label>
                                     </div>
                                     <div class="col-12 col-lg-9 text-wrap gap-2">
                                         <select class="form-select" name="destinataire" id="mailDestinataire"
                                             onchange="countUser(event, {{ $demande->id }},  '{{ csrf_token() }}')">
                                             <option value="1">Groupe suivant</option>
                                             <option value="-1">Groupe précédent</option>
                                             <option value="demandeur">Demandeur</option>
                                         </select>
                                         <p id="userCount2">0 utilisateur(s)</p>
                                     </div>
                                 </div>

                                 <div class="row mb-3 g-2">
                                     <div class="col-12 col-lg-3 text-wrap gap-2">
                                         <label for="smsMail">Entrer le message </label>
                                     </div>
                                     <div class="col-12 col-lg-9 text-wrap gap-2">
                                         <textarea class="form-control" id="smsMail2" name="contenu"></textarea>
                                     </div>
                                 </div>

                                 <div class="row mb-3 g-2">
                                     <div class="col-12 col-lg-3 text-wrap gap-2">
                                         <label for="#pj">Pièces jointes </label>
                                     </div>
                                     <div class="col-12 col-lg-9 text-wrap gap-2">
                                         <input type="file" multiple class="form-control" id="pj"
                                             name="pieces_jointes[]">
                                     </div>
                                 </div>

                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                 <button type="submit" class="btn btn-primary" id="envoyerMail2" disabled>Valider</button>
                             </div>

                         </div>
                     </div>
                 </div>
             </form>
         @endkcan
         <!-- End Modal Dialog Scrollable-->

         @kcan('possibilite-changer-date-rendez-vous')
             <form method="POST" action="{{ route('demande.manage') }}">
                 @csrf

                 <div class="modal fade" id="changerDateRdv" tabindex="-1">
                     <div class="modal-dialog modal-dialog-scrollable">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title">Changer la date du rendez-vous</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                     aria-label="Close"></button>
                             </div>
                             <div class="modal-body">

                                 <input name="demande_id" type="hidden" value="{{ $demande->id }}">
                                 <input name="request_type" type="hidden" value="possibilite-changer-date-rendez-vous">

                                 <div class="row mb-3 g-2">
                                     <div class="col-12 col-lg-6 text-wrap gap-2">
                                         <label for="#changer_date">Choisir une date </label>
                                     </div>
                                     <div class="col-12 col-lg-6 text-wrap gap-2">
                                         <input id="changer_date" class="form-control" type="date"
                                             name="date_rdv_demande" min="<?php echo date('Y-m-d'); ?>">
                                     </div>
                                 </div>

                                 <div class="row mb-3 g-2">
                                     <div class="col-12 col-lg-3 text-wrap gap-2">
                                         <label for="#commentaireDateRdv">Laisser un commentaire </label>
                                     </div>
                                     <div class="col-12 col-lg-9 text-wrap gap-2">
                                         <textarea class="form-control" id="commentaireDateRdv" type="text" name="commentaire"> </textarea>
                                     </div>
                                 </div>



                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                 <button type="submit" class="btn btn-primary">Valider</button>
                             </div>




                         </div>
                     </div>
                 </div>
             </form>
         @endkcan
     </main><!-- End #main -->






 @stop

 <script>
     window.addEventListener('beforeunload', (event) => {
         const csrfToken = document.getElementById('csrfToken').value
         const pageIdentifier = '{{ $demande->id }}';
         const unlockPageUrl = '{{ route('unlock-page') }}';

         async function unlockPage() {
             await fetch(unlockPageUrl, {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': csrfToken
                 },
                 body: JSON.stringify({
                     page_identifier: pageIdentifier
                 })
             });
         }
         // Effectuer une requête pour déverrouiller la page
         unlockPage();
     });

     document.addEventListener("DOMContentLoaded", function() {

         const pageIdentifier = '{{ $demande->id }}';
         const lockPageUrl = '{{ route('lock-page') }}';
         const unlockPageUrl = '{{ route('unlock-page') }}';
         const csrfToken = document.getElementById('csrfToken').value

         async function lockPage() {
             await fetch(lockPageUrl, {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': csrfToken
                 },
                 body: JSON.stringify({
                     page_identifier: pageIdentifier
                 })
             });
         }

         async function unlockPage() {
             await fetch(unlockPageUrl, {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': csrfToken
                 },
                 body: JSON.stringify({
                     page_identifier: pageIdentifier
                 })
             });
         }

         const isPageLock = @json($isPageLock);
         const authUser = @json(auth()->user());

         if (isPageLock?.page_identifier == pageIdentifier) {
             if (authUser?.id != isPageLock?.user_id) {

                 var lockModal = new bootstrap.Modal(document.getElementById('lockModal'), {
                     backdrop: 'static',
                     keyboard: false
                 });
                 lockModal.show();
             }
         } else {
             if (pageIdentifier && lockPageUrl && csrfToken) {
                 // Appeler la fonction pour verrouiller la page lors du chargement
                 lockPage();
             }

         }

         let inactivityTimeout;

         function startInactivityTimer() {
             // Définir le délai d'inactivité (en millisecondes)
             const inactivityDelay = 15 * 60 * 1000; // 15 minutes
            //  const inactivityDelay = 6000; // 6 secondes

             clearTimeout(inactivityTimeout);
             inactivityTimeout = setTimeout(() => {
                 unlockPage(); // Déverrouiller la page après le délai d'inactivité
             }, inactivityDelay);
         }

         // Écouter les événements d'activité pour réinitialiser le timer
         window.addEventListener('mousemove', startInactivityTimer);
         window.addEventListener('keydown', startInactivityTimer);
         window.addEventListener('click', startInactivityTimer);

         // Démarrer en cas d'inactivité sur une durée de  minutes
        //  startInactivityTimer();


         document.getElementById('lockModal').addEventListener('hidden.bs.modal', function (event) {
        // Rediriger vers la page précédente
        window.history.back();
    });
     });
 </script>
