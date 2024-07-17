@extends('admin.layouts.base')


@section('content')
    <?php 
        $formType = ['passport' => 'Passport', 'cni' => 'CNI', 'birth_act' => 'Extrait de naissance'];
    ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Produit</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Produit</li>
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
                                <i class="bi bi-save2"></i> Nouveau Produit
                            </button>
                            <div class="modal fade modal-lg" id="modalDialogScrollable" tabindex="-1">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content" style="height: 90%; overflow-y: scroll">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="bi bi-save2"></i> Nouveau prdouit</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form method="POST" action="{{ route('products.store') }}"
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
                                                    <label for="inputText" class="col-sm-2 col-form-label">Nom</label>
                                                    <div class="col-sm-10">
                                                        <input name="nom" type="text" class="form-control">
                                                    </div>
                                                </div>




                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Prix</label>
                                                    <div class="col-sm-10">
                                                        <input name="prix" type="number" class="form-control">
                                                    </div>
                                                </div>


                                                <div class="row mb-3">
                                                    <label for="inputPassword" class="col-sm-2 col-form-label">Description
                                                        du produit</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="description" required="" class="form-control" style="height: 100px"></textarea>
                                                    </div>
                                                </div>


                                                <div class="row mb-3">
                                                    <label for="inputPassword"
                                                        class="col-sm-2 col-form-label">Activation</label>
                                                    <div class="col-sm-10">
                                                        <select name="activation" required="" class="form-control">
                                                            <option value="1">oui</option>
                                                            <option value="0">non</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputPassword" class="col-sm-2 col-form-label">Rendre public
                                                        la prise de rendez vous</label>
                                                    <div class="col-sm-10">


                                                        <select name="flow_enable" required="" class="form-control">
                                                            <option value="1">
                                                                oui</option>
                                                            <option value="0">
                                                                non</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputPassword" class="col-sm-2 col-form-label">Rendre public
                                                        le choix du service</label>
                                                    <div class="col-sm-10">


                                                        <select name="select_service_is_required" required=""
                                                            class="form-control">
                                                            <option value="1">
                                                                oui</option>
                                                            <option value="0">
                                                                non</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="formType" class="col-sm-2 col-form-label">Type de service</label>
                                                    <div class="col-sm-10">


                                                        <select id="formType" name="form_type" required=""
                                                            class="form-control">
                                                            <option value="passport">
                                                                Passport</option>
                                                            <option value="cni">
                                                                CNI</option>
                                                                <option value="birth_act">Extrait de naissance</option>
                                                        </select>
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







                            <h5 class="card-title">Produits <span>| {{ $produits->count() }}</span></h5>

                            <table class="table table-borderless datatable" id='monTableau'>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th></th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">description</th>
                                        <th scope="col">prix</th>
                                        <th scope="col">prise de rendez vous public</th>
                                        <th scope="col">Choix du service public</th>
                                        <th scope="col">Type du service</th>

                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($produits as $produit)
                                        <tr>
                                            <td scope="row"><a href="#">#{{ $produit->id }}</a></td>
                                            <td>
                                                <a href="{{ $produit->image }}" data-lightbox="image">
                                                    <div style="height:50px; width:50px; ">
                                                        <img src="{{ $produit->image }}" alt=""
                                                            style="width: 50px; height:50px" />
                                                    </div>
                                                </a>
                                            </td>
                                            <td>{{ $produit->nom }}</td>
                                            <td>{{ $produit->description }}</td>
                                            <td>{{ $produit->prix }}</td>
                                            <td>{{ $produit->flow_enable ? 'Oui' : 'Non' }}</td>
                                            <td>{{ $produit->select_service_is_required ? 'Oui' : 'Non' }}</td>
                                            <td>{{ isset($formType[$produit->form_type]) ? $formType[$produit->form_type] : '' }}</td>


                                            <td>
                                                <a class="badge bg-success" data-bs-toggle="modal"
                                                    data-bs-target="#modifier{{ $produit->id }}">Modifier</a> 

                                                <!-- Modal Dialog Scrollable -->

                                                <div class="modal modal-lg fade" id="modifier{{ $produit->id }}"
                                                    tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-scrollable">
                                                        <div class="modal-content" style="height: 90%; overflow-y: scroll">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Modifier Produit</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <form method="POST"
                                                                action="{{ route('products.update', $produit->id) }}"
                                                                enctype="multipart/form-data">
                                                                <input name="id" type="hidden"
                                                                    value="{{ $produit->id }}">
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
                                                                            class="col-sm-2 col-form-label">Nom</label>
                                                                        <div class="col-sm-10">
                                                                            <input name="nom" type="text"
                                                                                class="form-control"
                                                                                value="{{ $produit->nom }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <label for="inputText"
                                                                            class="col-sm-2 col-form-label">Prix</label>
                                                                        <div class="col-sm-10">
                                                                            <input name="prix" type="text"
                                                                                class="form-control"
                                                                                value="{{ $produit->prix }}">
                                                                        </div>
                                                                    </div>


                                                                    <div class="row mb-3">
                                                                        <label for="inputPassword"
                                                                            class="col-sm-2 col-form-label">Description du
                                                                            produit</label>
                                                                        <div class="col-sm-10">
                                                                            <textarea name="description" required="" class="form-control" style="height: 100px">{{ $produit->description }}</textarea>
                                                                        </div>
                                                                    </div>



                                                                    <div class="row mb-3">
                                                                        <label for="inputPassword"
                                                                            class="col-sm-2 col-form-label">Activation</label>
                                                                        <div class="col-sm-10">


                                                                            <select name="activation" required=""
                                                                                class="form-control">
                                                                                <option value="1" <?php if ($produit->is_active == 1) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                                                                    oui</option>
                                                                                <option value="0" <?php if ($produit->is_active == 0) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                                                                    non</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="inputPassword"
                                                                            class="col-sm-2 col-form-label">Rendre public
                                                                            la prise de rendez vous</label>
                                                                        <div class="col-sm-10">


                                                                            <select name="flow_enable" required=""
                                                                                class="form-control">
                                                                                <option value="1" <?php if ($produit->flow_enable == 1) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                                                                    oui</option>
                                                                                <option value="0" <?php if ($produit->flow_enable == 0) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                                                                    non</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="inputPassword"
                                                                            class="col-sm-2 col-form-label">Rendre public
                                                                            le choix du service</label>
                                                                        <div class="col-sm-10">


                                                                            <select name="select_service_is_required"
                                                                                required="" class="form-control">
                                                                                <option value="1" <?php if ($produit->select_service_is_required == 1) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                                                                    oui</option>
                                                                                <option value="0" <?php if ($produit->select_service_is_required == 0) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                                                                    non</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <label for="formType" class="col-sm-2 col-form-label">Type de service</label>
                                                                        <div class="col-sm-10">
                    
                    
                                                                            <select id="formType" name="form_type" required=""
                                                                                class="form-control">
                                                                                <option value="passport"  <?php if ($produit->form_type === "passport") {
                                                                                    echo 'selected';
                                                                                } ?>>
                                                                                    Passport</option>
                                                                                <option value="cni"  <?php if ($produit->form_type === "cni") {
                                                                                    echo 'selected';
                                                                                } ?>>
                                                                                    CNI</option>
                                                                                    <option value="birth_act"  <?php if ($produit->form_type === "birth_act") {
                                                                                        echo 'selected';
                                                                                    } ?>>Extrait de naissance</option>
                                                                            </select>
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
