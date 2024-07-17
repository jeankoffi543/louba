@extends('admin.layouts.base')


@section('content')


    <main id="main" class="main">

        <div class="pagetitle" style="display:flex; justify-content:space-between;align-items:center; ">
            <h1>Slides</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Siteweb</a></li>
                    <li class="breadcrumb-item active">Slides</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Recent Sales -->
                <div class="col-12">
                    <form method="POST" action="{{ route('slider.update', $slider->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card recent-sales overflow-auto">

                            <div class="card-header">
                                <h4 style="font-weight:bold; text-transform:uppercase">Editer un slide </h4>
                            </div>
                            <div class="card-body">

                                <div class="modal-body">


                                    <div class="row mb-3 mt-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Titre</label>
                                        <div class="col-sm-10">
                                            <input name="titre" required class="form-control"
                                                value="{{ $slider->titre }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Résumé</label>
                                        <div class="col-sm-10">
                                            <textarea name='description' required class="form-control" style="height: 100px">{{ $slider->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Description
                                            complète</label>
                                        <div class="col-sm-10">
                                            <textarea name='complete_description' required class="form-control" style="height: 100px">
                                              {{ $slider->full_description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-2 col-form-label"> Image premier
                                            plan</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="image" >
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-2 col-form-label"> Image arriere
                                            plan</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="image_bg" >
                                        </div>
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
