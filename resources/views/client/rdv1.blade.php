@php
    use App\Http\Controllers\ProduitController;
    $produits = ProduitController::get();
@endphp

@extends('client.layout')


@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1 style="color:#1e4825">Demande</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
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


                        </div>

                    </div>
                </div><!-- End Recent Sales -->


            </div>
        </section>

    </main><!-- End #main -->

@stop
