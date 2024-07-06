@extends('admin.layouts.base')


@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Reseaux sociaux</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Réseau sociaux</li>
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

                <div class="p-2">
                    @error('nom')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>





                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">




                        <div class="card-body">







                            <br>
                            <!-- Modal Dialog Scrollable -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalDialogScrollable">
                                <i class="bi bi-save2"></i> Ajouter un réseau social
                            </button>
                            <div class="modal fade modal-lg" id="modalDialogScrollable" tabindex="-1">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="bi bi-save2"></i> Nouveau réseau social</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form method="POST" action="{{ route('socials.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="modal-body">

                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                                                    <div class="col-sm-10">
                                                        <input name="image" type="file" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Type</label>
                                                    <div class="col-sm-10">

                                                        <select name="name" id="" class="form-control">
                                                            <option value="facebook">facebook</option>
                                                            <option value="instagram">instagram</option>
                                                            <option value="twitter">twitter</option>
                                                            <option value="snapshat">snapshat</option>
                                                        </select>

                                                    </div>
                                                </div>




                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Lien</label>
                                                    <div class="col-sm-10">
                                                        <input name="link" type="text" class="form-control">
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







                            <h5 class="card-title">Reseaux sociaux <span>| {{ $socials->count() }}</span></h5>

                            <table class="table table-borderless datatable" id='monTableau'>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th></th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">lien</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($socials as $network)
                                        <tr>
                                            <td scope="row"><a href="#">#{{ $network->id }}</a></td>
                                            <td>
                                                <a href="{{ $network->image }}" data-lightbox="image">
                                                    <div style="height:50px; width:50px; ">
                                                        <img src="{{ $network->image }}" alt=""
                                                            style="width: 50px; height:50px" />
                                                    </div>
                                                </a>
                                            </td>
                                            <td>{{ $network->name }}</td>
                                            <td>{{ $network->link }}</td>


                                            <td>

                                                <a class="badge bg-success" data-bs-toggle="modal"
                                                    data-bs-target="#modifier{{ $network->id }}">Modifier</a>

                                                <!-- Modal Dialog Scrollable -->

                                                <div class="modal fade" id="modifier{{ $network->id }}" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Modifier network</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <form method="POST"
                                                                action="{{ route('socials.update', $network->id) }}">
                                                                <input name="id" type="hidden"
                                                                    value="{{ $network->id }}">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="modal-body">

                                                                    <div class="row mb-3">
                                                                        <label for="inputText"
                                                                            class="col-sm-2 col-form-label">Image</label>
                                                                        <div class="col-sm-10">
                                                                            <input name="image" type="file"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="inputText"
                                                                            class="col-sm-2 col-form-label">Type</label>
                                                                        <div class="col-sm-10">

                                                                            <select name="name" id=""
                                                                                class="form-control">
                                                                                <option @selected(old('name') == 'facebook')
                                                                                    value="facebook">facebook</option>
                                                                                <option @selected(old('name') == 'instagram')
                                                                                    value="instagram">instagram
                                                                                </option>
                                                                                <option @selected(old('name') == 'twitter')
                                                                                    value="twitter">twitter</option>
                                                                                <option @selected(old('name') == 'snapshat')
                                                                                    value="snapshat">snapshat</option>
                                                                            </select>

                                                                        </div>
                                                                    </div>




                                                                    <div class="row mb-3">
                                                                        <label for="inputText"
                                                                            class="col-sm-2 col-form-label">Lien</label>
                                                                        <div class="col-sm-10">
                                                                            <input name="link" type="text"
                                                                                value="{{ $network->link }}"
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
