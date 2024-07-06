@php
    use App\Http\Controllers\ProduitController;
    use App\Http\Controllers\ServiceController;
    $produits = ProduitController::get();
    $services = ServiceController::get();


    //linkdin twitter facebook youtube
    //acceuil disp 4last actualite
@endphp


    <!DOCTYPE html>
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]>
<html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> <!--<![endif]-->

<head>

    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <title>LOUBA | E-rdv</title>
    <meta name="description" content="Louba | E-rdv">
    <meta name="author" content="Radian">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Bootstrap -->

    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}">
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Main Style -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/customs.css">

    <!-- Color Style -->
    <link rel="stylesheet" href="/css/skins/colors/red.css" name="colors">

    <!-- Layout Style -->
    <link rel="stylesheet" href="/css/layout/wide.css" name="layout">

    <!-- Style Switcher Box -->
    <link rel="stylesheet" href="/css/switcher/style.css">

    <!-- Custom Css  -->
    <link rel="stylesheet" href="/assets/customs/my_custom.css">

    <!-- Partenaire caroussel -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css'>
    {{--<link rel="stylesheet" href="/assets/carousel/style.css">--}}


    <!--[if lt IE 9]>
    <script src="/js/html5.js"></script>
    <![endif]-->

    <!-- Favicons -->
    <link rel="shortcut icon" href="/imgg/p0.jpg">

    <style>
        .top-bar, .services.style-1 .item .circle, .services.style-1 .item.active:hover .circle, .responsive > ul, .accordion h4, .accordion.style2 .icon-plus, .accordion.style2 .icon-minus, .button.black, .button.color:hover, #horizontal-tabs.style2 ul.tabs li, #vertical-tabs.style2 ul.tabs li, #toggle-view li h4.black, .services.style-2 .item.active .circle, .services.style-2 .item:hover .circle, .services.style-3 .item .circle, .services.style-3 .item.active:hover .circle, #options li a:hover, #options li a.selected, .portfolio-control a:hover, .flex-direction-nav li a, .share-social a, .widget .followers li a {
            background: #008f5d;
        }

        .footer-top, .social-color, .icons-color, body.under-construction .content input.subscribe-button:hover {
            background: #008f5d;
        }

        .button.color {
            background: #008f5d;
            color: #ffc107;
        }

        .services.style-1 .item.active .circle, .services.style-1 .item:hover .circle, .more:hover, .subscribe input.submit, #menu > a, .page-title, .accordion h4.ui-state-active, .accordion.style2 h4.ui-state-active .icon-plus, .accordion.style2 h4.ui-state-active .icon-minus, .meter > span::after, .animate > span > span, .button.black:hover, #horizontal-tabs.style2 ul.tabs li.current, #vertical-tabs.style2 ul.tabs li.current, #horizontal-tabs.style2 ul.tabs li:hover, #vertical-tabs.style2 ul.tabs li:hover, #toggle-view li h4.color, .highlight-color, .dropcap.color, .pagination a.next-button:hover, .pagination a.prev-button:hover, .pagination a:hover, .pagination a.current, table.style.color th, .meter .meter-content, .team .item .member-social a:hover, .services.style-2 .item .circle, .services.style-2 .item.active:hover .circle, .services.style-3 .item.active .circle, .services.style-3 .item:hover .circle, .tables-column .footer h4 a:hover, .tables-column.color .header h3, .tables-column.color .footer h4 a, .tables-column .header h3 span.pop, .share-social a:hover, .popular-tags a:hover, .widget .followers li a:hover, body.under-construction #wrap.boxed, body.under-construction .content input.subscribe-button, .flex-control-nav li a.flex-active, .flex-control-nav li a:hover, header.style-4 .top-bar, html.ie.ie8 .img-caption, html.ie.ie8 .fancybox-title-float-wrap .child, .slide-bg-color {
            background: #dc3545;
        }

        .navigation ul li a, h3.title, .latest-blog .item h3 a, .accordion.style2 h4, .accordion.style2 h4 a, .slider-1:hover .flex-direction-nav li a, .slider-2:hover .flex-direction-nav li a {
            color: #ffc107;
        }

        h2 {
            color: #ffc107;
            font-weight: bold
        }

        .logo img {
            width: auto;
            height: auto;
        }

        .navigation ul li {
            position: relative;
            display: inline;
            margin-left: 0px;
            text-transform: uppercase;
        }

        li.active a {
            border-top: 4px solid #dc3545;
        }

        .partenair {
            max-height: 80px
        }

        /*
        .container .one-third.column {
          width: 300px;
        }
        */

        .navigation ul li a {
            display: block;
            padding: 48px 1px 42px 15px;
        }


        navigation ul li a:hover, .navigation ul li a.selected, .navigation ul li.active a {
            border-top: 4px solid #ffc107;
        }


        .services.style-1 .item.active .circle, .services.style-1 .item:hover .circle, .more:hover, .subscribe input.submit, #menu > a, .page-title, .accordion h4.ui-state-active, .accordion.style2 h4.ui-state-active .icon-plus, .accordion.style2 h4.ui-state-active .icon-minus, .meter > span::after, .animate > span > span, .button.black:hover, #horizontal-tabs.style2 ul.tabs li.current, #vertical-tabs.style2 ul.tabs li.current, #horizontal-tabs.style2 ul.tabs li:hover, #vertical-tabs.style2 ul.tabs li:hover, #toggle-view li h4.color, .highlight-color, .dropcap.color, .pagination a.next-button:hover, .pagination a.prev-button:hover, .pagination a:hover, .pagination a.current, table.style.color th, .meter .meter-content, .team .item .member-social a:hover, .services.style-2 .item .circle, .services.style-2 .item.active:hover .circle, .services.style-3 .item.active .circle, .services.style-3 .item:hover .circle, .tables-column .footer h4 a:hover, .tables-column.color .header h3, .tables-column.color .footer h4 a, .tables-column .header h3 span.pop, .share-social a:hover, .popular-tags a:hover, .widget .followers li a:hover, body.under-construction #wrap.boxed, body.under-construction .content input.subscribe-button, .flex-control-nav li a.flex-active, .flex-control-nav li a:hover, header.style-4 .top-bar, html.ie.ie8 .img-caption, html.ie.ie8 .fancybox-title-float-wrap .child, .slide-bg-color {
            background: #ffc107;
        }

        .navigation ul li a:hover, .navigation ul li a.selected, .navigation ul li.active a {
            border-top: 4px solid #ffc107;
        }

        .slidecontrols li a.carousel1-next, .slidecontrols li a.carousel1-prev, .slidecontrols li a.carousel2-next, .slidecontrols li a.carousel2-prev, .slidecontrols li a.carousel3-next, .slidecontrols li a.carousel3-prev, .slidecontrols li a.carousel4-next, .slidecontrols li a.carousel4-prev, .more {
            background: #ffc107;
        }

        top-bar, .services.style-1 .item .circle, .services.style-1 .item.active:hover .circle, .responsive > ul, .accordion h4, .accordion.style2 .icon-plus, .accordion.style2 .icon-minus, .button.black, .button.color:hover, #horizontal-tabs.style2 ul.tabs li, #vertical-tabs.style2 ul.tabs li, #toggle-view li h4.black, .services.style-2 .item.active .circle, .services.style-2 .item:hover .circle, .services.style-3 .item .circle, .services.style-3 .item.active:hover .circle, #options li a:hover, #options li a.selected, .portfolio-control a:hover, .flex-direction-nav li a, .share-social a, .widget .followers li a {
            background: #fff;
        }


        @media only screen and (max-width: 479px) {
        }

        /* #menu > ul {
          width: 200px;
          //right: 141px;
          top: 50px;
        } */

        .navigation ul li {
            text-transform: capitalize;
        }

        .myform {
            padding: 10px;
            width: 100%;
            max-width: 80%;
            border: 2px solid #008f5d;
            margin: 4px;
            transition: 0.3s;
        }

        .myform:focus {
            border: 20px solid #008f5d;
            transition: 0.5s;
        }

        .phone-mail i.icon-envelope-alt, .navigation ul li, .img-caption .desc p, .subscribe input.mail, .subscribe input.submit, .progress-bar h5, blockquote, .qoute p, .testimonial-item .author span, .testimonial-item .author a, .widget #horizontal-tabs ul.tabs li, .post-tags i, .notification_error {
            font-size: 14px;
        }

        .navigation ul li a {
            display: block;
            padding: 48px 1px 42px 10px;
        }

        /* //jaune text #ffc107
        //rouge tiret #dc3545 */
    </style>

