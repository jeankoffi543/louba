@extends('admin.layouts.base')


@section('content')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Production Documents (passport, carte d'identite ...)</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Production Documents</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">







            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">




                <div class="card-body">


                  <h5 class="card-title">Production Documents <span>| {{$importations->count()}}</span></h5>
                  <a href="production-passport.csv">Telecharger gabarit fichier</a>

<form method="POST" action="/productionDocument" enctype="multipart/form-data">
@csrf
              <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Charger le fichier production de document </label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile" name="document1">
                                    <button type="submit" class="btn btn-primary">Valider</button>
                  </div>
                  <div></div>
                </div>

</form>

@include('flash::message')

                  <table class="table table-borderless datatable" id="monTableau">
                    <thead>
                      <tr>
                        <th scope="col"> Importation</th>
                        <th scope="col"> infos importation</th>
                         <th scope="col"> Consulter fichier</th>
                      </tr>
                    </thead>
                    <tbody>



                      @foreach ($importations as $importation)

                      <tr>
                        <th scope="row"><a href="#">{{$importation->date_register}}</a></th>
                        <td>{{$importation->message}}</td>
                        <td><a href="/uploads/{{$importation->fichier}}" >Consulter fichier</a></td>
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
