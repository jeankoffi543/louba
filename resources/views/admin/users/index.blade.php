@extends('admin.layouts.base')


@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Utlisateurs</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Utlisateurs</li>
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
                    @if (Session::get('error_message'))
                        <div class="alert alert-danger">{{ Session::get('error_message') }}</div>
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
                                <i class="bi bi-save2"></i> Creer utilisateur
                            </button>
                            <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="bi bi-save2"></i> Creer utilisateur</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form method="POST" action="{{ route('user.add') }}">
                                            @csrf
                                            @method('POST')
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Nom</label>
                                                    <div class="col-sm-10">
                                                        <input name="nom" type="text" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input name="email" type="text" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Telephone</label>
                                                    <div class="col-sm-10">
                                                        <input name="telephone" type="text" class="form-control">
                                                    </div>
                                                </div>


                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Profile</label>
                                                    <div class="col-sm-10">
                                                        <select name="id_role" class="form-select"
                                                            aria-label="Default select example">

                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->id }}">{{ $role->libelle }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Points Enrolements</label>
                                                    <div class="col-sm-10">
                                                        <select name="id_point_enrolement" class="form-select"
                                                            aria-label="Default select example">

                                                            @foreach ($pointsEnrolements as $pointsEnrolement)
                                                                <option value="{{ $pointsEnrolement->id_pe }}">
                                                                    {{ $pointsEnrolement->nom_pe }}</option>
                                                            @endforeach
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





                            <h5 class="card-title">Utilisateurs <span></span></h5>

                            <table class="table table-borderless datatable" id="monTableau">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Telphone</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Points Enrolement</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($users as $user)
                                        <tr <?php if ($user->actif == 0) {
                                            echo "style='background:#fb9898'";
                                        } ?>>
                                            <th scope="row"><a href="#">#{{ $user->id }}</a></th>
                                            <td>{{ $user->nom }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->telephone }}</td>
                                            <td>{{ $user->id_role === 1 ? 'Supperadmin' : $user->habilete->libelle }}</td>
                                            <td>{{ $user->enrollPoint->nom_pe }}</td>

                                            <td>

                                                @if ($user->id_role != 1)
                                                <!-- Modal Dialog Scrollable -->
                                                <a class="badge bg-success" data-bs-toggle="modal"
                                                    data-bs-target="#modalDialogScrollable{{ $user->id }}">Modifier</a>


                                                    <form method="POST" action="{{ route('user.active', $user->id) }}"
                                                        id="form{{ $user->id }}">
                                                        @method('PUT')
                                                        @csrf
                                                        <input name="id" id="id{{ $user->id }}" type="hidden"
                                                            value="{{ $user->id }}">
                                                        <input name="actif" id="actif{{ $user->id }}"
                                                            type="hidden">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="flexSwitchCheckChecked{{ $user->id }}"
                                                                <?php if ($user->actif == 1) {
                                                                    echo 'checked=""';
                                                                } ?>
                                                                onclick="activator{{ $user->id }}()">

                                                        </div>
                                                    </form>
                                                @endif

                                                <script>
                                                    function activator{{ $user->id }}() {
                                                        var checkBox = document.getElementById("flexSwitchCheckChecked{{ $user->id }}");

                                                        if (checkBox.checked == true) {
                                                            document.getElementById("actif{{ $user->id }}").value = 1;
                                                            document.getElementById("form{{ $user->id }}").submit();
                                                        } else {
                                                            document.getElementById("actif{{ $user->id }}").value = 0;
                                                            document.getElementById("form{{ $user->id }}").submit();
                                                        }
                                                    }
                                                </script>







                                                <?php
                                                /*
   
               <div class="modal fade" id="actif{{$user->id}}" tabindex="-1">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Activer / desactiver utilisateur</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    @if( $user->actif == 0)
                    	@php
                    		$actif = 1;
                    	@endphp
                    @endif
                    
                    @if( $user->actif == 1)
                    	@php
                    		$actif = 0;
                    	@endphp
                    @endif
                    <form method="POST" action="/actifUser" >
                    <input name="id" type="hidden" value="{{$user->id}}" >
                    <input name="actif" type="hidden" value="{{$actif}}" >
                    @method('PUT')
                    @csrf
                    

                    
                    <div class="modal-body">
                    

		        
                    
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                      <button type="submit" class="btn btn-primary">Changer statut</button>
                    </div>
                    
                    </form>
                    
                    
                  </div>
                </div>
              </div><!-- End Modal Dialog Scrollable-->
   
   
   
   */
                                                ?>

















                                                <div class="modal fade" id="modalDialogScrollable{{ $user->id }}"
                                                    tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Modifier utilisateur</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <form method="POST"
                                                                action="{{ route('user.edit', $user->id) }}">
                                                                <input name="id" type="hidden"
                                                                    value="{{ $user->id }}">
                                                                @method('PUT')
                                                                @csrf



                                                                <div class="modal-body">

                                                                    <div class="row mb-3">
                                                                        <label for="inputText"
                                                                            class="col-sm-2 col-form-label">Nom</label>
                                                                        <div class="col-sm-10">
                                                                            <input name="nom" type="text"
                                                                                class="form-control"
                                                                                value="{{ $user->nom }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <label for="inputText"
                                                                            class="col-sm-2 col-form-label">Email</label>
                                                                        <div class="col-sm-10">
                                                                            <input name="email" type="text"
                                                                                class="form-control"
                                                                                value="{{ $user->email }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <label for="inputText"
                                                                            class="col-sm-2 col-form-label">Telephone</label>
                                                                        <div class="col-sm-10">
                                                                            <input name="telephone" type="text"
                                                                                class="form-control"
                                                                                value="{{ $user->telephone }}">
                                                                        </div>
                                                                    </div>


                                                                    <div class="row mb-3">
                                                                        <label
                                                                            class="col-sm-2 col-form-label">Profile</label>
                                                                        <div class="col-sm-10">
                                                                            <select name="id_role" class="form-select"
                                                                                aria-label="Default select example">

                                                                                @foreach ($roles as $role)
                                                                                    <option
                                                                                        {{ $user->habilete_id == $role->id ? 'selected' : '' }}
                                                                                        value="{{ $role->id }}">
                                                                                        {{ $role->libelle }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>


                                                                    <div class="row mb-3">
                                                                        <label class="col-sm-2 col-form-label">Points
                                                                            Enrolements</label>
                                                                        <div class="col-sm-10">
                                                                            <select name="id_point_enrolement"
                                                                                class="form-select"
                                                                                aria-label="Default select example">

                                                                                @foreach ($pointsEnrolements as $pointsEnrolement)
                                                                                    @if ($user->id_point_enrolement == $pointsEnrolement->id_pe)
                                                                                        @php
                                                                                            $selected2 = 'selected';
                                                                                        @endphp
                                                                                    @else
                                                                                        @php
                                                                                            $selected2 = '';
                                                                                        @endphp
                                                                                    @endif

                                                                                    <option selected="{{ $selected2 }}"
                                                                                        value="{{ $pointsEnrolement->id_pe }}">
                                                                                        {{ $pointsEnrolement->nom_pe }}
                                                                                    </option>
                                                                                @endforeach
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
