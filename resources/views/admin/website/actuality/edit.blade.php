@extends('admin.layouts.base')


@section('content')


    <main id="main" class="main">

        <div class="pagetitle" style="display:flex; justify-content:space-between;align-items:center; ">
            <h1>Actualités</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Siteweb</a></li>
                    <li class="breadcrumb-item active">Actualités</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Recent Sales -->
                <div class="col-12">

                    <form method="POST" action="{{ route('actuality.update', $actuality->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card recent-sales overflow-auto">

                            <div class="card-header">
                                <h4 style="font-weight:bold; text-transform:uppercase">Editer une actualité
                                </h4>
                            </div>

                            <div class="card-body p-4">

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Titre</label>
                                    <div class="col-sm-10">
                                        <input name="titre" required class="form-control" value="{{ $actuality->titre }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Date de publication</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="date_of_publish " name="date_of_publish" required
                                            class="form-control" value="{{ $actuality->date_of_publish }}">
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">résumé</label>
                                    <div class="col-sm-10">
                                        <textarea name='paragraphe1' required class="form-control" style="height: 100px">{{ $actuality->description }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">Description complète</label>
                                    <div class="col-sm-10">
                                        <textarea name='complete_description' required class="form-control" style="height: 100px">
                                          {{ $actuality->full_description }}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputColor" class="col-sm-2 col-form-label">Auteur</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="author" class="form-control" required
                                            placeholder="Entrer l'auteur de l'actualité" value="{{ $actuality->author }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Source</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="source" class="form-control"
                                            value="{{ $actuality->source }}">
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label"> Image premier
                                        plan</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="newimage1">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label"> Image arriere
                                        plan</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="newimage2">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="display:flex;justify-content:space-between">

                                <button type="button" class="btn btn-danger">Annuler</button>
                                <button type="submit" class="btn btn-success">Mettre a jour</button>

                            </div>
                        </div>
                    </form>
                </div><!-- End Recent Sales -->

                <script type="text/javascript">
              
                    CKEDITOR.replace('complete_description');
                </script>



            </div>
        </section>

    </main><!-- End #main -->



@stop
