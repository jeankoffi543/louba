@extends('admin.layouts.base')


@section('content')

    <style>
        .modal {
            --bs-modal-zindex: 1055;
            --bs-modal-width: 90%;
            --bs-modal-padding: 1rem;
            --bs-modal-margin: 0.5rem;
            --bs-modal-color: ;
            --bs-modal-bg: #fff;
            --bs-modal-border-color: var(--bs-border-color-translucent);
            --bs-modal-border-width: 1px;
            --bs-modal-border-radius: 0.5rem;
            --bs-modal-box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            --bs-modal-inner-border-radius: calc(0.5rem - 1px);
            --bs-modal-header-padding-x: 1rem;
            --bs-modal-header-padding-y: 1rem;
            --bs-modal-header-padding: 1rem 1rem;
            --bs-modal-header-border-color: var(--bs-border-color);
            --bs-modal-header-border-width: 1px;
            --bs-modal-title-line-height: 1.5;
            --bs-modal-footer-gap: 0.5rem;
            --bs-modal-footer-bg: ;
            --bs-modal-footer-border-color: var(--bs-border-color);
            --bs-modal-footer-border-width: 1px;
        }
    </style>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Sliders</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Siteweb</a></li>
                    <li class="breadcrumb-item active">Sliders</li>
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

                        <div class="card-body p-5">

                            <a href="{{ route('slider.create') }}" type="button" class="btn btn-primary">
                                Ajouter slider
                            </a>




                            <h5 class="card-title">Sliders <span>|{{ $sliders->count() }}</span></h5>

                            <table class="table table-borderless datatable" id="monTableau">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Titre</th>
                                        <th scope="col">Résumé</th>
                                        <th scope="col">image</th>
                                        <th scope="col">arriere plan</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($sliders as $slider)
                                        <tr>
                                            <th scope="row"><a href="#">#{{ $slider->id }}</a></th>
                                            <td>{{ $slider->titre }}</td>
                                            <td>{{ mb_strimwidth($slider->paragraphe1, 0, 50) }}...</td>
                                            <td>

                                                <a href="{{ $slider->image }}" data-lightbox="image">
                                                    <div style="height:50px; width:50px; ">
                                                        <img src="{{ $slider->image }}" alt=""
                                                            style="width: 50px; height:50px" />
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ $slider->image_bg }}" data-lightbox="image">
                                                    <div style="height:50px; width:50px; ">
                                                        <img src="{{ $slider->image_bg }}" alt=""
                                                            style="width: 50px; height:50px" />
                                                    </div>
                                                </a>
                                            </td>

                                            <td>

                                                <!-- Modal Dialog Scrollable -->
                                                <a class="badge bg-success btn btn-primary"
                                                    href="{{ route('slider.edit', $slider->id) }}">Actualiser</a>
                                                <br>
                                                <a href="{{ route('slider.delete', $slider->id) }}"
                                                    onclick="return confirm('Vous êtes sur le point de supprimer ce slide. Souhaitez vous continuer ?')">supprimer</a>
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
