@extends('admin.layouts.base')
@php
    use Illuminate\Support\Str;
@endphp

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Jour férié</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Siteweb</a></li>
                    <li class="breadcrumb-item active">Jour férié</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="p-2">
                            @if (Session::get('success_message'))
                                <div class="alert alert-success">{{ Session::get('success_message') }}</div>
                            @endif
                        </div>
                        <div class="card-body p-4">

                            <a href="{{ route('holiday.create') }}" class="btn btn-primary">
                                ajouter un jour férié
                            </a>

                            <h5 class="card-title">Jour férié <span>|{{ $holidays->count() }}</span></h5>

                            <table class="table table-borderless datatable" id="monTableau">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">date</th>
                                        <th scope="col">Raison</th>
                                        <th scope="col">Point d'enrolement</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($holidays as $holiday)
                                        <tr>
                                            <th scope="row"><a href="#">#{{ $holiday->id }}</a></th>
                                            <td>{{ date('d-m-Y', strtotime($holiday->date)) }}</td>
                                            <td>
                                                {{ $holiday->name }}
                                            </td>
                                            <td>
                                                {{ $holiday->enrolement->nom_pe }}
                                            </td>

                                            <td>

                                                <!-- Modal Dialog Scrollable -->
                                                <a class="badge bg-success btn btn-primary"
                                                    href="{{ route('holiday.edit', $holiday->id) }}">Actualiser</a>


                                                <a href="{{ route('holiday.delete', $holiday->id) }}"
                                                    onclick="return confirm('Vous êtes sur le point de supprimer ce jour férié. Souhaiter vous continuer ?')">supprimer</a>
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


    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            // Récupérer l'élément contenant le texte
            var texteElement = document.getElementById('resume');

            // Extraire les 50 premiers caractères
            var texte = texteElement.textContent.substring(0, 50);

            // Afficher les 50 premiers caractères
            texteElement.textContent = texte;
        });
    </script>

@stop
