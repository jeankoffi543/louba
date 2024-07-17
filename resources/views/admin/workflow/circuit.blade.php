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
         </div>
         <!-- End Page Title -->

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
                                                 <a href="{{ route('circuit.add', $circuit['id']) }}"
                                                     class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>

                                                 <a href="{{ route('circuit.delete', $circuit['id']) }}"
                                                     class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                             </td>
                                         </tr>


                                     @endforeach

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
