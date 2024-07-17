@extends('admin.layouts.base')


@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>A propos</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">A Propos</li>
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
                <div class="col-12 ">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body p-5">
                            <!-- Modal Dialog Scrollable -->

                            @if ($about->count() <= 0)
                                <a href="{{ route('about-us.create') }}" class="btn btn-primary">
                                    <i class="bi bi-save2"></i> Ajouter la section
                                </a>
                            @endif
                            <h5 class="card-title">partenaires <span>| {{ $about->count() }}</span></h5>

                            <table class="table table-borderless datatable" id='monTableau'>
                                <thead>
                                    <tr>
                           
                                        <th scope="col"></th>
                                        <th>Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($about as $a)
                                        <tr>


                                            <td>
                                                <a href="{{ $a->image }}" data-lightbox="image">
                                                    <div style="height:50px; width:50px; ">
                                                        <img src="{{ $a->image }}" alt=""
                                                            style="width: 50px; height:50px" />
                                                    </div>
                                                </a>


                                            </td>
                                            <td>{{ $a->full_description }}</td>


                                            <td>

                                                <a class="badge bg-success"
                                                    href="{{ route('about-us.edit', $a->id) }}">Modifier</a>
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
