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

         <div class="pagetitle">
             <h1>Circuit</h1>
             <nav>
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active">Circuit</li>
                 </ol>
             </nav>
         </div><!-- End Page Title -->

         <section class="section dashboard">
             <div class="row">


                 <!-- Recent Sales -->
                 <div class="col-12">
                     <div class="card recent-sales overflow-auto">
                         <div class="card-body">

                             <h5 class="card-title">Gestion du circuit<span></span></h5>

                             <div id="allhab" data-allhab="{{ $allHabiletes }}"></div>

                             <table class="table table-borderless w-100" id="monTableau">
                                 <thead>
                                     <tr>
                                         <th scope="col" style="width: 5%">N°</th>
                                         <th scope="col" style="width: 15%">Service</th>
                                         <th scope="col" style="width: 70%">Circuits</th>
                                         <th scope="col">Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>

                                     @foreach ($circuits as $index => $circuit)
                                         @php
                                             $lastIndex = 0;
                                             $hab = json_encode([]);
                                             if (isset($circuit['habiletes']) && count($circuit['habiletes']) > 0) {
                                                 $lastIndex = count($circuits);
                                                 $hab = json_encode($circuit['habiletes']);
                                             }
                                         @endphp

                                         <div id="hab{{ $index }}" data-hab="{{ count($circuit['habiletes']) }}">
                                         </div>

                                         @if ($index == 0)
                                             <div id="index" data-index="{{ $lastIndex }}"> </div>
                                             <div id="habiletes" data-habiletes="{{ $hab }}"> </div>
                                             <div id="circuit_count" data-circuit_count="{{ count($circuits) }}"></div>
                                         @endif

                                         <tr>
                                             <td>{{ $circuit['id'] }}</td>
                                             <td>{{ $circuit['name'] }}</td>
                                             <td>

                                                 <div
                                                     class="d-flex flex-row justify-content-center align-items-center gap-1">
                                                     @foreach ($circuit['habiletes'] as $i => $habilete)
                                                         <div
                                                             class="d-flex flex-column justify-content-center align-items-center gap-1">
                                                             @foreach ($habilete as $hab)
                                                                 <div class="badge p-1"
                                                                     style="background-color: {{ $colors[array_rand($colors)] }}">
                                                                     {{ $hab->libelle }}
                                                                 </div>
                                                             @endforeach

                                                         </div>
                                                         @if ($i < count($circuit['habiletes']) - 1)
                                                             <i class="bi bi-arrow-right"></i>
                                                         @endif
                                                     @endforeach
                                                 </div>
                                             </td>

                                             <td>
                                                 <a href="{{ route('circuit.update', $circuit['id']) }}"
                                                     data-bs-toggle="modal" data-bs-target="#modifier{{ $index }}"
                                                     class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>

                                                 <a href="{{ route('circuit.delete', $circuit['id']) }}"
                                                     class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                             </td>
                                         </tr>



                                         <!-- Modal Dialog Scrollable -->
                                         <div class="modal modal-lg fade" id="modifier{{ $index }}" tabindex="-1">
                                             <div class="modal-dialog modal-dialog-scrollable">
                                                 <div class="modal-content" style="height: 90%; overflow-y: scroll">
                                                     <div class="modal-header">
                                                         <h5 class="modal-title">Gestion du circuit</h5>
                                                         <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                             aria-label="Close"></button>
                                                     </div>

                                                     <form method="POST"
                                                         action="{{ route('circuit.update', $circuit['id']) }}">
                                                         <input name="id" type="hidden" value="{{ $circuit['id'] }}">
                                                         @method('PUT')
                                                         @csrf


                                                         <div class="modal-body p-2">
                                                             <div class="w-100" id="circuitModal{{ $index }}">


                                                                 @foreach ($circuit['habiletes'] as $i => $habilete)
                                                                     <div class="d-flex flex-row gap-2 align-items-center">
                                                                         <select id="circuitSelect{{ $index }}{{ $i }}"
                                                                             name="circuit_select_{{ $index }}{{ $i }}[]"
                                                                             required class="form-control" multiple>
                                                                             @foreach ($habilete as $hab)
                                                                                 <option value="{{ $hab->id }}"
                                                                                     selected>
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

                                                                         <a href="#"
                                                                             id="removeCircuit{{ $index }}{{ $i }}">
                                                                             <i class="bi bi-trash fs-3"></i>
                                                                         </a>
                                                                     </div>
                                                                 @endforeach

                                                             </div>

                                                             <div
                                                                 class="d-flex flex-row align-items-center justify-content-end my-2">
                                                                 <a href="#" id="addCircuit{{ $index }}">
                                                                     <i class="bi bi-plus-circle fs-3"></i>
                                                                 </a>
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
                                         </div>
                                         <!-- End Modal Dialog Scrollable-->
                                     @endforeach

                                 </tbody>
                             </table>

                         </div>
                     </div>
                 </div>
                 <!-- End Recent Sales -->

             </div>
         </section>

     </main><!-- End #main -->


 @stop
