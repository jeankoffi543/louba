 @extends('admin.layouts.base')


 @section('content')

     <main id="main" class="main">

        @kcan('gestion-moyen-paiement')
        @endkcan

         <div class="pagetitle">
             <h1>Circuit</h1>
             <nav>
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('circuit') }}">Circuit</a></li>
                     <li class="breadcrumb-item active">Ajouter</li>
                 </ol>
             </nav>
         </div>
         <!-- End Page Title -->

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

                             <h5 class="card-title">Ajouter un circuit<span></span></h5>

                             <div id="allhab" data-allhab="{{ $allHabiletes }}"></div>

                             <table class="table table-borderless w-100" id="monTableau">
                                 <thead>
                                     <tr>
                                         <th scope="col" style="width: 15%">Circuit</th>
                                     </tr>
                                 </thead>
                                 <tbody>



                                     <tr>
                                         <td>
                                             <form method="POST" action="{{ route('circuit.update', $circuit['id']) }}">
                                                 @method('PUT')
                                                 @csrf


                                                 <div class="modal-body p-2">
                                                     <div class="w-100" id="circuitModal">


                                                         @foreach ($circuit['habiletes'] as $i => $habilete)
                                                            @if($i === 0)
                                                                <div id="hab" data-hab="{{ count($circuit['habiletes'] ?? [])}}"></div>
                                                            @endif
                                                             <div class="d-flex flex-row gap-2 align-items-center">
                                                                 <select id="circuitSelect{{ $i }}"
                                                                     name="circuit_select_{{ $i }}[]" required
                                                                     class="form-control" multiple>
                                                                     @foreach ($habilete as $hab)
                                                                         <option value="{{ $hab->id }}" selected>
                                                                             {{ $hab->libelle }}
                                                                         </option>
                                                                     @endforeach


                                                                     @foreach ($allHabiletes as $hab)
                                                                         @if (!in_array($hab['id'], array_column($habilete->toArray(), 'id')))
                                                                             <option value="{{ $hab['id'] }}">
                                                                                 {{ $hab['libelle'] }} </option>
                                                                         @endif
                                                                     @endforeach
                                                                 </select>

                                                                 <a href="#" id="removeCircuit{{ $i }}">
                                                                     <i class="bi bi-trash fs-3"></i>
                                                                 </a>
                                                             </div>
                                                         @endforeach

                                                     </div>

                                                     <div
                                                         class="d-flex flex-row align-items-center justify-content-end my-2">
                                                         <a href="#" id="addCircuit">
                                                             <i class="bi bi-plus-circle fs-3"></i>
                                                         </a>
                                                     </div>

                                                 </div>
                                                 <div class="d-flex flex-row gap-1">
                                                     <a href="{{ route('circuit') }}" class="btn btn-secondary">Annuler</a>
                                                     <button type="submit" class="btn btn-primary">Valider</button>
                                                 </div>
                                             </form>

                                         </td>
                                     </tr>

                                 </tbody>
                             </table>

                         </div>
                     </div>
                 </div>
                 <!-- End Recent Sales -->

             </div>
         </section>

     </main>
     <!-- End #main -->


 @stop
