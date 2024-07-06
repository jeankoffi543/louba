@extends('admin.layouts.base')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle" style="display:flex; justify-content:space-between;align-items:center; ">
            <h1>A Propos</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Siteweb</a></li>
                    <li class="breadcrumb-item active">Page a propos</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Recent Sales -->
                <div class="col-12">

                    <form method="POST" action="{{ route('about-us.update', $aboutUs->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card recent-sales overflow-auto">

                            <div class="card-header">
                                <h4 style="font-weight:bold; text-transform:uppercase">Page a propos
                                </h4>
                            </div>

                            <div class="card-body p-4">

                                <div class="row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">Description complète</label>
                                    <div class="col-sm-10">
                                        <textarea name='complete_description' required class="form-control" style="height: 100px">{{ $aboutUs->full_description }}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label"> Image premier
                                        plan</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="newimage1" >
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
                    CKEDITOR.replace('complete_description');
                </script>



            </div>
        </section>

    </main><!-- End #main -->



@stop
