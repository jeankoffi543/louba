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
         {{ $demande }}
         <div class="pagetitle">
             <h1>Demande</h1>
             <nav>
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                     <li class="breadcrumb-item active">Demande</li>
                 </ol>
             </nav>
         </div><!-- End Page Title -->

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
                                     Nom & Prénom
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->client->nom_client ?? '-' }} {{ $demande->client->prenom_client ?? '-' }}
                                 </div>
                             </div>


                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Email
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->client->email_client ?? '-' }}
                                 </div>
                             </div>



                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     contact
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->client->telephone_client ?? '-' }}
                                 </div>
                             </div>


                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     contact
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->client->telephone_client ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Adresse
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->client->address ?? '-' }}
                                 </div>
                             </div>


                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Date de naissance
                                 </div>
                                 <div class="col-9">
                                     {{ (new DateTime($demande->client->date_naissance_client))->format('d/m/Y') ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Genre
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->client->genre_client ?? '-' }}
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
                                     Point d'enrolement
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->point_enrolement->nom_pe ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     capacité journalière
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->point_enrolement->capacite_maximale_jour_pe ?? '-' }}
                                 </div>
                             </div>


                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Date de demande
                                 </div>
                                 <div class="col-9">
                                     {{ (new DateTime($demande->created_at))->format('d/m/Y H:i') ?? '-' }}
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Date du rendez-vous
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->date_rdv_demande ?? '-' }}
                                 </div>
                             </div>



                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Service
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->service->name ?? '-' }}
                                 </div>
                             </div>


                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Produit
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->product->nom ?? '-' }}
                                 </div>
                             </div>



                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Type
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->type_request ?? '-' }}
                                 </div>
                             </div>


                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Montant à payer
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->product->prix ?? '-' }} GNF
                                 </div>
                             </div>

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

                         </div>


                         <br><br>
                         <div class="pagetitle">
                             <h1>Documents</h1>
                             <hr class="line bottom-3">
                         </div>

                         <div class="container">
                             <div class="row">
                                 <div class="col-3 fw-bold">
                                     Document 1
                                 </div>
                                 <div class="col-9">
                                     <img src="{{ $demande->avatar_url }}"
                                         alt="{{ $demande->code_demande ?? '' }}">
                                 </div>
                             </div>

                             <div class="row">


                             </div>
                         </div>

                     </div>
                 </div>
         </section>

     </main><!-- End #main -->






 @stop
