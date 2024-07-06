@extends('admin.layouts.base')
@php
    use Illuminate\Support\Str;
@endphp

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Actualités</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Siteweb</a></li>
                    <li class="breadcrumb-item active">Actualités</li>
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

                            <a href="{{ route('actuality.create') }}" class="btn btn-primary">
                                ajouter une actualité
                            </a>

                            <h5 class="card-title">Actualités <span>|{{ $actualitys->count() }}</span></h5>

                            <table class="table table-borderless datatable" id="monTableau">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Titre</th>
                                        <th scope="col">Date de publication</th>
                                        <th scope="col">Résumé</th>
                                        <th scope="col">image</th>
                                        <th scope="col">image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($actualitys as $actuality)
                                        <tr>
                                            <th scope="row"><a href="#">#{{ $actuality->id }}</a></th>
                                            <td>{{ $actuality->titre }}</td>
                                            <td>{{ date('d-m-Y', strtotime($actuality->date_of_publish)) }}</td>
                                            <td>
                                                <p style="text-align:left" id="resume">{!! nl2br($actuality->description) !!}</p>


                                            </td>
                                            <td>

                                                <a href="{{ $actuality->image }}" data-lightbox="image">
                                                    <div style="height:100px; width:100px; ">
                                                        <img src="{{ $actuality->image }}" alt=""
                                                            style="width: 100px; height:100px" />
                                                    </div>
                                                </a>

                                            </td>
                                            <td>

                                                <a href="{{ $actuality->imagebg }}" data-lightbox="image">
                                                    <div style="height:100px; width:100px; ">
                                                        <img src="{{ $actuality->imagebg }}" alt=""
                                                            style="width: 100px; height:100px" />
                                                    </div>
                                                </a>
                                            </td>

                                            <td>

                                                <!-- Modal Dialog Scrollable -->
                                                <a class="badge bg-success btn btn-primary"
                                                    href="{{ route('actuality.edit', $actuality->id) }}">Actualiser</a>


                                                <a href="{{ route('actuality.delete', $actuality->id) }}"
                                                    onclick="return confirm('Vous êtes sur le point de supprimer cette actualité. Souhaiter vous continuer ?')">supprimer</a>
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
