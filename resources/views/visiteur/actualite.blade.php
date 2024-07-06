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
                <h1>Actualite</h1>
            </div>

        </div><!-- End Container -->
    </div>








    <div class="container main-content clearfix">

        <div class="blog-3 bottom-2 top-1">

            <div id="contain" style="position: relative; overflow: hidden; height: 1542px;" class="isotope">


                @foreach( $actualites as $actualite )
                    <!-- ==================== Post ==================== -->
                    <div class="one-third column item  Web isotope-item" data-categories="Web"
                         style="position: absolute; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px);">
                        <div class="contain">

                            <div class="image-post">
                                <a href="/actualite/{{$actualite->id}}"><img src="{{$actualite->image}}" </a>
                            </div><!-- End slider image-post -->

                            <div class="data">
                                <a href="/actualite/{{$actualite->id}}" class="title">{{$actualite->titre}}</a>
                                <!-- Title Post -->
                                <div class="post-meta">
                                    <div class="meta"><i class="icon-time"></i> {{$actualite->date_mise_a_jour}} </div>
                                    <!-- Date -->
                                    <div class="meta"><i class="icon-tags"></i> <a href="#">Actualites</a></div>
                                    <!-- Category -->
                                </div><!-- End post-meta -->
                                <div class="post-content">
                                    <p>
                                        {{mb_strimwidth(strip_tags($actualite->paragraphe1), 0, 50)}}...
                                        <a href="/actualite/{{$actualite->id}}">Lire article</a>
                                    </p>
                                </div><!-- End post-content -->
                            </div><!-- End data -->

                        </div><!-- End contain -->
                    </div>
                    <!-- ==================== End  ==================== -->
                @endforeach


            </div><!-- End contain-->


            <!-- Start Pagination -->
            <div class="pagination-contain top-3" style="display:none">
                <div class="pagination">
                    <a href="#" class="prev-button"><i class="icon-angle-left"></i></a>
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#" class="current">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a>...</a>
                    <a href="#">11</a>
                    <a href="#">12</a>
                    <a href="#">13</a>
                    <a href="#" class="next-button"><i class="icon-angle-right"></i></a>
                </div>
            </div>
            <!-- End pagination -->


        </div><!-- End blog-3 -->

    </div>














    <div class="container main-content clearfix" style="display:none">

        <!-- Start Posts -->
        <div class="eleven columns bottom-3" style="width:100%">


            @php
                /*


                <!-- ==================== Post ==================== -->
                 <div class="post style-1 bottom-2">

                 <h3 class="title bottom-1" id="actu{{$actualite->id}}"><a href="#">{{$actualite->titre}}</a></h3><!-- Title Post -->

                 <div class="image-post">

                   <div class="flex-container">{{$actualite->titre}}
                    <div class="">

                    <div class="flex-viewport" style="overflow: hidden; position: relative;"></div>

                    <div class="flex-viewport" style="overflow: hidden; position: relative;">
                    <a href="#"><img src="images/img/blog/single/image-1-2.jpg"></a>
                     </div>

                     </div>





                   </div>

                 </div><!-- End slider image-post -->

                 <div class="post-meta bottom-1">
                   <div class="meta"><i class="icon-time"></i> {{$actualite->date_register}} </div><!-- Date -->
                   <div class="meta"><i class="icon-user"></i> <a href="#">ONI</a> </div><!-- Author -->
                 </div><!-- End post-meta -->

                 <div class="post-content">
                   <p>
                     {{$actualite->texte}}
                   </p>
                 </div><!-- End post-content -->

                </div>
                <!-- ==================== End  ==================== -->


                */
            @endphp








                <!-- Start Pagination -->
            <div class="pagination" style="display:none">
                <a href="#" class="prev-button"><i class="icon-angle-left"></i></a>
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#" class="current">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a>...</a>
                <a href="#">11</a>
                <a href="#">12</a>
                <a href="#">13</a>
                <a href="#" class="next-button"><i class="icon-angle-right"></i></a>
            </div>
            <!-- End pagination -->

        </div><!-- End Posts -->


        <!-- Start Sidebar Widgets -->
        <!-- End Sidebar Widgets -->

        <div class="clearfix"></div>

    </div>

@stop
