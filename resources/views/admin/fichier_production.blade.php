@extends('admin.layouts.base')


@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Production Documents (passport, carte d'identite ...)</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Production Documents</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <div class="p-2">
                    @if (Session::get('error_message'))
                        <div class="alert alert-danger">{{ Session::get('error_message') }}</div>
                        @elseif (Session::get('success_message'))
                        <div class="alert alert-success">{{ Session::get('success_message') }}</div>
                    @endif
                </div>





                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">




                        <div class="card-body">


                            <h5 class="card-title">Production Documents <span>| {{ $importations->count() }}</span></h5>
                            <div class="mb-3 d-flex flex-column align-items-start justify-content-center p-3 alert alert-warning">

                                <a href="gabari-poduction-document.csv">Telecharger gabarit fichier</a>

                                <form method="POST" action="/productionDocument" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3 d-flex flex-column justify-content-start">
                                        <label for="inputNumber">Charger le fichier
                                            production
                                            de document </label>
                                        <div class="d-flex flex-row gap-2 align-items-center">
                                            <input class="form-control" type="file" id="formFile" name="document1">
                                            <button type="submit" class="btn btn-primary">Valider</button>
                                        </div>
                                        <div></div>
                                    </div>

                                </form>
                            </div>

                            @include('flash::message')

                            <table class="table table-borderless datatable" id="monTableau">
                                <thead>
                                    <tr>
                                        <th scope="col"> Importation</th>
                                        <th scope="col"> infos importation</th>
                                        <th scope="col"> Consulter fichier</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    @foreach ($importations as $importation)
                                        <tr>
                                            <th scope="row"><a href="#">{{ $importation->date_register }}</a></th>
                                            <td>{{ $importation->message }}</td>
                                            <td><a href="/uploads/{{ $importation->fichier }}">Consulter fichier</a></td>
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
