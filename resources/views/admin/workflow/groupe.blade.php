@extends('admin.layouts.base')


@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Role</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Groupe</li>
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
                                <i class="bi bi-save2"></i> Creer un groupe
                            </button>
                            <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="bi bi-save2"></i> Creer un groupe</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form method="POST" action="{{ route('groupes.store') }}">
                                            @csrf
                                            @method('POST')

                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Nom</label>
                                                    <div class="col-sm-10">
                                                        <input name="libelle" type="text" class="form-control">
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





                            <h5 class="card-title">groupes <span>| {{ $groupes->count() }}</span></h5>

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


                                    @foreach ($groupes as $groupe)
                                        <tr>
                                            <th style="width: 10%;"><a href="#">{{ $groupe->id }}</a></th>
                                            <td style="width: 10%;">{{ $groupe->libelle }}</td>
                                            <td style="width:60%%;">
                                              
                                              {{ $groupe->description_role }}
                                              <div class="d-flex flex-row gap-1 flex-wrap">

                                                @foreach ($groupe->permissions as $permission)
                                                  <span class="badge bg-secondary">{{ $permission->libelle }}</span>
                                                @endforeach
                                              </div>
                                            </td>

                                            <td style="width:20%;">
                                              <div class="d-flex flex-row gap-1" >
                                                <!-- Modal Dialog Scrollable -->
                                                <a class="badge bg-success" data-bs-toggle="modal"
                                                    data-bs-target="#modalDialogScrollable{{ $groupe->id }}">Modifier</a>
                                                <div class="modal fade" id="modalDialogScrollable{{ $groupe->id }}"
                                                    tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Mise à jour du groupe</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <form method="POST"
                                                                action="{{ route('groupes.update', $groupe->id) }}">
                                                                <input name="id_role" type="hidden"
                                                                    value="{{ $groupe->id }}">
                                                                @method('PUT')
                                                                @csrf



                                                                <div class="modal-body">

                                                                    <div class="row mb-3">
                                                                        <label for="inputText"
                                                                            class="col-sm-2 col-form-label">Libelle</label>
                                                                        <div class="col-sm-10">
                                                                            <input name="libelle" type="text"
                                                                                class="form-control"
                                                                                value="{{ $groupe->libelle }}">
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

                                                <a class="badge bg-secondary" href="{{ route('permissions', $groupe->id) }}">Permissions</a>
                                                <a class="badge bg-danger" href="{{ route('groupes.destroy', $groupe->id) }}">Supprimer</a>
                                              </div>
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
