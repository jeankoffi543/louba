@php
use App\Http\Controllers\ServiceController;
$services = ServiceController::get();
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

        <div class="sixteen columns" style="background-image: url(/imgg/passeportbg.png);">
            <h1>Service</h1>
        </div>

    </div><!-- End Container -->
</div>


<div class="container main-content clearfix">


    <div class="clearfix"></div>


    <div class="team columns-4">


        <div id="accordion2" class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
            @foreach( $services as $service )


            <h4 class="ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-accordion-header-active ui-state-active ui-corner-top"
                role="tab" id="ui-accordion-accordion2-header-0" aria-controls="ui-accordion-accordion2-panel-0"
                aria-selected="true" tabindex="0"><a href="#">{{$service->nom_type_document}}</a></h4>
            <div
                class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                style="display: block;" id="ui-accordion-accordion2-panel-0"
                aria-labelledby="ui-accordion-accordion2-header-0" role="tabpanel" aria-expanded="true"
                aria-hidden="false"><p>{{$service->description_type_document}}
                </p></div>


            @endforeach


        </div><!-- End contain -->

    </div><!-- End team -->

    <!--  ====================== End 4 columns  ====================== -->


</div>


@stop
