<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

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
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <style>
        #monTableau_filter {
            display: none
        }

        #monTableau_paginate {
            display: none
        }

        .dataTable-bottom {
            display: none
        }

        .modal-header {
            background: #0b5ed7;
            color: white;
        }


        .btn-primary {
            --bs-btn-color: #fff;
            --bs-btn-bg: #008f5d;
            --bs-btn-border-color: #0c6647;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #008f5d;
            --bs-btn-hover-border-color: #008f5d;
            --bs-btn-focus-shadow-rgb: 49, 253, 132;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #008f5d;
            --bs-btn-active-border-color: #008f5d;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #fff;
            --bs-btn-disabled-bg: #008f5d;
            --bs-btn-disabled-border-color: #008f5d;
        }


        .pagetitle h1 {
            font-size: 24px;
            margin-bottom: 0;
            font-weight: 600;
            color: green;
        }


        .sidebar-nav .nav-link {
            font-size: 15px;
            font-weight: 600;
            color: green;
        }

        .sidebar-nav .nav-link:hover {
            color: #f1bd41;
        }

        sidebar-nav .nav-link i {
            font-size: 16px;
            margin-right: 10px;
            color: #000;
        }


    </style>


</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center">
            <img src="/imgg/logo.png" style="max-height:65px">
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->


            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="/assets/ic1.png" alt="Profile" class="rounded-circle">
                    <span
                        class="d-none d-md-block dropdown-toggle ps-2">{{session('infoUserClient')->nom_client}}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{session('infoUserClient')->nom_client}}</h6>
                        <span>{{session('infoUserClient')->email_client}}</span>
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
                        <a class="dropdown-item d-flex align-items-center" href="/deconnecter">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Deconnection</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" style="background:#008F5D">

    <ul class="sidebar-nav" id="sidebar-nav">

        <?php
        /*
        $today = date('Y-m-d');
        $nextday = date('Y-m-d', strtotime("$today +1 day"));


        echo $nextday;
        */
        ?>


        <li class="nav-item">
            <a class="nav-link " href="/mesDemandesClients">
                <i class="bi bi-grid" style='color:black'></i>
                <span>Mes demandes</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link " href="/rdvClient">
                <i class="bi bi-diagram-3-fill" style='color:black'></i>
                <span>Prendre un nouveau rendez-vous</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link " href="/">
                <i class="bi bi-home" style='color:black'></i>
                <span>Retour vers le portail </span>
            </a>
        </li>


    </ul>

</aside><!-- End Sidebar-->


<!-- Modal Dialog Scrollable -->

<div class="modal fade" id="updatePassword" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">modifier mot de passe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="/updatePasswordClient">
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


@yield('content')

@include('flash::message')

@if( isset($flashmessage) )
    @php
        dd($flashmessage);
    @endphp
    <script> alert('{{$flashmessage}}') </script>
@endif





<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>RADIANGN</span></strong>. All Rights Reserved
    </div>


</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/chart.js/chart.min.js"></script>
<script src="/assets/vendor/echarts/echarts.min.js"></script>
<script src="/assets/vendor/quill/quill.min.js"></script>
<script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="/assets/vendor/tinymce/tinymce.min.js"></script>
<script src="/assets/vendor/php-email-form/validate.js"></script>


<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https:///cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
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

</body>

</html>
