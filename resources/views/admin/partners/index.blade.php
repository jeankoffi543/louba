@extends('admin.layouts.base')


@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>partner</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">partner</li>
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
                                <i class="bi bi-save2"></i> Nouveau partenaire
                            </button>
                            <div class="modal modal-lg fade" id="modalDialogScrollable" tabindex="-1">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="bi bi-save2"></i> Ajouter un partenaire</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form method="POST" action="{{ route('partners.store') }}"
                                            enctype="multipart/form-data" id="form">
                                            @csrf
                                            @method('POST')
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Nom</label>
                                                    <div class="col-sm-10">
                                                        <input name="name" type="text" class="form-control">
                                                    </div>
                                                </div>


                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Logo</label>
                                                    <div class="col-sm-10">
                                                        <input name="logo" type="file" class="form-control">
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







                            <h5 class="card-title">partenaires <span>| {{ $partners->count() }}</span></h5>

                            <table class="table table-borderless datatable" id='monTableau'>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th></th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($partners as $partner)
                                        <tr>
                                            <td scope="row"><a href="#">#{{ $partner->id }}</a></td>

                                            <td>
                                                <a href="{{ $partner->path }}" data-lightbox="image">
                                                    <div style="height:50px; width:50px; ">
                                                        <img src="{{ $partner->path }}" alt=""
                                                            style="width: 50px; height:50px" />
                                                    </div>
                                                </a>


                                            </td>
                                            <td>{{ $partner->name }}</td>


                                            <td>

                                                <a class="badge bg-success" data-bs-toggle="modal"
                                                    data-bs-target="#modifier{{ $partner->id }}">Modifier</a>

                                                <!-- Modal Dialog Scrollable -->

                                                <div class="modal fade" id="modifier{{ $partner->id }}" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Modifier partenaire</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <form method="POST"
                                                                action="{{ route('partners.update', $partner->id) }}"
                                                                enctype="multipart/form-data">
                                                                <input name="id" type="hidden"
                                                                    value="{{ $partner->id }}">
                                                                @method('PUT')
                                                                @csrf



                                                                <div class="modal-body">

                                                                    <div class="row mb-3">
                                                                        <label for="inputText"
                                                                            class="col-sm-2 col-form-label">Nom</label>
                                                                        <div class="col-sm-10">
                                                                            <input name="name" type="text"
                                                                                class="form-control"
                                                                                value="{{ $partner->name }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <label for="inputText"
                                                                            class="col-sm-2 col-form-label">Logo</label>
                                                                        <div class="col-sm-10">
                                                                            <input name="logo" type="file"
                                                                                class="form-control">
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
