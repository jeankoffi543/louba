@extends('admin.layouts.base')


@section('content')

    <style>
        @supports (-webkit-appearance: none) or (-moz-appearance: none) {
            .checkbox-wrapper-14 input[type=checkbox] {
                --active: #275EFE;
                --active-inner: #fff;
                --focus: 2px rgba(39, 94, 254, .3);
                --border: #BBC1E1;
                --border-hover: #275EFE;
                --background: #fff;
                --disabled: #F6F8FF;
                --disabled-inner: #E1E6F9;
                -webkit-appearance: none;
                -moz-appearance: none;
                height: 21px;
                outline: none;
                display: inline-block;
                vertical-align: top;
                position: relative;
                margin: 0;
                cursor: pointer;
                border: 1px solid var(--bc, var(--border));
                background: var(--b, var(--background));
                transition: background 0.3s, border-color 0.3s, box-shadow 0.2s;
            }

            .checkbox-wrapper-14 input[type=checkbox]:after {
                content: "";
                display: block;
                left: 0;
                top: 0;
                position: absolute;
                transition: transform var(--d-t, 0.3s) var(--d-t-e, ease), opacity var(--d-o, 0.2s);
            }

            .checkbox-wrapper-14 input[type=checkbox]:checked {
                --b: var(--active);
                --bc: var(--active);
                --d-o: .3s;
                --d-t: .6s;
                --d-t-e: cubic-bezier(.2, .85, .32, 1.2);
            }

            .checkbox-wrapper-14 input[type=checkbox]:disabled {
                --b: var(--disabled);
                cursor: not-allowed;
                opacity: 0.9;
            }

            .checkbox-wrapper-14 input[type=checkbox]:disabled:checked {
                --b: var(--disabled-inner);
                --bc: var(--border);
            }

            .checkbox-wrapper-14 input[type=checkbox]:disabled+label {
                cursor: not-allowed;
            }

            .checkbox-wrapper-14 input[type=checkbox]:hover:not(:checked):not(:disabled) {
                --bc: var(--border-hover);
            }

            .checkbox-wrapper-14 input[type=checkbox]:focus {
                box-shadow: 0 0 0 var(--focus);
            }

            .checkbox-wrapper-14 input[type=checkbox]:not(.switch) {
                width: 21px;
            }

            .checkbox-wrapper-14 input[type=checkbox]:not(.switch):after {
                opacity: var(--o, 0);
            }

            .checkbox-wrapper-14 input[type=checkbox]:not(.switch):checked {
                --o: 1;
            }

            .checkbox-wrapper-14 input[type=checkbox]+label {
                display: inline-block;
                vertical-align: middle;
                cursor: pointer;
                margin-left: 4px;
            }

            .checkbox-wrapper-14 input[type=checkbox]:not(.switch) {
                border-radius: 7px;
            }

            .checkbox-wrapper-14 input[type=checkbox]:not(.switch):after {
                width: 5px;
                height: 9px;
                border: 2px solid var(--active-inner);
                border-top: 0;
                border-left: 0;
                left: 7px;
                top: 4px;
                transform: rotate(var(--r, 20deg));
            }

            .checkbox-wrapper-14 input[type=checkbox]:not(.switch):checked {
                --r: 43deg;
            }

            .checkbox-wrapper-14 input[type=checkbox].switch {
                width: 38px;
                border-radius: 11px;
            }

            .checkbox-wrapper-14 input[type=checkbox].switch:after {
                left: 2px;
                top: 2px;
                border-radius: 50%;
                width: 17px;
                height: 17px;
                background: var(--ab, var(--border));
                transform: translateX(var(--x, 0));
            }

            .checkbox-wrapper-14 input[type=checkbox].switch:checked {
                --ab: var(--active-inner);
                --x: 17px;
            }

            .checkbox-wrapper-14 input[type=checkbox].switch:disabled:not(:checked):after {
                opacity: 0.6;
            }
        }

        .checkbox-wrapper-14 * {
            box-sizing: inherit;
        }

        .checkbox-wrapper-14 *:before,
        .checkbox-wrapper-14 *:after {
            box-sizing: inherit;
        }

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
            <h1>Services</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Services</li>
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

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#basicModal">
                                Ajouter service
                            </button>

                            <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Nouveau service</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form method="POST" action="{{ route('services.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">


                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Nom</label>
                                                    <div class="col-sm-10">
                                                        <input name="name" required class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Coût</label>
                                                    <div class="col-sm-10">
                                                        <input name="prix" required class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Type</label>
                                                    <div class="col-sm-10">
                                                        <select name="form_type" >
                                                            <option value="passport" selected>PASSEPORT</option>
                                                            <option value="cni">CNI</option>
                                                            <option value="birth_act">Extrait de naissance</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="inputPassword"
                                                        class="col-sm-2 col-form-label">Description</label>
                                                    <div class="col-sm-10">
                                                        <textarea name='description' required class="form-control" style="height: 100px"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="inputNumber" class="col-sm-2 col-form-label"> Image </label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="file" name="newimage1"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputNumber" class="col-sm-2 col-form-label"> Rendre le
                                                        service publique </label>
                                                    <div class="col-sm-10">
                                                        <div class="checkbox-wrapper-14">
                                                            <input id="s1-14" type="checkbox" name="is_public"
                                                                class="switch">
                                                            <label for="s1-14">rendre publique</label>
                                                        </div>



                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputNumber" class="col-sm-2 col-form-label"> Désactiver le
                                                        service </label>
                                                    <div class="col-sm-10">
                                                        <div class="checkbox-wrapper-14">
                                                            <input id="s1-14" type="checkbox" name="is_disable"
                                                                class="switch">
                                                            <label for="s1-14">Désactiver</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Fermer</button>
                                                <button type="submit" class="btn btn-primary">Valider</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>


                            <h5 class="card-title">services <span>|{{ $services->count() }}</span></h5>

                            <table class="table table-borderless datatable" id="monTableau">
                                <thead>
                                    <tr>
                                        <th scope="col">#id</th>
                                        <th></th>
                                        <th scope="col">nom </th>
                                        <th scope="col">Coût </th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Afficher sur site</th>
                                        <th scope="col">Désactiver</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($services as $service)
                                        <tr>
                                            <th scope="row"><a href="#">#{{ $service->id }}#</a></th>
                                            <td>
                                                <a href="{{ $service->image }}" data-lightbox="image">
                                                    <div style="height:50px; width:50px; ">
                                                        <img src="{{ $service->image }}" alt=""
                                                            style="width: 50px; height:50px" />
                                                    </div>
                                                </a>
                                            </td>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->prix }}</td>
                                            <td>{{ $service->form_type }}</td>
                                            <td>{{ mb_strimwidth($service->description, 0, 50) }}</td>
                                            <td>
                                                {{ $service->is_public == "1" ? 'oui' : 'non' }}
                                            </td>
                                            <td>
                                                {{ $service->is_disable == "1" ? 'oui' : 'non' }}
                                            </td>
                                          
                                            <td>

                                                <!-- Modal Dialog Scrollable -->
                                                <a class="badge bg-success btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#actualiser{{ $service->id }}">Actualiser</a>
                                                <br>
                                                <a href="{{ route('services.delete', $service->id) }}"
                                                    onclick="return confirm('Vous êtes sur le point de supprimer un service. Souhaitez vous continuer ?')">supprimer</a>
                                                <div class="modal fade" id="actualiser{{ $service->id }}"
                                                    tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Actualiser service:
                                                                    #{{ $service->name }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <form method="POST"
                                                                        action="{{ route('services.edit', $service->id) }}" enctype="multipart/form-data">
                                                                        <input name="id" type="hidden"
                                                                            value="{{ $service->id }}">
                                                                        @method('PUT')
                                                                        @csrf

                                                                        <div class="modal-body">
                                                                            <div class="row mb-3">
                                                                                <label for="inputText"
                                                                                    class="col-sm-2 col-form-label">Nom</label>
                                                                                <div class="col-sm-10">
                                                                                    <input name="name"
                                                                                        value="{{ $service->name }}"
                                                                                        class="form-control">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mb-3">
                                                                                <label for="inputText"
                                                                                    class="col-sm-2 col-form-label">Coût</label>
                                                                                <div class="col-sm-10">
                                                                                    <input name="prix"
                                                                                        value="{{ $service->prix }}"
                                                                                        class="form-control">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mb-3">
                                                                                <label for="#type"
                                                                                    class="col-sm-2 col-form-label">Type</label>
                                                                                <div class="col-sm-10">
                                                                                    <select name="form_type" id="type" >
                                                                                        <option value="passport" {{ $service->form_type == 'passport' ? 'selected' : ''}} >PASSEPORT</option>
                                                                                        <option value="cni" {{ $service->form_type == 'cni' ? 'selected' : ''}}>CNI</option>
                                                                                        <option value="birth_act" {{ $service->form_type == 'birth_act' ? 'selected' : ''}}>Extrait de naissance</option>
                                                                                    </select>
                                                                                </div>

                                                                                
                                                                            </div>


                                                                            <div class="row mb-3">
                                                                                <label for="inputPassword"
                                                                                    class="col-sm-2 col-form-label">Description</label>
                                                                                <div class="col-sm-10">
                                                                                    <textarea name='description' class="form-control" style="height: 100px">{{ $service->description }}</textarea>
                                                                                </div>
                                                                            </div>


                                                                            <div class="row mb-3">
                                                                                <label for="inputNumber"
                                                                                    class="col-sm-2 col-form-label"> Image
                                                                                </label>
                                                                                <div class="col-sm-10">
                                                                                    <input class="form-control"
                                                                                        type="file" name="image">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <label for="inputNumber"
                                                                                    class="col-sm-2 col-form-label"> Rendre
                                                                                    le
                                                                                    service publique </label>
                                                                                <div class="col-sm-10">
                                                                                    <div class="checkbox-wrapper-14">
                                                                                        <input id="s1-14"
                                                                                            type="checkbox"
                                                                                            name="is_public"
                                                                                            class="switch"
                                                                                            value="{{ $service->is_public == 1 ? 'on' : 'off' }}"
                                                                                            {{ $service->is_public == 1 ? 'checked' : '' }}>
                                                                                        <label for="s1-14">rendre
                                                                                            publique</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <label for="inputNumber"
                                                                                    class="col-sm-2 col-form-label">
                                                                                    Désactiver le
                                                                                    service
                                                                                </label>
                                                                                <div class="col-sm-10">
                                                                                    <div class="checkbox-wrapper-14">

                                                                                        <input id="s1-14"
                                                                                            type="checkbox"
                                                                                            name="is_disable"
                                                                                            class="switch"
                                                                                            value="{{ $service->is_disable == 1 ? 'on' : 'off' }}"
                                                                                            {{ $service->is_disable == 1 ? 'checked' : '' }}>



                                                                                        <label
                                                                                            for="s1-14">Désactiver</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger"
                                                                                data-bs-dismiss="modal">Annuler</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Actualiser</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>







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
