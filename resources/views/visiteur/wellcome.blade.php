@extends('visiteur.layoutvisiteur')

@section('content')

    @php
        use App\Http\Controllers\Front\ContenuSiteWebController;use App\Http\Controllers\ProduitController;use App\Http\Controllers\ServiceController;

        $produits = ProduitController::get();
        $services = ServiceController::get();
        //$actualites = ActualiteController::getdata();
        $actualites = ContenuSiteWebController::getdata_article('actualite');
        $sliders = ContenuSiteWebController::getdata_slider();
    @endphp

    <style>
        .more {
            display: none;
        }
    </style>
    <div class="slider-1 clearfix">

        <div class="flex-container">
            <div class="flexslider loading" style="width: 70%;margin-left: 15%;">
                <ul class="slides">

                    <?php
                    /*

                           <li style="background:url(images/img/sliders/slider-1/slider-bg-1.jpg) no-repeat;background-position:50% 0">

                            <div class="container">
                            <div class="sixteen columns contain">

                              <h2 data-toptitle="20%">Passport, pieces d'identite, Extraits de Naissance, Obtenez tous vos documents administratif en ligne</h2>
                              <p data-bottomtext="39%">
                               Tout étranger doit, pour entrer en République de Guinée être titulaire d'un passeport ou
                               d'un titre de voyage en tenant lieu et en cours de validité, revêtu d'un visa.
                              </p>
                              <div class="links" data-bottomlinks="20%">
                                <a href="#" class="button medium color">Prendre Rendez-vous <i class="icon-home"></i></a>
                              </div>

                              <img src="imgg/bg1.png" class="item"  data-topimage="16%"/>

                            </div>
                          </div><!-- End Container -->

                           </li><!-- End item -->



                           <li style="background:url(images/img/sliders/slider-1/slider-bg-3.jpg) no-repeat; background-position:50% 0">

                           <div class="container">
                            <div class="sixteen columns contain">

                              <h2 data-toptitle="20%">Une Demande en ligne, Un rendez-vous et une livraison</h2>
                              <p data-bottomtext="39%">
                              Vous souhaitez consulter un document administratif, par exemple un certificat d'urbanisme ou un dossier
                              administratif ? Nous nous en occupons
                              </p>
                              <div class="links" data-bottomlinks="20%">
                                <a href="#" class="button medium color">Prendre Rendez-vous <i class="icon-home"></i></a>
                              </div>

                              <img src="imgg/passport.png" class="item" data-topimage="8%"/>

                            </div>
                          </div><!-- End Container -->

                          </li><!-- End item -->




                         <li style="background:url(imgg/sl4.jpg) no-repeat; background-position:50% 0">
                           <div class="container">
                            <div class="sixteen columns contain">

                              <h2 data-toptitle="20%" style="color:black">Faire la demande de document administratif n'a jamais ete aussi simple</h2>
                              <p data-bottomtext="39%" style="color:black">
                              Adressez-vous à l'administration en remplissant en un clique 2lgne de formulaire et c'est tout :</p>
                              <div class="links" data-bottomlinks="20%">
                                <a href="#" class="button medium color">Prendre Rendez-vous <i class="icon-home"></i></a>
                              </div>

                              <img src="imgg/sl6-rmbg.png" class="item" data-topimage="9%"/>

                            </div>
                          </div><!-- End Container -->

                          </li><!-- End item -->


                          <li style="background:url(images/img/sliders/slider-1/slider-bg-2.jpg) no-repeat; background-position:50% 0">
                           <div class="container">
                            <div class="sixteen columns contain">

                              <h2 data-toptitle="20%">Rectifier simplement les erreurs de frappe de vos documents administratifs</h2>
                              <p data-bottomtext="39%">
                              Le téléservice de l'ONI vous assistera en un bref delai</p>
                              <div class="links" data-bottomlinks="20%">
                                <a href="#" class="button medium color">Prendre Rendez-vous <i class="icon-home"></i></a>
                              </div>

                  <img src="imgg/sl7-rmbg.png" class="item" data-topimage="9%"/>

                            </div>
                          </div><!-- End Container -->

                          </li><!-- End item -->


                          <li style="background:url(images/img/sliders/slider-1/slider-bg-3.jpg) no-repeat; background-position:50% 0">

                           <div class="container">
                            <div class="sixteen columns contain">

                              <h2 data-toptitle="20%">Document concernant une personne tierce ? Pas de probleme</h2>
                              <p data-bottomtext="39%">
                              Vous etes son mandaire avec document prerequis a l'appui, alors le document est communicable si l'administration peut préserver la confidentialité des informations en masquant les informations personnelles.</p>
                              <div class="links" data-bottomlinks="20%">
                                <a href="#" class="button medium normal">En savoir plus</a>
                                <a href="#" class="button medium color">Prendre Rendez-vous <i class="icon-home"></i></a>
                              </div>

                  <img src="imgg/sl8.png" class="item" data-topimage="9%"/>

                            </div>
                          </div><!-- End Container -->

                          </li><!-- End item -->



                          // Provides: <body text='black'>
                 $bodytag = str_replace("%body%", "black", "<body text='%body%'>");
                          */
                    ?>

                    @foreach( $sliders as $slider )

                        <li style="background:url({{$slider->imagebg}}) no-repeat; background-position:50% 0">

                            <div class="container">
                                <div class="sixteen columns contain">
                                    @php
                                        //dd($sliders);
                                        if( $slider->couleur == "#fff" ){
                                                $styleColor = "";
                                        }
                                        else{
                                                $styleColor = 'style="color:'.$slider->couleur.'"';
                                        }
                                    @endphp
                                    <h2 data-toptitle="20%" {{$styleColor}} >{{$slider->titre}}</h2>
                                    <p data-bottomtext="39%" {{$styleColor}} >{{$slider->paragraphe1}}</p>
                                    <div class="links" data-bottomlinks="20%">
                                        @if( $slider->boutton == "oui" )
                                            <a href="#" class="button medium normal">En savoir plus</a>
                                        @endif
                                        <a href="/seLoguer" class="button medium color">Prendre Rendez-vous <i
                                                class="icon-home"></i></a>
                                    </div>

                                    <img src="{{$slider->image}}" class="item" data-topimage="9%"/>

                                </div>
                            </div><!-- End Container -->

                        </li><!-- End item -->

                    @endforeach


                </ul>
            </div>
        </div>

    </div><!-- End slider -->


    <style>

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


        /*9.6412 -13.5784*/


        @import url('https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap');
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .waviy {
            position: relative;
            -webkit-box-reflect: below -20px linear-gradient(transparent, rgba(0, 0, 0, .2));
            font-size: 25px;
        }

        .waviy span {
            font-family: 'Alfa Slab One', cursive;
            position: relative;
            display: inline-block;
            color: #fff;
            text-transform: uppercase;
            animation: waviy 1s infinite;
            animation-delay: calc(.1s * var(--i));

        }

        @keyframes waviy {
            0%, 40%, 100% {
                transform: translateY(0)
            }
            20% {
                transform: translateY(-10px)
            }
        }


    </style>



    <div class="services style-1 home bottom-3">
        <div class="container clearfix" style="text-align:center">


            <form method="POST" action="/suivreMesDocuments">
                @csrf

                <div class="waviy" style="color:black">
                    <h3 class="el-radio is-bordered" style="display:inline;color:#ffc107;font-weight:normal">Verifier le
                        statut de votre Document</h3>

                    <?php
                    /*
                       <span style="--i:1;color:black">D</span>
                       <span style="--i:2;color:black">O</span>
                       <span style="--i:3;color:black">C</span>
                       <span style="--i:4;color:black">u</span>
                       <span style="--i:5;color:black">M</span>
                       <span style="--i:6;color:black">E</span>
                       <span style="--i:7;color:black">N</span>
                       <span style="--i:8;color:black">T</span>
                    */
                    ?>
                </div>
                <input styte="width:80%;max-width:500px" name="code_demande" type="search" id="form1"
                       class="form-control" placeholder="Code Demande (recu par sms ou par email)"/>
                <input type="hidden" name="view" value="control"/>


                <button type="submit"><a class="button medium color">Verifier <i class="icon-search"></i></a></button>
            </form>

        </div><!-- End Container -->
    </div><!-- End services -->






    <!-- Start main content -->
    <div class="container main-content clearfix">


        <div class="sixteen columns">
            <hr class="line bottom-3">
        </div><!-- End line -->

        <div class="latest-blog clearfix bottom-1">

            <div class="slidewrap2">

                <div class="sixteen columns">
                    <h3 class="title bottom-2" style="color:#008f5d">Nos Produits et services <a href="#"
                                                                                                 class="more black"
                                                                                                 style="color:green">+</a>
                    </h3>
                </div>

                <ul class="slider" id="sliderName2">

                    <style>
                        .eltproduit {
                            border: 1px solid aqua;
                            border-radius: 10px;
                            padding: 5px;
                            background: #008f5d;
                            color: White;
                            width: 250px;
                        }

                        .latest-blog .item p {
                            color: #fff;
                        }

                        .slidecontrols li a.carousel1-next, .slidecontrols li a.carousel1-prev, .slidecontrols li a.carousel2-next, .slidecontrols li a.carousel2-prev, .slidecontrols li a.carousel3-next, .slidecontrols li a.carousel3-prev, .slidecontrols li a.carousel4-next, .slidecontrols li a.carousel4-prev, .more {
                            background: #dc3545;
                        }
                    </style>

                    <li class="slide">

                        <style>
                            .newbt:hover {
                                opacity: 0.7
                            }
                        </style>

                        @foreach ( $produits as $produit )
                            <!-- item -->
                            <div class="one-third column item eltproduit" style="max-width:100%;width: 200px;">
                                <a href="#">
                                    <img src="{{$produit->image_type_document}}" alt="" class="pic"/>
                                </a>
                                <h3><a href="#">{{mb_strimwidth(strip_tags($produit->nom_type_document), 0, 20)}}</a>
                                </h3>
                                <p>{{mb_strimwidth(strip_tags($produit->description_type_document), 0, 80)}}..</p>

                                <p style="text-align:center">
                                    <a style="padding: 15px 0px;width:100%;font-size:20px;background:#ffc107;color:#000;font-size:10px"
                                       href="/product" class="newbt button medium color">
                                        En savoir plus
                                        <svg aria-hidden="true"
                                             class="SVGInline-svg SVGInline--cleaned-svg SVG-svg Icon-svg Icon--arrowRight-svg Button-icon-svg Icon-color-svg Icon-color--white-svg"
                                             height="12" width="12" viewBox="0 0 16 16"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.583 7 7.992 2.409A1 1 0 1 1 9.407.993l6.3 6.3a1 1 0 0 1 0 1.414l-6.3 6.3a1 1 0 0 1-1.415-1.416L12.583 9H1a1 1 0 1 1 0-2z"
                                                fill-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </p>

                            </div>
                            <!-- End -->
                        @endforeach


                        @foreach ( $services as $service )
                            <!-- item -->
                            <div class="one-third column item eltproduit" style="max-width:100%;width: 200px;">
                                <a href="#">
                                    <img style="height:150px" src="{{$service->image_type_document}}" alt=""
                                         class="pic"/>
                                </a>
                                <h3 style="font-size:17px"><a
                                        href="#">{{mb_strimwidth(strip_tags($service->nom_type_document), 0, 20)}}</a>
                                </h3>
                                <p>{{mb_strimwidth(strip_tags($service->description_type_document), 0, 80)}}..</p>

                                @php
                                    @endphp

                                <p style="text-align:center">
                                    <a style="padding: 15px 0px;width:100%;font-size:20px;background:#fff;color:#000;font-size:10px"
                                       href="/service" class=" button medium color">En savoir plus <i
                                            class="icon-plus"></i> </a>
                                </p>

                            </div>
                            <!-- End -->
                        @endforeach


                    </li><!-- End slide -->

                </ul>

            </div><!-- End slidewrap -->

        </div><!-- End latest-blog -->


        <div class="sixteen columns">
            <hr class="line bottom-3">
        </div><!-- End line -->


        <div class="latest-blog clearfix bottom-1">

            <div class="slidewrap2">

                <div class="sixteen columns">
                    <h3 class="title bottom-2" style="cxolor:#008f5d">Actualites <a href="#" class="more black"
                                                                                    style="color:green">+</a></h3>
                </div>

                <ul class="slider" id="sliderName2">
                    @php
                        $compteur_actualite = 0;
                    @endphp

                    @foreach ( $actualites as $actualite )
                        <!-- item -->
                        <div class="one-third column item eltproduit"
                             style="background:#fff;max-width:100%;width: 200px;border:1px solid #717171; box-shadow: 0px 0px 10px #717171">
                            <a href="#">
                                <img style="height:150px" src="{{$actualite->image}}" alt="" class="pic"/>
                            </a>
                            <h3 style="font-size:17px;"><a href="#" style="color:#000">{{$actualite->titre}}</a></h3>
                            <p style="color:#000">{{mb_strimwidth(strip_tags($actualite->paragraphe1), 0, 100)}}...</p>

                            <p style="text-align:center">
                                <a style="padding: 15px 0px;width:100%;font-size:20px;background:#008f5d;color:#fff;font-size:10px"
                                   href="/actualite/{{$actualite->id}}" class=" button medium color">lire article <i
                                        class="icon-plus"></i> </a>
                            </p>

                        </div>
                        <!-- End -->
                        @php
                            $compteur_actualite++;
                            if( $compteur_actualite == 4 )break;
                        @endphp
                        @endforeach

                        </li><!-- End slide -->

                </ul>
            </div>
        </div>

        <div class="sixteen columns">
            <hr class="line bottom-3">
        </div><!-- End line -->


        <div class="featured-clients clearfix bottom-2">

            <div class="slidewrap4">


                <style>
                    .container .four.columns {
                        width: 100px;
                    }
                </style>

                <div class="sixteen columns">
                    <h3 class="title bottom-2">Nos Partenaires</h3>
                </div>

                {{-- <ul class="slider" id="sliderName4" style="text-align:center" >
                  <li class="slide">
                   <div class="four columns item" style="height:100px;text-align:center;margin-left:0px;margin-right:0px;" > <a href="#"><img  class="partenair" src="imgg/p0.jpg" alt="" /></a> </div>
                   <div class="four columns item" style="height:100px;text-align:center;margin-left:0px;margin-right:0px;"> <a href="#"><img  class="partenair" src="imgg/p1.jpg" alt="" /></a> </div>
                   <div class="four columns item" style="height:100px;text-align:center;margin-left:0px;margin-right:0px;"> <a href="#"><img  class="partenair" src="imgg/p2.jpg" alt="" /></a> </div>
                   <div class="four columns item" style="height:100px;text-align:center;margin-left:0px;margin-right:0px;"> <a href="#"><img  class="partenair" src="imgg/p3.jpg" alt="" /></a> </div>
                   <div class="four columns item" style="height:100px;text-align:center;margin-left:0px;margin-right:0px;"> <a href="#"><img  class="partenair" src="imgg/p5.jpg" alt="" /></a> </div>
                   <div class="four columns item" style="height:100px;text-align:center;margin-left:0px;margin-right:0px;"> <a href="#"><img  class="partenair" src="imgg/p4.jpg" alt="" /></a> </div>
                   <div class="four columns item" style="height:100px;text-align:center;margin-left:0px;margin-right:0px;"> <a href="#"><img  class="partenair" src="imgg/p8.jpg" alt="" /></a> </div>
                  </li><!-- End slide -->
                </ul> --}}
                <ul class="slick-slider">
                    <li><img class="partners" width="100px;" src="imgg/p0.jpg" alt=""/></li>
                    <li><img class="partners" width="100px;" src="imgg/p0.jpg" alt=""/></li>
                    <li><img class="partners" width="100px;" src="imgg/p0.jpg" alt=""/></li>
                    <li><img class="partners" width="100px;" src="imgg/p0.jpg" alt=""/></li>
                    <li><img class="partners" width="100px;" src="imgg/p0.jpg" alt=""/></li>
                </ul>
            </div><!-- End slidewrap -->

        </div><!-- End features-clients -->

    </div><!-- <<< End Container >>> -->

@stop
