 @php
     use App\Http\Controllers\ProduitController;
     //$produits = ProduitController::get();
 @endphp


 @extends('admin.layouts.base')


 @section('content')

     <main id="main" class="main">

         <div class="pagetitle">
             <h1>Point Enrollement</h1>
             <nav>
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active">Point Enrollement</li>
                 </ol>
             </nav>
         </div><!-- End Page Title -->

         <section class="section dashboard">
             <div class="row">


                 <div class="p-2">
                     @if (Session::get('success_message'))
                         <div class="alert alert-success">{{ Session::get('success_message') }}</div>
                     @endif
                 </div>
                 <!-- Recent Sales -->
                 <div class="col-12">
                     <div class="card recent-sales overflow-auto">

                         <div class="card-body">
                             <br>
                             <!-- Modal Dialog Scrollable -->
                             <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                 data-bs-target="#modalDialogScrollable">
                                 <i class="bi bi-save2"></i> Ajouter
                             </button>


                             <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
                                 <div class="modal-dialog modal-dialog-scrollable">
                                     <div class="modal-content">
                                         <div class="modal-header">
                                             <h5 class="modal-title"><i class="bi bi-save2"></i> Creer point enrollement
                                             </h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                 aria-label="Close"></button>
                                         </div>

                                         <form method="POST" action="{{ route('pointenrollement.store') }}">
                                             @csrf



                                             <div class="modal-body">

                                                 <div class="row mb-3">
                                                     <label for="inputText" class="col-sm-2 col-form-label">Nom</label>
                                                     <div class="col-sm-10">
                                                         <input name="nom_pe" type="text" class="form-control" required>
                                                     </div>
                                                 </div>

                                                 <div class="row mb-3">
                                                     <label for="inputText" class="col-sm-2 col-form-label">capacite
                                                         maximale jour</label>
                                                     <div class="col-sm-10">
                                                         <input name="capacite_maximale_jour_pe" placeholder=""
                                                             type="number" min="0" class="form-control" required>
                                                     </div>
                                                 </div>





                                             </div>
                                             <div class="modal-footer">
                                                 <button type="button" class="btn btn-secondary"
                                                     data-bs-dismiss="modal">Annuler</button>
                                                 <button type="submit" class="btn btn-primary">Valider</button>
                                             </div>

                                         </form>


                                     </div>
                                 </div>
                             </div><!-- End Modal Dialog Scrollable-->







                             <h5 class="card-title">Points Enrollements <span> | {{ $pointenrollements->count() }}</span>
                             </h5>

                             <table class="table table-borderless datatable" id='monTableau'>
                                 <thead>
                                     <tr>
                                         <th scope="col">#</th>
                                         <th scope="col">Nom</th>
                                         <th scope="col">Capacite Maximale Jour</th>
                                         <th>Email</th>
                                         <th>Contact</th>
                                         {{-- <th scope="col">Gestions produits</th> --}}
                                         <th scope="col">Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>


                                     @foreach ($pointenrollements as $pointenrollement)
                                         <tr>
                                             <th scope="row"><a href="#">#{{ $pointenrollement->id_pe }}#</a>
                                             </th>
                                             <td>{{ $pointenrollement->nom_pe }}</td>
                                             <td>{{ $pointenrollement->capacite_maximale_jour_pe }}</td>
                                             <td>{{ $pointenrollement->email_pe }}</td>
                                             <td>{{ $pointenrollement->telephone_pe }}</td>
                                             {{-- <td>

                                                 <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                     data-bs-target="#gestionproduit{{ $pointenrollement->id_pe }}">
                                                     <i class="bi bi-save2"></i> Modifier point enrollement
                                                 </button>

                                                 <div class="modal fade"
                                                     id="gestionproduit{{ $pointenrollement->id_pe }}" tabindex="-1">
                                                     <div class="modal-dialog modal-dialog-scrollable">
                                                         <div class="modal-content">
                                                             <div class="modal-header">


                                                                 <h5 class="modal-title">Ajouter produit</h5>
                                                                 <button type="button" class="btn-close"
                                                                     data-bs-dismiss="modal" aria-label="Close"></button>
                                                             </div>



                                                             <form method="POST" action="/ajouter_produit_a_gerer">
                                                                 <input name="id_pe" type="hidden"
                                                                     value="{{ $pointenrollement->id_pe }}">
                                                                 @csrf



                                                                 <div class="modal-body">

                                                                     <div class="row mb-3">
                                                                         <label for="inputText"
                                                                             class="col-sm-2 col-form-label">Produits</label>
                                                                         <div class="col-sm-10">
                                                                             <select name="id_type_document" class="form-control">
                                                                                 @foreach ($produits as $produit)
                                                                                     <option
                                                                                         value="{{ $produit->id }}">
                                                                                         {{ $produit->nom }}
                                                                                     </option>
                                                                                 @endforeach
                                                                             </select>
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

                                                             <hr>
                                                             <div style="width:100%;text-align:center">
                                                                 @foreach ($produits_lk as $produit_lk)
                                                                     @if ($pointenrollement->id_pe == $produit_lk->id_point_enrolement)
                                                                         {{ ProduitController::getlabel($produit_lk->id_type_document) }}
                                                                         <a href="/delete_produit_a_gerer/{{ $produit_lk->id_point_enrolement_lien_type_document }}"
                                                                             onclick="return confirm('Are you sure?')">
                                                                             <i style="color:red"
                                                                                 class="bi bi-file-earmark-x-fill"></i></a><br>
                                                                     @endif
                                                                 @endforeach
                                                             </div>


                                                         </div>
                                                     </div>
                                                 </div><!-- End Modal Dialog Scrollable-->



                                             </td> --}}
                                             <td>

                                                 <a class="badge bg-info"
                                                     href="{{ route('pointenrollement.details', $pointenrollement->id_pe) }}">Consulter</a>

                                                 <!-- Modal Dialog Scrollable -->
                                                 <a class="badge bg-success" data-bs-toggle="modal"
                                                     data-bs-target="#modalDialogScrollable{{ $pointenrollement->id_pe }}">Modifier</a>
                                                 <div class="modal fade"
                                                     id="modalDialogScrollable{{ $pointenrollement->id_pe }}"
                                                     tabindex="-1">
                                                     <div class="modal-dialog modal-dialog-scrollable">
                                                         <div class="modal-content">
                                                             <div class="modal-header">
                                                                 <h5 class="modal-title">Modifier Point Enrollement</h5>
                                                                 <button type="button" class="btn-close"
                                                                     data-bs-dismiss="modal" aria-label="Close"></button>
                                                             </div>

                                                             <form method="POST"
                                                                 action="{{ route('pointenrollement.edit', $pointenrollement->id_pe) }}">
                                                                 <input name="id_pe" type="hidden"
                                                                     value="{{ $pointenrollement->id_pe }}">
                                                                 @method('PUT')
                                                                 @csrf



                                                                 <div class="modal-body">

                                                                     <div class="row mb-3">
                                                                         <label for="inputText"
                                                                             class="col-sm-2 col-form-label">Nom</label>
                                                                         <div class="col-sm-10">
                                                                             <input name="nom_pe" type="text"
                                                                                 class="form-control"
                                                                                 value="{{ $pointenrollement->nom_pe }}">
                                                                         </div>
                                                                     </div>

                                                                     <div class="row mb-3">
                                                                         <label for="inputText"
                                                                             class="col-sm-2 col-form-label">capacite</label>
                                                                         <div class="col-sm-10">
                                                                             <input name="capacite_maximale_jour_pe"
                                                                                 type="text" class="form-control"
                                                                                 value="{{ $pointenrollement->capacite_maximale_jour_pe }}">
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
