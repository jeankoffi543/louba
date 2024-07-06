@extends('admin.layouts.base')


@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Permissions</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('groupes') }}">Groupe</a></li>
                    <li class="breadcrumb-item active">Permissions</li>
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






                        <form method="POST" action="{{ route('permissions.habiletes.permissions') }}">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="habilete_id" value="{{ $groupe->id }}">
                            <input type="hidden" name="action" value="add">
                        <div class="card-body">


                           <h5 class="card-title">Gestion des permissions | <span class="text-danger">{{ $groupe->libelle }}</span> <span></span></h5>

                            <div class="container">
                                
                                <div class="row">
                                    @foreach ($permissions as $permission)
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="flexCheckDefault{{ $permission->id }}" name="permissions[]" {{ $groupe->permissions->contains($permission->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexCheckDefault{{ $permission->id }}">
                                                {{ $permission->libelle }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                            </div>
                            
                        </div>

                    </form>

                    </div>
                </div><!-- End Recent Sales -->
















            </div>
        </section>

    </main><!-- End #main -->






@stop
