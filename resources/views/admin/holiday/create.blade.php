@extends('admin.layouts.base')


@section('content')


    <main id="main" class="main">

        <div class="pagetitle" style="display:flex; justify-content:space-between;align-items:center; ">
            <h1>Jour fériés</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Siteweb</a></li>
                    <li class="breadcrumb-item active">Jour fériés</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Recent Sales -->
                <div class="col-12">

                    <form method="POST" action="{{ route('holidays.store') }}">
                        @csrf
                        @method('POST')
                        <div class="card recent-sales overflow-auto">

                            <div class="card-header">
                                <h4 style="font-weight:bold; text-transform:uppercase">Enregistrer un nouveau jour férié
                                </h4>
                            </div>

                            <div class="card-body p-4">







                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Raison</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" required class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="date" required class="form-control">
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Point d'enrolement</label>
                                    <div class="col-sm-10">
                                        <select name="id_point_enrolement" id="id_point_enrolement" class="form-control">
                                            @forelse ($enrollementPoints as $item)
                                                <option value="{{ $item->id_pe }}"> {{ $item->nom_pe }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>





                            </div>
                            <div class="card-footer" style="display:flex;justify-content:space-between">

                                <button type="button" class="btn btn-danger">Annuler</button>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>

                            </div>
                        </div>
                    </form>
                </div><!-- End Recent Sales -->














                <script type="text/javascript">
                    CKEDITOR.replace('paragraphe1');
                    CKEDITOR.replace('complete_description');
                </script>



            </div>
        </section>

    </main><!-- End #main -->



@stop
