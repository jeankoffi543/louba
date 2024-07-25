@php
    use App\Http\Controllers\PointenrollementController;
    $pointenrollements = PointenrollementController::getdata();
@endphp
@extends('visiteur.layoutvisiteur')


@section('content')
    @include('visiteur.style')
    <style>
        .sr-only1 {
            font-weight: bold;
            margin-left: 10px;
            color: #000;
        }


        .oooo {
            margin-bottom: 10px
        }


        .byline {
            text-align: center;
            font-size: 18px;
        }

        .byline a {
            text-decoration: none;
            color: #ce0000;
        }

        #gradient {
            width: 0;
            height: 50px;
            margin: 0 auto;
            border-radius: 100%;
            -webkit-box-shadow: 0 50px 200px 150px rgba(255, 255, 255, 0.93);
            -moz-box-shadow: 0 50px 200px 150px rgba(255, 255, 255, 0.93);
            box-shadow: 0 50px 200px 150px rgba(255, 255, 255, 0.93);
        }

        .searchbox {
            background-color: #fffbf8;
            padding: 13px;
            width: 335px;
            margin: 100px auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            border-radius: 6px;
            -webkit-box-shadow: 0 2px 4px 0 rgba(72, 72, 72, 0.83),
            0 10px 15px 0 rgba(126, 126, 126, 0.12),
            0 -2px 6px 1px rgba(199, 199, 199, 0.55) inset,
            0 2px 4px 2px rgba(255, 255, 255, 0.83) inset;
            -moz-box-shadow: 0 2px 4px 0 rgba(72, 72, 72, 0.83),
            0 10px 15px 0 rgba(126, 126, 126, 0.12),
            0 -2px 6px 1px rgba(199, 199, 199, 0.55) inset,
            0 2px 4px 2px rgba(255, 255, 255, 0.83) inset;
            box-shadow: 0 2px 4px 0 rgba(72, 72, 72, 0.83),
            0 10px 15px 0 rgba(126, 126, 126, 0.12),
            0 -2px 6px 1px rgba(199, 199, 199, 0.55) inset,
            0 2px 4px 2px rgba(255, 255, 255, 0.83) inset;
        }

        input[type="search"] {
            width: 400px;
            height: 55px;
            padding-left: 15px;
            border-radius: 6px;
            border: none;
            color: #939393;
            font-weight: 500;
            background-color: #fffbf8;
            -webkit-box-shadow: 0 -2px 2px 0 rgba(199, 199, 199, 0.55),
            0 1px 1px 0 #fff,
            0 2px 2px 1px #fafafa,
            0 2px 4px 0 #b2b2b2 inset,
            0 -1px 1px 0 #f2f2f2 inset,
            0 15px 15px 0 rgba(41, 41, 41, 0.09) inset;
            -moz-box-shadow: 0 -2px 2px 0 rgba(199, 199, 199, 0.55),
            0 1px 1px 0 #fff,
            0 2px 2px 1px #fafafa,
            0 2px 4px 0 #b2b2b2 inset,
            0 -1px 1px 0 #f2f2f2 inset,
            0 15px 15px 0 rgba(41, 41, 41, 0.09) inset;
            box-shadow: 0 -2px 2px 0 rgba(199, 199, 199, 0.55),
            0 1px 1px 0 #fff,
            0 2px 2px 1px #fafafa,
            0 2px 4px 0 #b2b2b2 inset,
            0 -1px 1px 0 #f2f2f2 inset,
            0 15px 15px 0 rgba(41, 41, 41, 0.09) inset;
        }

        button[type="submit"] {
            height: 30px;
            background-repeat: no-repeat;
            background-position: 10px 5px;
            background-color: transparent;
            -webkit-background-size: 20px 20px;
            background-size: 20px 20px;
            border: none;
            cursor: pointer;
        }

        input[type="search"]:focus {
            outline: 0;
        }

        top-bar, .services.style-1 .item .circle, .services.style-1 .item.active:hover .circle, .responsive > ul, .accordion h4, .accordion.style2 .icon-plus, .accordion.style2 .icon-minus, .button.black, .button.color:hover, #horizontal-tabs.style2 ul.tabs li, #vertical-tabs.style2 ul.tabs li, #toggle-view li h4.black, .services.style-2 .item.active .circle, .services.style-2 .item:hover .circle, .services.style-3 .item .circle, .services.style-3 .item.active:hover .circle, #options li a:hover, #options li a.selected, .portfolio-control a:hover, .flex-direction-nav li a, .share-social a, .widget .followers li a {
            background: #008f5d;
        }

    </style>



    <div class="page-title">
        <div class="container clearfix">

            <div class="sixteen columns" sstyle="background-image: url(/imgg/passeportbg.png);">
                <h1>OMNIFORM SERVICE vous ecoute</h1>
            </div>

        </div><!-- End Container -->
    </div>






    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
          integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <style>

        .leaflet-container {
            height: 400px;
            width: 100%;
            max-width: 100%;
            max-height: 100%;
        }

        .leaflet-bottom {
            display: none;
        }

        .rzborder {
            border: 2px solid #008f5d;
            padding: 20px;
            border-radius: 5px;
            width: 80%;
        }


        .form-box {
            width: 100%;
            margin: 0 20px 15px 0;
        }

        footer {
            margin-top: 0px;
        }
    </style>


    <div class="container main-content clearfix">


        <div class="clearfix"></div>


        <div class="five columns top-3 bottom-2" style="width:50%">

            <h3 style="color:black" class="title bottom-2" style> Toutes vos reclamations sont bien prises en compte
                afin d'ameliorer la qualité de nos services </h3>
            <img src="imgg/complaint.png">

        </div>


        <div class="eleven columns top-3 bottom-2" style="width:40%">


            <div id="note"></div><!-- End notification -->

            <div id="fields" style="text-align:center">

                <form method="POST" action="/sendmessage"
                      style="border:1px solid gray;border-radius:10px;text-align:center;background:rgb(230,230,230)">
                    @csrf

                    <div class="form-box" style="margin-top:5px">
                        <input placeholder="Nom et Prenom" class="rzborder" type="text" name="nom_prenom" class="text"
                               required>
                    </div><!-- End Box -->


                    <div class="form-box">
                        <input placeholder="Telephone" class="rzborder" type="text" name="telephone" class="text"
                               required>
                    </div><!-- End Box -->

                    <div class="form-box">
                        <input placeholder="Email" class="rzborder" type="text" name="email" class="text" required>
                    </div><!-- End Box -->


                    <div>
                        <input type="radio" id="reclammation" name="sujet" value="reclammation" checked>
                        <label for="demande">Réclamations</label>

                        <input type="radio" id="demande" name="sujet" value="demande">
                        <label for="demande">Demande</label>
                    </div>

                    <br>

                    <div class="form-box big" style="text-align:center;margin-left:7%;padding:0px;">
                        <textarea name="message" style="width:80%" name="message" rows="8"></textarea>
                    </div><!-- End Box -->

                    <div class="clearfix"></div>

                    <input style="width:90%;" type="submit" value="Je depose ma reclamation"
                           class="button medium color">

                    <BR><BR>

                    <span> By OMNIFORM © 2022 </span>

                </form>


            </div><!-- End fields -->
        </div>
    </div>

    </div>

    @if( isset($flashmessage) )
        <script>alert('Votre requete a ete prise en compte. Merci')</script>
    @endif

@stop