</head>
<body style='font-family:"Century Gothic";font-size:14px;'>

<div id="wrap" class="boxed">

    <a style="" href="/seLoguer" class="link-take-appointment">
        <button href="/seLoguer" role="button">
            Prendre un Rendez-vous
        </button>
    </a>


    <header>
        <div class="div-top-bar">
            <div class="d-flex flex-row coat-of-arms">

                <img src="/imgg/logo.png" alt="">

                <div class="d-flex justify-content-center align-items-center">
                    <p class="text">
                        <strong>REPUBLIQUE DE GUINEE</strong>
                        <small>
                            <br>MINISTÈRE DE LA SÉCURITÉ ET
                            <br>DE LA PROTECTION CIVILE
                        </small>
                    </p>
                </div>
            </div>

            <div class="social-networks-container d-flex flex-column justify-content-center align-items-start">
                <div class="social-networks d-flex flex-row justify-content-start w-100">
                    <a href="#"><i class="social_icon-linkedin s-14 "></i></a>
                    <a href="#"><i class="social_icon-twitter s-14"></i></a>
                    <a href="#"><i class="social_icon-facebook s-14"></i></a>
                    <a href="#"><i class="social_icon-youtube s-14"></i></a>
                </div>
                <a class="s-10">
                    <i class="icon-phone"></i> +224620000001
                </a>
                <a class="s-10" href='mailto:contact@loubaservices'>
                    <i class="icon-envelope-alt"></i> contact@loubaservices
                </a>
            </div>
        </div>
        <!-- End top-bar -->
        {{-- <div class="top-bar" style="padding-bottom:40px">

          <div style="margin-left:3%;position:absolute">
            <img style="vertical-align:middle;width:160px !important" src="/imgg/lololo.png" >
          </div>

          <div class="container clearfix">

            <div class="slidedown">

             <div class="eight columns" style="float:auto" >

               <div class="phone-mail">
                 <a><i class="icon-phone"></i>+224620000001</a>
                 <a href='mailto:contact@oni.gov.gn'><i class="icon-envelope-alt"></i> Email : contact@oni.gov.gn</a>
               </div>
               <!-- End phone-mail -->
             </div>

              <div class="eight columns">
                <div class="social">
                  <a href="#"><i class="social_icon-linkedin s-18"></i></a>
                  <a href="#"><i class="social_icon-twitter s-14"></i></a>
                  <a href="#"><i class="social_icon-facebook s-18"></i></a>
                  <a href="#"><i class="social_icon-youtube s-18"></i></a>

                </div>
              </div><!-- End social-icons -->

            </div><!-- End slidedown -->
          </div><!-- End Container -->

        </div><!-- End top-bar --> --}}

        {{--<div class="main-header" style="box-shadow: 0px 2px 10px #bbb;">

            <div class="container clearfix" style="width:90%">
                <a href="#" class="down-button"><i class="icon-angle-down"></i></a><!-- this appear on small devices -->
                <div class="one-third column" style="width:auto">
                    <div class="logo">
                        <a href="#">
                            <img style="width:80px !important" src="/imgg/logo.png" alt="logo"/>
                        </a>
                    </div>
                </div><!-- End Logo -->

                <!--  Start mobile menu  -->
                <div class="two-thirds column mob-disapear" style="width:auto">
          <span style="cursor:pointer; font-size:30px; color:#ff9d00;" onclick="openNav()">
            <i class="icon-reorder" aria-hidden="true" style="margin-top:35px;"></i></span>

                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn"
                           onclick="closeNav()" style="color: white; font-weight:bold">&times;</a>
                        <nav id="menu">
                            <ul id="nav" style="display: block; background-color:#4444;">
                                <li><a href="#">Accueil</a></li>
                                <li><a href="#" class="">Qui sommes nous</a>
                                    <ul>
                                        <li class="active"><a href="#">Home 2</a></li>
                                        <li><a href="#">Home 3</a></li>
                                        <li><a href="#">Home 4</a></li>
                                    </ul>
                                </li>
                                <li><a href="#" class="">Services</a>
                                    <ul>
                                        <li class="active"><a href="#">Home 2</a></li>
                                        <li><a href="#">Home 3</a></li>
                                        <li><a href="#">Home 4</a></li>
                                    </ul>
                                </li>
                                <li><a href="#" class="">Demandes</a>
                                    <ul>
                                        <li class="active"><a href="#">Home 2</a></li>
                                        <li><a href="#">Home 3</a></li>
                                        <li><a href="#">Home 4</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Actualité</a></li>
                            </ul>
                        </nav>

                    </div>
                    <script>
                        function openNav() {
                            document.getElementById("mySidenav").style.width = "250px";
                        }

                        function closeNav() {
                            document.getElementById("mySidenav").style.width = "0";
                        }

                        var dropdown = document.getElementsByClassName("dropdown-btn");
                        var i;

                        for (i = 0; i < dropdown.length; i++) {
                            dropdown[i].addEventListener("click", function () {
                                this.classList.toggle("active");
                                var dropdownContent = this.nextElementSibling;
                                if (dropdownContent.style.display === "block") {
                                    dropdownContent.style.display = "none";
                                } else {
                                    dropdownContent.style.display = "block";
                                }
                            });
                        }
                    </script>
                    <!-- End mobile menu -->

                    <nav id="menu" class="navigation" role="navigation" style="color:#008f5d">
                        --}}{{-- <a href="#">Show navigation</a><!-- this appear on small devices --> --}}{{--

                        <ul id="nav">
                            <li style='text-transform:uppercase' class="active"><a href="/">Acceuil</a></li>
                            <li><a style="text-transform:uppercase;color:#008f5d" href="/content/directeur-general">Qui
                                    sommes-nous?</a>
                                <ul>
                                    <li><a style="text-transform:initial;color:#008f5d" href="/content/presentation">Présentation</a>
                                    </li>
                                    <li><a style="text-transform:initial;color:#008f5d" href="/equipe">Equipe
                                            (Organigramme)</a></li>
                                    <li><a style="text-transform:initial;color:#008f5d" href="/content/oni-en-chiffre">ONI
                                            en chiffres</a></li>
                                </ul>
                            </li>


                            <li><a style="text-transform:uppercase;color:#008f5d" href="#">services</a>
                                <ul>
                                    @php
                                        $inc = 0;
                                    @endphp
                                    @foreach( $services as $service )
                                        @php
                                            $inc++;
                                            if( $inc == 3 ) $urlService = "/suivreMesDocuments";
                                            elseif( $inc == 4 ) $urlService = "/trouver_un_centre";
                                            elseif( $inc == 1 ) $urlService = "/service/service-vip";
                                            elseif( $inc == 2 ) $urlService = "/service/procedure-d-urgence";
                                        @endphp
                                        <li><a style="text-transform:initial;color:#008f5d"
                                               href="{{$urlService}}">{{$service->nom_type_document}}</a></li>
                                    @endforeach

                                </ul>
                            </li>


                            <li><a style="text-transform:uppercase;color:#008f5d" href="#">Produits</a>
                                <ul>
                                    @php
                                        $inc = 0;
                                    @endphp
                                    @foreach( $produits as $produit )
                                        @php
                                            $inc++;
                                            if( $inc == 3 ) $urlproduct = "/product/titre-de-sejour";
                                            elseif( $inc == 4 ) $urlproduct = "/product/piece-d-identite";
                                            elseif( $inc == 1 ) $urlproduct = "/product/passport";
                                            elseif( $inc == 2 ) $urlproduct = "/product/visa";
                                        @endphp
                                        <li><a style="text-transform:initial;color:#008f5d"
                                               href="{{$urlproduct}}">{{$produit->nom_type_document}}</a></li>
                                    @endforeach
                                </ul>
                            </li>


                            <li><a style="text-transform:uppercase;color:#008f5d" href="#">Contacts</a>
                                <ul>
                                    <li><a style="text-transform:initial;color:#008f5d" href="/contact">ONI vous
                                            ecoute</a></li>
                                </ul>
                            </li>


                            <li><a style="text-transform:uppercase;color:#008f5d" href="/actualite">Actualités</a>
                            </li>

                            <li><a href="/suivreMesDocuments"><span
                                        style="color:#fff;padding:5px;border-radius:4px;background:#198754 !important;text-transform:uppercase">Suivre mes documents <i
                                            style="color:#ffc107" class="icon-home"></i></span></a>
                            </li>

                            <li><a href="/seLoguer"><span
                                        style="color:#fff;padding:5px;border-radius:4px;background:#198754 !important;text-transform:uppercase"> Rendez-vous <i
                                            style="color:#ffc107" class="icon-home"></i></span></a>
                            </li>

                            <li><a target="_blank" href="https://www.paf.gov.gn/visa"><span
                                        style="color:#fff;padding:5px;border-radius:4px;background:#198754 !important">E-VISA <i
                                            style="color: #ffc107" class="social_icon-rss"></i></span></a>
                            </li>

                            <li><a style="text-transform:uppercase;color:#008f5d" href="#">
                                    <i style='display:none' class="social_icon-flickr s-10"></i>
                                    <i style='display:none' class="social_icon-flickr s-10"></i>
                                    <svg sstyle='display:none' xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                         fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                        <path
                                            d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"></path>
                                    </svg>
                                </a>
                                <ul>
                                    <li><a style="text-transform:initial;color:#008f5d" href="/content/appel-offre">Appels
                                            d'offres</a></li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div><!-- End Menu -->

            </div><!-- End Container -->
        </div>--}}
        <div id="navbar">
            <nav class="navbar-container container">
                <a href="/" class="home-link">
                    <img style="height:50px !important" src="/imgg/logo.png" alt="logo"/>
                    <div class="navbar-logo"></div>
                </a>
                <button type="button" class="navbar-toggle" aria-label="Toggle menu" aria-expanded="false"
                        aria-controls="navbar-menu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div id="navbar-menu" class="detached">
                    {{--<ul class="navbar-links">
                        <li class="navbar-item"><a class="navbar-link" href="/about">About</a></li>
                        <li class="navbar-item"><a class="navbar-link" href="/blog">Blog</a></li>
                        <li class="navbar-item"><a class="navbar-link" href="/careers">Careers</a></li>
                        <li class="navbar-item"><a class="navbar-link" href="/contact">Contact</a></li>
                    </ul>--}}

                    <ul class="navbar-links">
                        <li class="accordion_ navbar-item">
                            <a href="#" class="navbar-link accordion-toggle">Hover me</a>
                            <div class="accordion-content shadow-sm">
                                <ul class="p-2">
                                    <li class=""><a href="#">Home 2</a></li>
                                    <li><a href="#">Home 3</a></li>
                                    <li><a href="#">Home 4</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="navbar-item"><a class="navbar-link" href="#">Accueil</a></li>
                        <li class="navbar-item">
                            <a href="#" class="navbar-link">Qui sommes nous</a>
                            <ul class="navbar-dropdown shadow-sm">
                                <li class=""><a href="#">Home 2</a></li>
                                <li><a href="#">Home 3</a></li>
                                <li><a href="#">Home 4</a></li>
                            </ul>
                        </li>
                        <li class="navbar-item">
                            <a href="#" class="navbar-link">Services</a>
                            <ul>
                                <li class="active"><a href="#">Home 2</a></li>
                                <li><a href="#">Home 3</a></li>
                                <li><a href="#">Home 4</a></li>
                            </ul>
                        </li>
                        <li class="navbar-item">
                            <a href="#" class="navbar-link">Produits</a>
                            <ul>
                                <li class="active"><a href="#">Home 2</a></li>
                                <li><a href="#">Home 3</a></li>
                                <li><a href="#">Home 4</a></li>
                            </ul>
                        </li>
                        <li class="navbar-item"><a class="navbar-link" href="#">Contact</a></li>
                        <li class="navbar-item"><a class="navbar-link" href="#">Actualité</a></li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="main-header" style="box-shadow: 0px 2px 10px #bbb;">

            <div class="container clearfix" style="width:90%">
                <a href="#" class="down-button"><i class="icon-angle-down"></i></a><!-- this appear on small devices -->
                <div class="one-third column" style="width:auto">
                    <div class="logo">
                        <a href="#">
                            <img style="width:80px !important" src="/imgg/logo.png" alt="logo"/>
                        </a>
                    </div>
                </div><!-- End Logo -->

                <!--  Start mobile menu  -->
                <div class="two-thirds column mob-disapear" style="width:auto">
          <span style="cursor:pointer; font-size:30px; color:#ff9d00;" onclick="openNav()">
            <i class="icon-reorder" aria-hidden="true" style="margin-top:35px;"></i></span>

                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn"
                           onclick="closeNav()" style="color: white; font-weight:bold">&times;</a>
                        <nav id="menu">
                            <ul id="nav" style="display: block; background-color:#4444;">
                                <li><a href="#">Accueil</a></li>
                                <li><a href="#" class="">Qui sommes nous</a>
                                    <ul>
                                        <li class="active"><a href="#">Home 2</a></li>
                                        <li><a href="#">Home 3</a></li>
                                        <li><a href="#">Home 4</a></li>
                                    </ul>
                                </li>
                                <li><a href="#" class="">Services</a>
                                    <ul>
                                        <li class="active"><a href="#">Home 2</a></li>
                                        <li><a href="#">Home 3</a></li>
                                        <li><a href="#">Home 4</a></li>
                                    </ul>
                                </li>
                                <li><a href="#" class="">Produits</a>
                                    <ul>
                                        <li class="active"><a href="#">Home 2</a></li>
                                        <li><a href="#">Home 3</a></li>
                                        <li><a href="#">Home 4</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Actualité</a></li>
                            </ul>
                        </nav>

                    </div>
                    <script>
                        function openNav() {
                            document.getElementById("mySidenav").style.width = "250px";
                        }

                        function closeNav() {
                            document.getElementById("mySidenav").style.width = "0";
                        }

                        var dropdown = document.getElementsByClassName("dropdown-btn");
                        var i;

                        for (i = 0; i < dropdown.length; i++) {
                            dropdown[i].addEventListener("click", function () {
                                this.classList.toggle("active");
                                var dropdownContent = this.nextElementSibling;
                                if (dropdownContent.style.display === "block") {
                                    dropdownContent.style.display = "none";
                                } else {
                                    dropdownContent.style.display = "block";
                                }
                            });
                        }
                    </script>
                    <!-- End mobile menu -->

                    <nav id="menu" class="navigation" role="navigation" style="color:#008f5d">
                        {{-- <a href="#">Show navigation</a><!-- this appear on small devices --> --}}

                        <ul id="nav">
                            <li style='text-transform:uppercase' class="active"><a href="/">Acceuil</a></li>
                            <li><a style="text-transform:uppercase;color:#008f5d" href="/content/directeur-general">Qui
                                    sommes-nous?</a>
                                <ul>
                                    <li><a style="text-transform:initial;color:#008f5d" href="/content/presentation">Présentation</a>
                                    </li>
                                    <li><a style="text-transform:initial;color:#008f5d" href="/equipe">Equipe
                                            (Organigramme)</a></li>
                                    <li><a style="text-transform:initial;color:#008f5d" href="/content/oni-en-chiffre">LOUBA
                                            en chiffres</a></li>
                                </ul>
                            </li>


                            <li><a style="text-transform:uppercase;color:#008f5d" href="#">services</a>
                                <ul>
                                    @php
                                        $inc = 0;
                                    @endphp
                                    @foreach( $services as $service )
                                        @php
                                            $inc++;
                                            if( $inc == 3 ) $urlService = "/suivreMesDocuments";
                                            elseif( $inc == 4 ) $urlService = "/trouver_un_centre";
                                            elseif( $inc == 1 ) $urlService = "/service/service-vip";
                                            elseif( $inc == 2 ) $urlService = "/service/procedure-d-urgence";
                                        @endphp
                                        <li><a style="text-transform:initial;color:#008f5d"
                                               href="{{$urlService}}">{{$service->nom_type_document}}</a></li>
                                    @endforeach

                                </ul>
                            </li>


                            <li><a style="text-transform:uppercase;color:#008f5d" href="#">Produits</a>
                                <ul>
                                    @php
                                        $inc = 0;
                                    @endphp
                                    @foreach( $produits as $produit )
                                        @php
                                            $inc++;
                                            if( $inc == 3 ) $urlproduct = "/product/titre-de-sejour";
                                            elseif( $inc == 4 ) $urlproduct = "/product/piece-d-identite";
                                            elseif( $inc == 1 ) $urlproduct = "/product/passport";
                                            elseif( $inc == 2 ) $urlproduct = "/product/visa";
                                        @endphp
                                        <li><a style="text-transform:initial;color:#008f5d"
                                               href="{{$urlproduct}}">{{$produit->nom_type_document}}</a></li>
                                    @endforeach
                                </ul>
                            </li>


                            <li><a style="text-transform:uppercase;color:#008f5d" href="#">Contacts</a>
                                <ul>
                                    <li><a style="text-transform:initial;color:#008f5d" href="/contact">LOUBA vous
                                            ecoute</a></li>
                                </ul>
                            </li>


                            <li><a style="text-transform:uppercase;color:#008f5d" href="/actualite">Actualités</a>
                            </li>

                            <li><a href="/suivreMesDocuments"><span
                                        style="color:#fff;padding:5px;border-radius:4px;background:#198754 !important;text-transform:uppercase">Suivre mes documents <i
                                            style="color:#ffc107" class="icon-home"></i></span></a>
                            </li>

                            <li><a href="/seLoguer"><span
                                        style="color:#fff;padding:5px;border-radius:4px;background:#198754 !important;text-transform:uppercase"> Rendez-vous <i
                                            style="color:#ffc107" class="icon-home"></i></span></a>
                            </li>

                            <li><a target="_blank" href="https://www.paf.gov.gn/visa"><span
                                        style="color:#fff;padding:5px;border-radius:4px;background:#198754 !important">E-VISA <i
                                            style="color: #ffc107" class="social_icon-rss"></i></span></a>
                            </li>

                            <li><a style="text-transform:uppercase;color:#008f5d" href="#">
                                    <i style='display:none' class="social_icon-flickr s-10"></i>
                                    <i style='display:none' class="social_icon-flickr s-10"></i>
                                    <svg sstyle='display:none' xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                         fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                        <path
                                            d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"></path>
                                    </svg>
                                </a>
                                <ul>
                                    <li><a style="text-transform:initial;color:#008f5d" href="/content/appel-offre">Appels
                                            d'offres</a></li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div><!-- End Menu -->

            </div><!-- End Container -->
        </div><!-- End main-header -->

    </header><!-- <<< End Header >>> -->


    @yield('content')


    <footer>


        <div class="footer-top">
            <div class="container clearfix">

                <div class="one-third column widget">
                    <h3 class="title">Qui Sommes-Nous</h3>
                    <div style="margin-left: 15px; font-weight:thin; font-size:0.8em;">
                        <p><i class="icon-caret-right s-20"></i> Directeur Générale<br>
                            <i class="icon-caret-right s-20"></i> Présentation<br>
                            <i class="icon-caret-right s-20"></i> Equipe (Organigramme)<br>
                    </div><!-- Tweets Code -->
                </div><!-- End Tweets Widget -->

                <div class="one-third column widget">
                    <h3 class="title">Services</h3>
                    <div style="margin-left: 15px; font-weight:thin; font-size:0.8em;">
                        <p><i class="icon-caret-right s-20"></i> Service VIP<br>
                            <i class="icon-caret-right s-20"></i> Procédure d'urgence<br>
                            <i class="icon-caret-right s-20"></i> Statut de mon enrolement<br>
                            <i class="icon-caret-right s-20"></i> Trouver un centre</p><br>
                    </div>
                    <br>
                    <h3 class="title">Produits</h3>
                    <div style="margin-left: 15px; font-weight:thin; font-size:0.8em;">
                        <p><i class="icon-caret-right s-20"></i> Passport<br>
                            <i class="icon-caret-right s-20"></i> Visa<br>
                            <i class="icon-caret-right s-20"></i> Titre de séjour<br>
                            <i class="icon-caret-right s-20"></i> Pièce d'identité</p><br>
                    </div>
                </div><!-- End Flickr Widget -->

                <div class="one-third column widget">
                    <div class="subscribe">
                        <h3 class="title">Utiles</h3>
                        <div style="margin-left: 15px; font-weight:thin; font-size:0.8em;">
                            <p><i class="icon-caret-right s-20"></i> <a style="color:white;"
                                                                        href="https://gouvernement.gov.gn"
                                                                        target="_blank">Présidence de la republique
                                    Guineenne</a><br>
                                <i class="icon-caret-right s-20"></i> <a style="color:white;"
                                                                         href="https://minspc.gov.gn/" target="_blank">
                                    Ministere de la securité et la protection civile</a></p><br>
                            <i class="icon-caret-right s-20"></i> <a style="color:white;" href="#" target="_blank">
                                Suivre mes document</a><br>
                            <i class="icon-caret-right s-20"></i> <a style="color:white;" href="#" target="_blank">
                                Rendez-vous</a><br>
                            <i class="icon-caret-right s-20"></i> <a style="color:white;" href="#" target="_blank">
                                E-visa</a><br>
                        </div>
                    </div>
                </div><!-- End Subscribe Widget -->


            </div><!-- End container -->
        </div><!-- End footer-top -->

        <div class="footer-down">
            <div class="container clearfix">

                <div class="eight columns">
            <span class="copyright">
            © Copyright {{date('Y')}} <a href="#">Develop</a>. by
            <a href="#" target="_blank">Radian</a></span>
                </div><!-- End copyright -->

                <div class="eight columns">
                    <div class="social">
                        <a href="#"><i class="social_icon-linkedin s-18"></i></a>
                        <a href="#"><i class="social_icon-twitter s-14"></i></a>
                        <a href="#"><i class="social_icon-facebook s-18"></i></a>
                        <a href="#"><i class="social_icon-youtube s-18"></i></a>
                    </div>
                </div><!-- End social icons -->

            </div><!-- End container -->
        </div><!-- End footer-top -->

    </footer><!-- <<< End Footer >>> -->

