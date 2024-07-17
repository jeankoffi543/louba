@php
    use App\Http\Controllers\Front\ContenuSiteWebController;
    $contenusiteweb = ContenuSiteWebController::getcontent4website($tagdur);
    //dd($contenusiteweb);
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

    </style>


    <div class="page-title">
        <div class="container clearfix">

            <div class="sixteen columns" sstyle='background-image: url(/imgg/passeportbg.png);'>
                <h1>{{$contenusiteweb->titre}}</h1>
            </div>

        </div><!-- End Container -->
    </div><!-- End Page title -->




    <div class="container clearfix" style="text-align:center">


    </div><!-- End Container -->

    @if(1 == 0 )

        <div style="text-align:center;margin-top:30px">Aucun resultat trouver avec les code <span
                style="font-weight:bold;color:black">{{$code_demande}}</span></div>

    @else

        <!-- Start main content -->
        <div class="container main-content clearfix">


            <div class="two-thirds column bottom-3">
                <h3 class="title bottom-2">{{$contenusiteweb->titre}}</h3>

                {!!html_entity_decode($contenusiteweb->paragraphe1)!!}


            </div><!-- End Methodology -->


            <div class="one-third column bottom-3">
                <h3 class="title bottom-2"></h3>

                <img src="{{$contenusiteweb->image}}">

            </div><!-- End Why Choose Us -->


        </div><!-- <<< End Container >>> -->

    @endif

@stop
