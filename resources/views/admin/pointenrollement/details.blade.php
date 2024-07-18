@extends('admin.layouts.base')


@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Point Enrollement</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Point Enrollement: <b>{{ $pointEnrolement->nom_pe }}</b></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="row">
            <div class="col-md-12" style="display:flex;justify-content:flex-end">

                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modalDialogScrollable">
                    <i class="bi bi-save2"></i> Lier un nouveau produit
                </button>
            </div>
        </div>
        <section class="section dashboard">
            <div class="row">


                <div class="p-2">
                    @if (Session::get('success_message'))
                        <div class="alert alert-success">{{ Session::get('success_message') }}</div>
                    @endif
                </div>
                <div class="p-2">
                    @if (Session::get('error_message'))
                        <div class="alert alert-warning">{{ Session::get('error_message') }}</div>
                    @endif
                </div>
                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="card-header">
                            <h5>Détails du point d'enrolement: {{ $pointEnrolement->nom_pe }}</h5>
                            </span>
                            </h5>
                            <hr>
                            <div class="card-body">

                                <div class="row-item">
                                    <div class="title">Nom</div>
                                    <div>{{ $pointEnrolement->nom_pe }}</div>
                                </div>

                                <div class="row-item">
                                    <div class="title">Email</div>
                                    <div>{{ $pointEnrolement->email_pe }}</div>
                                </div>

                                <div class="row-item">
                                    <div class="title">Contact</div>
                                    <div>{{ $pointEnrolement->telephone_pe }}</div>
                                </div>

                                <div class="row-item">
                                    <div class="title">Capacité maximale journalière</div>
                                    <div>{{ $pointEnrolement->capacite_maximale_jour_pe }}</div>
                                </div>


                                <div class="card-header">
                                    <b> Service du centre</b>
                                </div>

                                <div class="table-responsive">
                                    <table class="table  table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Services</th>
                                                <th>Retirer le service</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($pointEnrolement->services as $service)
                                                <tr>
                                                    <td><a href="#">#{{ $service->name }}</a>
                                                    </td>
                                                    <td><a
                                                            href="{{ route('pointenrollement.unlink_product', ['service_id' => $service->id, 'id_point_enrolement' => $pointEnrolement->id_pe]) }}">Délier</a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Recent Sales -->

                </div>
        </section>
    </main><!-- End #main -->


    <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-save2"></i> Lier un nouveau servcie
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('pointenrollement.link_product', $pointEnrolement->id_pe) }}">
                    @csrf
                    <div class="modal-body">

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Services</label>
                            <div class="col-sm-10">
                                <select name="service_id" id="" class="form-control">
                                    <option value=""></option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Lier le produit</button>
                    </div>

                </form>
            </div>
        </div>
    </div><!-- End Modal Dialog Scrollable-->



    <style>
        .row-item {
            display: flex;
            gap: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f2f2f2;
            margin-bottom: 1rem;
        }
    </style>

@stop