</div><!-- End wrap -->

<!-- Start JavaScript -->
{{-- Carousel --}}
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js'></script>
{{--<script src="/assets/carousel/script.js"></script>--}}
{{-- End caroussel --}}
<script src="/js/jquery-1.9.1.min.js"></script> <!-- jQuery library -->
<script src="/js/jquery.easing.1.3.min.js"></script> <!-- jQuery Easing -->
<script src="/js/jquery-ui/jquery.ui.core.js"></script> <!-- jQuery Ui Core-->
<script src="/js/jquery-ui/jquery.ui.widget.js"></script> <!-- jQuery Ui Widget -->
<script src="/js/jquery-ui/jquery.ui.accordion.js"></script> <!-- jQuery Ui accordion-->
<script src="/js/jquery-cookie.js"></script> <!-- jQuery cookie -->
<script src="/js/ddsmoothmenu.js"></script> <!-- Nav Menu ddsmoothmenu -->
<script src="/js/jquery.flexslider.js"></script> <!-- Flex Slider  -->
<script src="/js/colortip.js"></script> <!-- Colortip Tooltip Plugin  -->
<script src="/js/tytabs.js"></script> <!-- jQuery Plugin tytabs  -->
<script src="/js/jquery.ui.totop.js"></script> <!-- UItoTop plugin  -->
<script src="/js/carousel.js"></script> <!-- jQuery Carousel  -->
<script src="/js/jquery.isotope.min.js"></script> <!-- Isotope Filtering  -->
<script src="/js/twitter/jquery.tweet.js"></script> <!-- jQuery Tweets -->
<script src="/js/jflickrfeed.min.js"></script> <!-- jQuery Flickr -->
<script src="/js/social-options.js"></script> <!-- social options , twitter, flickr.. -->
<script src="/js/doubletaptogo.js"></script> <!-- Touch-friendly Script  -->
<script src="/js/fancybox/jquery.fancybox.js"></script> <!-- jQuery FancyBox -->
<script src="/js/jquery.sticky.js"></script> <!-- jQuery Sticky -->
<script src="/js/custom.js"></script> <!-- Custom Js file for javascript in html -->
<!-- End JavaScript -->

<script>
    const navbar = document.getElementById("navbar");
    const navbarToggle = navbar.querySelector(".navbar-toggle");

    function openMobileNavbar() {
        navbar.classList.add("opened");
        navbarToggle.setAttribute("aria-expanded", "true");
    }

    function closeMobileNavbar() {
        navbar.classList.remove("opened");
        navbarToggle.setAttribute("aria-expanded", "false");
    }

    navbarToggle.addEventListener("click", () => {
        if (navbar.classList.contains("opened")) {
            closeMobileNavbar();
        } else {
            openMobileNavbar();
        }
    });

    const navbarMenu = navbar.querySelector("#navbar-menu");
    const navbarLinksContainer = navbar.querySelector(".navbar-links");

    navbarLinksContainer.addEventListener("click", (clickEvent) => {
        clickEvent.stopPropagation();
    });

    navbarMenu.addEventListener("click", closeMobileNavbar);
</script>

</body>

</html>
