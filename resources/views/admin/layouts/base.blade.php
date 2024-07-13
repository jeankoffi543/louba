<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="194x194" href="/favicon-194x194.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <title>Dashboard - Gestion de Rendez-vous</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    {{-- <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}">

    <style>
        #monTableau_filter {
            display: none
        }

        #monTableau_paginate {
            display: none
        }

        #monTableau_info {
            display: none
        }

        .modal-header {
            background: #0b5ed7;
            color: white;
        }


        li:hover a i {

            trasnform: rotate(360deg);
            transition: 2s;

        }

        li a i {
            transition: 1s;

        }

        .sidebar-nav .nav-link {
            font-size: 15px;
            font-weight: 600;
            color: #1a2368;
        }

        .sidebar-nav .nav-link i {
            font-size: 16px;
            margin-right: 10px;
            color: #1a2368;
        }

        .header .search-form input {
            border: 0;
            font-size: 14px;
            color: #012970;
            border: 4px solid rgb(10, 93, 214);
            padding: 7px 38px 7px 8px;
            border-radius: 3px;
            transition: 0.3s;
            width: 100%;
        }

        Ibrahima Sory Junior TOURE .header .search-form input:focus {
            border: 0;
            font-size: 14px;
            color: #012970;
            border: 35px solid rgb(10, 93, 214);
            padding: 7px 38px 7px 8px;
            border-radius: 20px;
            transition: 0.3s;
            width: 100%;
        }


        .search-form:focus i {

            color: #fff;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>

</head>

<body>


    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="/" target="_blank" class="logo d-flex align-items-center">
                <img src="/imgg/logo.png" alt="">
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="{{ route('demande') }}">
                @csrf
                <input type="text" name="code_demande" placeholder="Recherchez CODE Rendez-vous"
                    title="Enter CODE Rendez-vous keyword" required>
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown" style="display:none">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Lorem Ipsum</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>



                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Sit rerum fuga</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>2 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>



                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->








                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="/assets/ic1.png" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->nom }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ auth()->user()->nom }}</h6>
                            <span>{{ auth()->user()->email }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" data-bs-toggle="modal"
                                data-bs-target="#updatePassword">
                                <i class="bi bi-person"></i>
                                <span>Modifier mot de passe</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="/disconnect">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Deconnection</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->


    <!-- Modal Dialog Scrollable -->

    <div class="modal fade" id="updatePassword" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">modifier mot de passe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="/updatePassword">
                    @method('PUT')
                    @csrf

                    <div class="modal-body">

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Ancien Mot de Passe</label>
                            <div class="col-sm-10">
                                <input name="oldPassword" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Nouveau Mot de Passe</label>
                            <div class="col-sm-10">
                                <input name="newPassword" type="text" class="form-control">
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>

                </form>

            </div>
        </div>
    </div><!-- End Modal Dialog Scrollable-->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar" style="background:#0b5ed7">

        <ul class="sidebar-nav" id="sidebar-nav">

            <?php
            /*
$today = date('Y-m-d');
$nextday = date('Y-m-d', strtotime("$today +1 day"));


echo $nextday;
*/
            ?>

            @kcan('consulter-tableau-de-bord')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard') ? 'text-danger' : '' }}"
                        href="{{ route('dashboard') }}">
                        <i class="bi bi-eye"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>
            @endkcan

            @if (auth()->user()->id_role)

                @if (auth()->user()->id_role == 4)
                    @kcan('gestion-demandes')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('demande') && empty(request()->query()) ? 'text-danger' : '' }}"
                                href="{{ route('demande') }}">
                                <i class="bi bi-menu-button-wide"></i>
                                <span>Nouvelles demandes</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('demande') && request()->query('status') === 'REJECTED' ? 'text-danger' : '' }}"
                                href="{{ route('demande', ['status' => 'REJECTED']) }}">
                                <i class="bi bi-menu-button-wide"></i>
                                <span>demandes rejétées</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('demande') && request()->query('status') === 'TRANSMITTED' ? 'text-danger' : '' }}"
                                href="{{ route('demande', ['status' => 'TRANSMITTED']) }}">
                                <i class="bi bi-menu-button-wide"></i>
                                <span>demandes transmises</span>
                            </a>
                        </li>
                    @endkcan
                @endif
            @endif



            {{-- @if (auth()->user()->id_role) --}}
            {{-- @if (auth()->user()->id_role == 1) --}}


            @kcan('gestion-utilisateurs')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('users') ? 'text-danger' : '' }}" href="/users">
                        <i class="bi bi-grid"></i>
                        <span>Gestion Utilsateurs</span>
                    </a>
                </li>


                {{-- <li class="nav-item">
                        <a class="nav-link " href="{{ route('roles') }}">
                            <i class="bi bi-diagram-3-fill"></i>
                            <span>Roles</span>
                        </a>
                    </li> --}}

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('client') ? 'text-danger' : '' }}" href="{{ route('client') }}">
                        <i class="bi bi-person"></i>
                        <span>Clients</span>
                    </a>
                </li>
            @endkcan

            @kis_superadmin()
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('demande') ? 'text-danger' : '' }}"
                        href="{{ route('demande') }}">
                        <i class="bi bi-menu-button-wide"></i>
                        <span>Toutes les demandes</span>
                    </a>
                </li>
            @endkis_superadmin

            @kcan('production-de-document')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('productionDocument') ? 'text-danger' : '' }}"
                        href="/productionDocument">
                        <i class="bi bi-book-half"></i>
                        <span>Production Documents</span>
                    </a>
                </li>
            @endkcan

            @kcan('gestion-moyen-paiement')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('paiement') ? 'text-danger' : '' }}"
                        href="{{ route('paiement') }}">
                        <i class="bi bi-currency-dollar"></i>
                        <span>Paiements</span>
                    </a>
                </li>
            @endkcan

            @kcan('gestion-point-enrolements')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pointenrollement') ? 'text-danger' : '' }}"
                        href="{{ route('pointenrollement') }}">
                        <i class="bi bi-door-open-fill"></i>
                        <span>Gestion Points Enrolements</span>
                    </a>
                </li>
            @endkcan

            @kcan('gestion-calendrier-point-enrolement')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('holidays') ? 'text-danger' : '' }}"
                        href="{{ route('holidays') }}">
                        <i class="bi bi-door-open-fill"></i>
                        <span>Calandrier point enrolement</span>
                    </a>
                </li>
            @endkcan

            @kis_superadmin()
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle {{ request()->is('circuit') || request()->is('services') || request()->is('groupes') || request()->is('permissions/*') || request()->is('circuit/add/*') ? 'text-danger' : '' }}"
                        data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                        aria-controls="collapseExample">
                        <i class="bi bi-gear"></i>
                        <span>Paramétrage</span>
                        {{-- <i class="bi bi-chevron-down ms-1"></i> --}}
                    </a>
                </li>

                <div class="collapse ps-2" id="collapseExample">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('circuit') || request()->is('circuit/add/*') ? 'text-danger' : '' }}"
                            href="{{ route('circuit') }}">
                            <i class="bi bi-door-open-fill"></i>
                            <span>Circuit de traitement</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('services') ? 'text-danger' : '' }}"
                            href="{{ route('services') }}">
                            <i class="bi bi-door-open-fill"></i>
                            <span>Services</span>
                        </a>
                    </li>

                    @kcan('gestion-produits')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('produit') ? 'text-danger' : '' }}" href="/produit">
                                <i class="bi bi-plug-fill"></i>
                                <span>Produits</span>
                            </a>
                        </li>
                    @endkcan


                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('groupes') || request()->is('permissions/*') ? 'text-danger' : '' }}"
                            href="{{ route('groupes') }}">
                            <i class="bi bi-door-open-fill"></i>
                            <span>Groupes</span>
                        </a>
                    </li>
                </div>
            @endkis_superadmin
            {{-- 
                    <li class="nav-heading" style="color:#fff">Site web</li>

                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('slider') }}">
                            <i class="bi bi-arrow-left-circle-fill"></i>
                            <span>Sliders</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="/actuality">
                            <i class="bi bi-info"></i>
                            <span>Actualités</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="/article">
                            <i class="bi bi-justify-left"></i>
                            <span>Articles</span>
                        </a>
                    </li> --}}

            {{-- <li class="nav-item">
                        <a class="nav-link " href="{{ route('services') }}">
                            <i class="bi bi-plug-fill"></i>
                            <span>Services</span>
                        </a>
                    </li> --}}

            {{-- 
                    <li class="nav-item">
                        <a class="nav-link " href="/reclammation">
                            <i class="bi bi-justify-left"></i>
                            <span>réclamations</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('partners') }}">
                            <i class="bi bi-users-left"></i>
                            <span>Nos partenaires</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('socials') }}">
                            <i class="bi bi-users-left"></i>
                            <span>Réseaux sociaux</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('aboutUs') }}">
                            <i class="bi bi-users-left"></i>
                            <span>Page a propos</span>
                        </a>
                    </li> --}}





        </ul>

    </aside><!-- End Sidebar-->





    @yield('content')
    @include('flash::message')



    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>LOUBA</span></strong>. All Rights Reserved
        </div>

    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    {{-- <script src="/assets/vendor/bootstrap/js/propper.min.js"></script> --}}
    <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
    {{-- <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
    <script src="/assets/vendor/chart.js/chart.min.js"></script>
    <script src="/assets/vendor/echarts/echarts.min.js"></script>
    <script src="/assets/vendor/quill/quill.min.js"></script>
    <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/assets/vendor/php-email-form/validate.js"></script>

    <script src="/jquery-3.6.1.min.js"></script>
    <script src="/jquery.dataTables.min.js"></script>
    <script src="dataTables.buttons.min.js"></script>
    <script src="/jszip.min.js"></script>
    <script src="/pdfmake.min.js"></script>
    <script src="/vfs_fonts.js"></script>
    <script src="/buttons.html5.min.js"></script>
    {{-- <script src="/bootstrap.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <script src="{{ asset('js/lightbox.js') }}" defer></script>
    <script>
        $(document).ready(function() {
            $('#monTableau').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });
        });
    </script>


    <!-- Template Main JS File -->
    <script src="/assets/js/main.js"></script>
    @apexchartsScripts
</body>

</html>
