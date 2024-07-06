@php
    use App\Http\Controllers\ProduitController;
    $produits = ProduitController::get();
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

        .form-control {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
        }

        @media (min-width: 576px)
            .col-sm-10 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 83.333333%;
                flex: 0 0 83.333333%;
                max-width: 83.333333%;
            }

            .col-form-label {
                padding-top: calc(.375rem + 1px);
                padding-bottom: calc(.375rem + 1px);
                margin-bottom: 0;
                font-size: inherit;
                line-height: 1.5;
            }

            @media (min-width: 576px)
                .col-sm-2 {
                    -webkit-box-flex: 0;
                    -ms-flex: 0 0 16.666667%;
                    flex: 0 0 16.666667%;
                    max-width: 16.666667%;
                }

                .form-group {
                    margin-bottom: 1rem;
                }

    </style>



    @if( !isset($document1) )

        <div class="page-title" style=";background-color:#008f5d;">
            <div class="container clearfix">

                <div class="sixteen columns" style="background-image: url(/imgg/passeportbg.png)">
                    <h1>Prendre un rendez-vous</h1>
                </div>

            </div><!-- End Container -->
        </div>


        <div class="container main-content clearfix">


            <div class="clearfix"></div>


            <div class="team columns-4">

                <style>
                    .services.style-1 .item.active .circle, .services.style-1 .item:hover .circle, .more:hover, .subscribe input.submit, #menu > a, .page-title, .accordion h4.ui-state-active, .accordion.style2 h4.ui-state-active .icon-plus, .accordion.style2 h4.ui-state-active .icon-minus, .meter > span::after, .animate > span > span, .button.black:hover, #horizontal-tabs.style2 ul.tabs li.current, #vertical-tabs.style2 ul.tabs li.current, #horizontal-tabs.style2 ul.tabs li:hover, #vertical-tabs.style2 ul.tabs li:hover, #toggle-view li h4.color, .highlight-color, .dropcap.color, .pagination a.next-button:hover, .pagination a.prev-button:hover, .pagination a:hover, .pagination a.current, table.style.color th, .meter .meter-content, .team .item .member-social a:hover, .services.style-2 .item .circle, .services.style-2 .item.active:hover .circle, .services.style-3 .item.active .circle, .services.style-3 .item:hover .circle, .tables-column .footer h4 a:hover, .tables-column.color .header h3, .tables-column.color .footer h4 a, .tables-column .header h3 span.pop, .share-social a:hover, .popular-tags a:hover, .widget .followers li a:hover, body.under-construction #wrap.boxed, body.under-construction .content input.subscribe-button, .flex-control-nav li a.flex-active, .flex-control-nav li a:hover, header.style-4 .top-bar, html.ie.ie8 .img-caption, html.ie.ie8 .fancybox-title-float-wrap .child, .slide-bg-color {
                        background: #ffc107;
                    }


                    /* HIDE RADIO */
                    label {
                        display: inline-block
                    }

                    label > input { /* HIDE RADIO */
                        visibility: hidden; /* Makes input not-clickable */
                        position: absolute; /* Remove input from document flow */
                    }

                    label > input + img { /* IMAGE STYLES */
                        cursor: pointer;
                        border: 8px solid transparent;
                        transition: 0.3s;
                        border-radius: 20px;
                    }

                    label:hover > input + img { /* IMAGE STYLES */
                        cursor: pointer;
                        border: 8px solid #ffc107;
                        border-radius: 20px;
                    }

                    label > input:checked + img { /* (RADIO CHECKED) IMAGE STYLES */
                        border: 8px solid #008f5d;
                        transition: 0.5s;
                    }

                </style>

                <div class="eight columns bottom-3" style="width:100%">


                    <span
                        style="background:#ffc107;padding:5px;font-size;color:#fff;font-weight:bold;">Etape 1</span><br><br>
                    <h4>Selectionner le type de document</h4>


                    <div style="margin-top:30px">
                        <form method="POST" action="/rdv2" enctype='multipart/form-data'
                              onsubmit="return ValidationEvent()">
                            @csrf
                            @foreach( $produits as $produit )

                                <label class="layersMenu">
                                    <input type="radio" id="radioZoom18" name="id_type_document"
                                           value="{{$produit->id_type_document}}" onclick="handleClick(this);"/>
                                    <img src="{{$produit->image_type_document}}" width="180">
                                    <div
                                        style='text-align:center;font-weight:bold'>{{$produit->nom_type_document}}</div>
                                </label>

                            @endforeach

                            <style>
                                #passport, #visa, #titresejour, #carteindentite, #formulaire {
                                    display: none;
                                }
                            </style>

                            <div id="passport" style="margin-top:40px;bborder-top:1px solid gray;">

                                <span style="background:#ffc107;padding:5px;font-size;color:#fff;font-weight:bold;">Etape 2</span><br><br>
                                <h4>Selectionner le type de service</h4>

                                <label class="layersMenu">
                                    <input type="radio" id="radioZoom18" name="type_service_passport"
                                           value="passport_ordinaire" onclick="handleClick2(this);"/>
                                    <img src="imgg/passeportbg.png" width="180">
                                    <div>Passport ordinaire</div>
                                </label>


                                <label class="layersMenu">
                                    <input type="radio" id="radioZoom18" name="type_service_passport" value="vip"
                                           onclick="handleClick2(this);"/>
                                    <img src="imgg/vip.svg" width="180">
                                    <div>VIP</div>
                                </label>

                                <label class="layersMenu">
                                    <input type="radio" id="radioZoom18" name="type_service_passport"
                                           value="evacuation_sanitaire" onclick="handleClick2(this);"/>
                                    <img src="imgg/evacuation.png" width="180">
                                    <div>Evacuation sanitaire</div>
                                </label>


                            </div>

                            <div id="visa">
                            </div>

                            <div id="titresejour">
                            </div>

                            <div id="carteindentite">
                            </div>


                            <div id="formulaire">


                                <div class="eight columns bottom-3" style="width:100%;margin-top:40px">
                                    <span style="background:#ffc107;padding:5px;font-size;color:#fff;font-weight:bold;">Etape 3</span><br><br>
                                    <h4>fournir vos informations</h4>

                                    <div id="horizontal-tabs" class="two style2">

                                        <ul class="tabs">
                                            <li id="tab_two1" style="background:#008f5d" class="current">Pas encore
                                                enregistrer
                                            </li>
                                            <li id="tab_two2" style="background:#4f4f4f">Deja enregistrer</li>
                                        </ul>
                                        <div class="contents">

                                            <div id="content_two1" class="tabscontent"
                                                 style="display: block; background:#ececec;border:4px solid #008f5d;text-align:center">
                                                <p>


                                                    <span>Type de demande</span><br>
                                                    <select id="type_de_demande" name="type_de_demande" class="myform">
                                                        <option value="nouvelle_demande">nouvelle demande</option>
                                                        <option value="duplicata">duplicata</option>
                                                        <option value="renouvelement">renouvelement</option>
                                                    </select>

                                                    <br><br>

                                                    <span>Genre</span><br>
                                                    <select name="genre" class="myform">
                                                        <option value="homme">Genre : homme</option>
                                                        <option value="femme">Genre : femme</option>
                                                    </select>
                                                    <br>

                                                    <span>Nom</span><br>
                                                    <input id="nom" name="nom" placeholder="nom" class="myform">
                                                    <br>

                                                    <span>Prenom</span><br>
                                                    <input id="prenom" name="prenom" placeholder="prenom"
                                                           class="myform">
                                                    <br>

                                                    <span>Email</span><br>
                                                    <input id="email" name="email" placeholder="email" class="myform">
                                                    <br>

                                                    <span>Telephone</span><br>
                                                    <input id="telephone" name="telephone" placeholder="telephone"
                                                           class="myform">
                                                    <br>

                                                    <span id="labelrz">Date de naissance</span><br>
                                                    <input id="date_naissance" name="date_naissance" type="date"
                                                           class="myform">
                                                    <br>


                                                    <span id="labelrz">Lieu de residence </span><br>
                                                    <input id="lieu_de_residence" name="lieu_de_residence"
                                                           placeholder="lieu de residence" class="myform">
                                                    <br>


                                            </div>


                                            <div id="content_two2" class="tabscontent"
                                                 style="display: none;background:#ececec;border:4px solid #4f4f4f;text-align:center">
                                                <p>
                                                    <span id="labelrz">Identifiant Louba Service </span><br>
                                                    <input style="border:2px solid #4f4f4f" id="code_oni"
                                                           name="code_oni" placeholder="identifiant ONI" type="password"
                                                           class="myform">
                                                </p>
                                            </div>


                                        </div><!-- End contents -->

                                    </div><!-- End horizontal-tabs -->

                                </div>


                                <input name="document1" type="file" class="myform" required>
                                <input name="document2" type="file" class="myform" required>

                                <hr>


                                <hr>
                                <input value="suivant"
                                       style="padding: 12px 15px;border:none;color:#fff;background:green" type="submit"
                                       required>


                            </div>


                            <script>
                                var currentValue = 0;

                                function handleClick(myRadioProduit) {
                                    //alert('Old value: ' + currentValue);
                                    //alert('New value: ' + myRadioProduit.value);
                                    if (myRadioProduit.value == 1) {
                                        document.getElementById('passport').style.display = "block";
                                        document.getElementById('visa').style.display = "none";
                                        document.getElementById('titresejour').style.display = "none";
                                        document.getElementById('carteindentite').style.display = "none";
                                    }

                                    if (myRadioProduit.value == 2) {
                                        document.getElementById('formulaire').style.display = "block";
                                        document.getElementById('passport').style.display = "none";
                                        document.getElementById('visa').style.display = "block";
                                        document.getElementById('titresejour').style.display = "none";
                                        document.getElementById('carteindentite').style.display = "none";
                                    }

                                    if (myRadioProduit.value == 3) {
                                        document.getElementById('formulaire').style.display = "block";
                                        document.getElementById('passport').style.display = "none";
                                        document.getElementById('visa').style.display = "none";
                                        document.getElementById('titresejour').style.display = "block";
                                        document.getElementById('carteindentite').style.display = "none";
                                    }

                                    if (myRadioProduit.value == 4) {
                                        document.getElementById('formulaire').style.display = "block";
                                        document.getElementById('passport').style.display = "none";
                                        document.getElementById('visa').style.display = "none";
                                        document.getElementById('titresejour').style.display = "none";
                                        document.getElementById('carteindentite').style.display = "block";
                                    }
                                }


                                function handleClick2(myRadioProduit) {
                                    //alert('Old value: ' + currentValue);
                                    //alert('New value: ' + myRadioProduit.value);
                                    document.getElementById('formulaire').style.display = "block";
                                    if (myRadioProduit.value == "passport_ordinaire") {
                                        document.getElementById('passport_ordinaire').style.display = "block";
                                        document.getElementById('vip').style.display = "none";
                                        document.getElementById('evacuation_sanitaire').style.display = "none";

                                    }

                                    if (myRadioProduit.value == "vip") {
                                        document.getElementById('passport_ordinaire').style.display = "none";
                                        document.getElementById('vip').style.display = "block";
                                        document.getElementById('evacuation_sanitaire').style.display = "none";

                                    }

                                    if (myRadioProduit.value == "evacuation_sanitaire") {
                                        document.getElementById('passport_ordinaire').style.display = "none";
                                        document.getElementById('vip').style.display = "none";
                                        document.getElementById('evacuation_sanitaire').style.display = "block";
                                    }


                                }

                            </script>


                        </form>


                        <script>
                            function ValidationEvent() {

                                var nom = document.getElementById("nom").value;
                                var prenom = document.getElementById("prenom").value;
                                var email = document.getElementById("email").value;
                                var telephone = document.getElementById("telephone").value;
                                var date_naissance = document.getElementById("date_naissance").value;
                                var lieu_de_residence = document.getElementById("lieu_de_residence").value;

                                var code_oni = document.getElementById("code_oni").value;


                                if (code_oni != "") {
                                    return true;
                                } else {
                                    if ([nom, prenom, email, telephone, date_naissance, lieu_de_residence].includes("")) {
                                        alert("Veuillez remplir tout les champs")
                                        return false
                                    } else {
                                        return true;
                                    }
                                }

                            }
                        </script>


                    </div>


                    <div id="content_two3" class="tabscontent">

                    </div>

                </div><!-- End contents -->

            </div><!-- End horizontal-tabs -->

        </div>









        </div><!-- End team -->

        <!--  ====================== End 4 columns  ====================== -->




        </div>

    @endif



    @if( isset($document1) )
        @include('visiteur.rdv2')
    @endif


    @php
        if( isset($code_oni) )
        {
            echo "<script> alert('Indentifiant Louba service non trouver, veuillez ressayer') </script>";
        }
    @endphp

@stop
