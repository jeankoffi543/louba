 @extends('admin.layouts.base')


 @section('content')

     <main id="main" class="main">

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













                 <!-- Recent Sales -->
                 <div class="col-12">
                     <div class="card recent-sales overflow-auto">






                         <div class="card-body">


                             <?php
                             /*
id_point_enrolement,
id_client,
date_enregistrement_demande,
date_rdv_demande,
date_traitement_demande,
status_demande,
montant_demande,
id_type_document,
url_piece_fournie_demande,
*/
                             ?>


                             <h5 class="card-title">Traitements de Demandes <span>| {{ $demandes->count() }}</span></h5>







                             <table class="table table-borderless datatable" id="monTableau">
                                 <thead>
                                     <tr>
                                         <th scope="col">#</th>
                                         <th scope="col">Code</th>
                                         <th scope="col">Service</th>
                                         <th scope="col">Produit</th>
                                         <th scope="col">Client</th>
                                         <th scope="col">Date de rendez-vous</th>
                                         <th scope="col">Point d'enrolement</th>
                                         <th scope="col">Status</th>
                                         <th scope="col">Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>


                                     @foreach ($demandes as $demande)
                                         @php
                                             /* if( $demande->status_demande == -2 )continue; */
                                         @endphp
                                         <tr>
                                             {{-- <th scope="row"><a href="#" data-bs-toggle="modal"
                                                     data-bs-target="#modalDialogScrollable{{ $demande->id_client }}">#{{ $demande->code_demande }}#</a>

                                                 <div class="modal fade" id="modalDialogScrollable{{ $demande->id_client }}"
                                                     tabindex="-1">
                                                     <div class="modal-dialog modal-dialog-scrollable">
                                                         <div class="modal-content">
                                                             <div class="modal-header">
                                                                 <h5 class="modal-title"><i class="bi bi-save2"></i>
                                                                     Informations demandes</h5>
                                                                 <button type="button" class="btn-close"
                                                                     data-bs-dismiss="modal" aria-label="Close"></button>
                                                             </div>

                                                             @csrf

                                                             <div class="modal-body">



                                                                 <div class="row mb-3" style="text-align:center">


                                                                     <div class="row mb-3">
                                                                         <div>
                                                                             Nom: {{ $demande->nom_asker }}
                                                                             {{ $demande->prenom_asker }}
                                                                         </div>
                                                                     </div>


                                                                     <div class="row mb-3">
                                                                         <div>
                                                                             Date de naissance:
                                                                             {{ $demande->date_naissance_asker }}
                                                                         </div>
                                                                     </div>


                                                                     <div class="row mb-3">
                                                                         <div>
                                                                             Telephone: {{ $demande->telephone_asker }}
                                                                         </div>
                                                                     </div>



                                                                     <div class="row mb-3">
                                                                         <div>
                                                                             Adresse: {{ $demande->adresse_asker }}
                                                                         </div>
                                                                     </div>



                                                                     <div class="row mb-3">
                                                                         <div class="col-sm-10">
                                                                             <a href='/uploads/{{ $demande->document1_demande }}'
                                                                                 target="_blank" style="color:green"> >>Voir
                                                                                 Document Fourni<< </a>
                                                                         </div>
                                                                     </div>


                                                                     <div class="col-sm-10">
                                                                         <img
                                                                             src="/uploads/{{ $demande->document2_demande }}">
                                                                     </div>
                                                                 </div>



                                                             </div>
                                                             <div class="modal-footer">
                                                                 <button type="button" class="btn btn-secondary"
                                                                     data-bs-dismiss="modal">Fermer</button>
                                                             </div>



                                                         </div>
                                                     </div>
                                                 </div><!-- End Modal Dialog Scrollable-->

                                             </th> --}}

                                             <td>{{ $demande->id }}</td>
                                             <td>{{ $demande->code_demande }}</td>
                                             <td>{{ $demande->service->name }}</td>
                                             <td>{{ $demande->product->nom }}</td>
                                             <td>{{ $demande->client->nom_client }} {{ $demande->client->prenom_client }}
                                             </td>
                                             <td>{{ $demande->date_rdv_demande }}</td>
                                             <td>{{ $demande->point_enrolement->nom_pe }}</td>
                                             <td> @dstatus( Nouveau )</td>
                                             <td> <a class="btn btn-primary" href="{{ route('demande.show', $demande->id) }}"> Détails</a> </td>
                                             <?php
                                             /*
                        <td>
                        @if ($demande->status_demande == 0)
                        	En-Attente
                        @elseif ( $demande->status_demande == 1 )
                        	Succes
                        @elseif ($demande->status_demande == -1)
                        	Echec
                        @elseif ($demande->status_demande == -2)
                        	Non payer
                        @else
				ERROR__{{$demande->status_demande}}
                        @endif

                        </td>
                        */
                                             ?>

                                             <td>

                                                 @if ($demande->status_demande == 0)
                                                     <!-- Modal Dialog Scrollable -->
                                                     <a class="badge bg-success" data-bs-toggle="modal"
                                                         data-bs-target="#modalDialogScrollable2{{ $demande->id_type_document }}">Traiter
                                                         Demande</a>
                                                     <div class="modal fade"
                                                         id="modalDialogScrollable2{{ $demande->id_type_document }}"
                                                         tabindex="-1">
                                                         <div class="modal-dialog modal-dialog-scrollable">
                                                             <div class="modal-content">
                                                                 <div class="modal-header">
                                                                     <h5 class="modal-title">Traiter demande</h5>
                                                                     <button type="button" class="btn-close"
                                                                         data-bs-dismiss="modal"
                                                                         aria-label="Close"></button>
                                                                 </div>

                                                                 <form method="POST" action="/demandeTraiter">
                                                                     <input name="id_demande" type="hidden"
                                                                         value="{{ $demande->id }}">
                                                                     @method('PUT')
                                                                     @csrf



                                                                     <div class="modal-body">


                                                                         <div class="row mb-3" style="text-align:center">
                                                                             <label class="">Status
                                                                                 Demander</label><br>
                                                                             <div class="col-sm-10">
                                                                                 <select name="status_demande"
                                                                                     class="form-select"
                                                                                     aria-label="Default select example">


                                                                                     <option value="1">Success</option>
                                                                                     <option value="-1">Echec</option>

                                                                                 </select>
                                                                             </div>
                                                                         </div>

                                                                         <br>


                                                                         <div class="row mb-3" style="text-align:center">
                                                                             <label for="inputText"
                                                                                 class="">Description
                                                                                 Raison</label><br>
                                                                             <div class="col-sm-10">
                                                                                 <input name="raison_demande" type="text"
                                                                                     class="form-control" required>
                                                                             </div>
                                                                         </div>



                                                                     </div>
                                                                     <div class="modal-footer">
                                                                         <button type="button" class="btn btn-secondary"
                                                                             data-bs-dismiss="modal">Annuler</button>
                                                                         <button type="submit"
                                                                             class="btn btn-primary">Valider</button>
                                                                     </div>

                                                                 </form>


                                                             </div>
                                                         </div>
                                                     </div><!-- End Modal Dialog Scrollable-->
                                                 @elseif($demande->status_demande == -2)
                                                     En attente de paiement
                                                 @elseif($demande->status_demande == -1)
                                                     <span style='color:red'>Echec: {{ $demande->raison_status_demande }}
                                                     </span>
                                                 @elseif($demande->status_demande == 1)
                                                     @if ($demande->production_disponible == 1)
                                                         @if ($demande->recuperation == 1)
                                                             <span style='color:green'>Document recuperer</span>
                                                         @else
                                                             <span style='color:green'>En attente de recuperation</span>
                                                         @endif
                                                     @else
                                                         <span style='color:green'>En attente de production </span>
                                                     @endif
                                                 @endif
                                             </td>
                                         </tr>
                                     @endforeach

                                 </tbody>
                             </table>

                         </div>

                     </div>
                 </div><!-- End Recent Sales -->
















             </div>
         </section>

     </main><!-- End #main -->






 @stop
