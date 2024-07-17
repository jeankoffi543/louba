@extends('admin.layouts.base')


@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Role</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Role</li>
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
                                <i class="bi bi-save2"></i> Creer Role
                            </button>
                            <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="bi bi-save2"></i> Creer role</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form method="POST" action="{{ route('roles.store') }}">
                                            @csrf
                                            @method('POST')

                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Nom</label>
                                                    <div class="col-sm-10">
                                                        <input name="nom_role" type="text" class="form-control">
                                                    </div>
                                                </div>


                                                <div class="row mb-3">
                                                    <label for="inputText"
                                                        class="col-sm-2 col-form-label">Description</label>
                                                    <div class="col-sm-10">
                                                        <input name="description_role" type="text" class="form-control">
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





                            <h5 class="card-title">roles <span>| {{ $roles->count() }}</span></h5>

                            <table class="table table-borderless datatable" id="monTableau">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Permissions</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($roles as $role)
                                        <tr>
                                            <th style="width: 10%;"><a href="#">{{ $role->id }}</a></th>
                                            <td style="width: 10%;">{{ $role->nom_role }}</td>
                                            <td style="width:70%%;">{{ $role->description_role }}</td>

                                            <td style="width:10%;">

                                                <!-- Modal Dialog Scrollable -->
                                                <a class="badge bg-success" data-bs-toggle="modal"
                                                    data-bs-target="#modalDialogScrollable{{ $role->id }}">Modifier</a>
                                                <div class="modal fade" id="modalDialogScrollable{{ $role->id }}"
                                                    tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Creer role</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <form method="POST"
                                                                action="{{ route('roles.update', $role->id) }}">
                                                                <input name="id_role" type="hidden"
                                                                    value="{{ $role->id }}">
                                                                @method('PUT')
                                                                @csrf



                                                                <div class="modal-body">

                                                                    <div class="row mb-3">
                                                                        <label for="inputText"
                                                                            class="col-sm-2 col-form-label">Nom</label>
                                                                        <div class="col-sm-10">
                                                                            <input name="nom_role" type="text"
                                                                                class="form-control"
                                                                                value="{{ $role->nom_role }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <label for="inputText"
                                                                            class="col-sm-2 col-form-label">Description</label>
                                                                        <div class="col-sm-10">
                                                                            <input name="description_role" type="text"
                                                                                class="form-control"
                                                                                value="{{ $role->description_role }}">
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
