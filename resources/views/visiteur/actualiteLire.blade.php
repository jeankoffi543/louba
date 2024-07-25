@php
    use App\Http\Controllers\ActualiteController;
    $actualites = ActualiteController::getdata();
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
                <h1>Actualite : {{$actualite->titre}}</h1>
            </div>

        </div><!-- End Container -->
    </div>






    <div class="container main-content clearfix">

        <!-- Start Project Slider -->
        <div class="sixteen columns top-1 bottom-3">

            <div class="slider-project">

                <div class="flex-container">
                    <div class="flexslider2">


                        <div class="flex-viewport" style="overflow: hidden; position: relative;">

                            <ul class="slides"
                                style="display:none;width: 800%; transition-duration: 0s; transform: translate3d(-1880px, 0px, 0px);">

                                <li class="clone" style="width: 940px; float: left; display: block;">
                                    <img src="{{$actualite->image}}">
                                </li>


                            </ul>

                        </div>
                    </div>
                    <ul class="flex-direction-nav">
                        <li><a class="flex-prev" href="#"><i class="icon-angle-left"></i></a></li>
                        <li><a class="flex-next" href="#"><i class="icon-angle-right"></i></a></li>
                    </ul>
                </div>

            </div><!-- End slider-project -->

            <img src="{{$actualite->image}}">
        </div>
        <!-- End column -->

        <div class="clearfix"></div>

        <!-- Start Project Details -->
        <div class="twelve columns bottom-1">

            <h3 class="title">{{$actualite->titre}}</h3>

            <div class="about-project bottom-1">
                <p>
                    {!!html_entity_decode($actualite->paragraphe1)!!}
                </p>
            </div>

            <a href="/actualite" class="button medium color bottom-2">Voir tous les sujets d'actualite</a>

        </div>
        <!-- End Project Details -->


        <div class="four columns bottom-2">
            <img src="/imgg/logo.png">
            <h3 style="display:none" class="title">Publie par OMNIFORM</h3>

            <ul class="arrow-list job bottom-2" style="display:none">
                <li><a href="#">Adresse: Kaloum </a></li>
                <li><a href="#">Tel: 620-111-222 </a></li>
                <li><a href="#">Email: contact@radiangn.com</a></li>
            </ul><!-- End square-list -->


            <div class="clearfix"></div>

            <h3 class="title bottom-1" style="display:none">Share</h3>


        </div>
        <!-- End Project information -->


    </div>

@stop
