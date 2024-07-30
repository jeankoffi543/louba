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

     @php
     @endphp
     <main id="main" class="main">
         <div class="container">
             <div class="row">


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
                    @if(!($demande->status_demande === 'REJECTED' && $demande->predemande_step == 1) && $demande->predemande_step != 2)
                     <div class="d-flex flex-row align-items-center gap-1">
                         @kcan('gestion-pre-demande')
                             <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalValider">
                                 Valider</button>

                             <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalRejeter">
                                 Rejeter</button>
                         @endkcan

                         @kcan('possibilite-d-envoyer-mail')
                             <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#envoyerMail">
                                 Enoyer mail
                             </button>
                         @endkcan

                         @kcan('possibilite-d-envoyer-sms')
                             <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#envoyerSMS">
                                 Enoyer SMS
                             </button>
                         @endkcan
                     </div>
                    @endif

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
                                     Numéro du reçu
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->numero_recu ?? '-' }}
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
                                     Type
                                 </div>
                                 <div class="col-9">
                                     {{ $demande->type_request ?? '-' }}
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
                                                    <a href="{{ asset($document_url) }}" target="_blank">Document
                                                        {{ $j + 1 }}</a>
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
                        </div>
                        
                     </div>
                 </div>


                 <form method="POST" action="{{ route('demande.manage') }}">
                     @csrf

                     <div class="modal fade" id="modalValider" tabindex="-1">
                         <div class="modal-dialog modal-dialog-scrollable">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title">Valider la pré-demande</h5>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal"
                                         aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">

                                     <input name="demande_id" type="hidden" value="{{ $demande->id }}">
                                     <input name="request_type" type="hidden" value="gestion-pre-demande-valider">

                                     <div class="row mb-3 g-2">
                                         <div class="col-12 col-lg-3 text-wrap gap-2">
                                             <label for="#commentaire">Laisser un commentaire </label>
                                         </div>
                                         <div class="col-12 col-lg-9 text-wrap gap-2">
                                             <textarea id="commentaire" type="text" class="form-control" name="commentaire"> </textarea>
                                         </div>
                                     </div>

                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary"
                                         data-bs-dismiss="modal">Annuler</button>
                                     <button type="submit" class="btn btn-primary">Valider</button>
                                 </div>




                             </div>
                         </div>
                     </div>
                 </form>


                 <form method="POST" action="{{ route('demande.manage') }}">
                     @csrf

                     <div class="modal fade" id="modalRejeter" tabindex="-1">
                         <div class="modal-dialog modal-dialog-scrollable">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title">Rejeter la pré-demande</h5>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal"
                                         aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">

                                     <input name="demande_id" type="hidden" value="{{ $demande->id }}">
                                     <input name="request_type" type="hidden" value="gestion-pre-demande-rejeter">

                                     <div class="row mb-3 g-2">
                                        <div class="col-12 col-lg-3 text-wrap gap-2">
                                            <label for="#commentaire">Laisser un commentaire </label>
                                        </div>
                                        <div class="col-12 col-lg-9 text-wrap gap-2">
                                            <textarea id="commentaire" type="text" class="form-control" name="commentaire"> </textarea>
                                        </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary"
                                         data-bs-dismiss="modal">Annuler</button>
                                     <button type="submit" class="btn btn-primary">Valider</button>
                                 </div>




                             </div>
                         </div>
                     </div>
                 </form>

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
                                         <button type="button" class="btn btn-secondary"
                                             data-bs-dismiss="modal">Annuler</button>
                                         <button type="submit" class="btn btn-primary" id="envoyerMail2"
                                             disabled>Valider</button>
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
                                         <button type="button" class="btn btn-secondary"
                                             data-bs-dismiss="modal">Annuler</button>
                                         <button type="submit" class="btn btn-primary" id="envoyerMsg"
                                             disabled>Valider</button>
                                     </div>




                                 </div>
                             </div>
                         </div>
                     </form>
                 @endkcan
         </section>
         <!-- End Modal Dialog Scrollable-->

     </main><!-- End #main -->






 @stop
