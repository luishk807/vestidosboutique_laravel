@extends("layouts.app")
@section('content')
    <style>
        .top_middle_sec_title2 .vesti-excla{
            font-size:10rem;
            font-family:"Playfair Display";
            font-weight: 500;
            vertical-align:bottom;
        
        }
        #brands_section .col:nth-child(2){
            text-align:center;
            top:50%;
        }
        #brands_section .brands_txt div:first-child{
            font-size:4rem;
            font-family:'Playfair Display';
            font-weight:700;
        }
        #brands_section .brands_txt div:last-child{
            font-size:2rem;
            font-family:'Playfair Display';
            font-weight:400;
        }
        .brands_txt > div{
            max-width:600px;
            margin-left: auto;
        }
        .brands_img img{
            display:none;
        }
        #brands_section{
            background-color: #dfdfe1;
            background-image:url("{{ asset('/images/home_main_img2.jpg') }}");
        }
        #quince_main .col:nth-child(2){
            text-align:center;
            top:50%;
        }
        #quince_main .quince_txt div:first-child{
            font-size:4rem;
            font-family:'Playfair Display';
            font-weight:700;
        }
        #quince_main .quince_txt div:last-child{
            font-size:2rem;
            font-family:'Playfair Display';
            font-weight:400;
        }
        #quince_main{
            background-color:white;
            background-image:url("{{ asset('/images/home_main_img3.jpg') }}");
        }
        .quince_img img{
            display:none;
        }
        .quince_txt > div{
            max-width:600px;
            margin-right: auto;
        }
        .main_slider_txt div{
            line-height:0.8;
            text-align:right;
        }
        .main_slider_txt span:nth-child(1){
            font-size:3rem;
        }
        .main_slider_txt span:nth-child(3){
            font-size:6rem;
        }
        /* .section > div{
            vertical-align:top;
        } */
        .vestidos-footer{
            padding-top:150px;
            padding-bottom:50px;
            font-family:Arial;
        }
        .vestidos-icons-payment,
        .vestidos-icons-social,
        .vestidos-icons-social-b{
            margin: 0px auto;
            display:inline-block;
            background-repeat:no-repeat;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            vertical-align:middle;
        }
        .vestidos-icons-payment{
            width: 50px;
            height: 50px;
            background-size: 50px 50px;
        }
        .vestidos-icons-social{
            width: 30px;
            height: 30px;
            background-size: 30px 30px;
        }
        .vestidos-icons-social-b{
            width: 30px;
            height: 23px;
            background-size: 30px 23px;
        }

        .vesti-footer-section-2{
            border-top:#a76e8a 1px solid;
        }
        .vesti-footer-section-2 div:first-child{
            border-right:#a76e8a 1px solid;
        }

        .vesti-footer-section-2 .text-right img{
            margin:10px 0px;
        }

        .quince-select-title{
            font-size:3rem;
            font-family:'Playfair Display';
            font-style:italic;
            font-weight:700;
        }
        #quince_selec_sec{
            margin:60px 0px 50px 0px;
        }
        .pos-f-t{
            position: fixed;
            z-index: 99999;
            width: 100%;
        }
    </style>
    <script type="text/javascript" src="{{ asset('js/fullpage/jquery.fullPage.js') }}"></script>
    <script type="text/javascript">
		$(document).ready(function() {
            var slideTimeout = null;
            function setSlider(){
                if(!slideTimeout){
                    slideTimeout = setInterval(function () {
                            $.fn.fullpage.moveSlideRight();
                    },5000);
                }
            }
            function initialization(){
                $('#fullpage').fullpage({
                    // scrollOverflow: true,
                    navigation: true,
                    responsiveWidth: 900,
                    menu: '.navbar',
                    afterRender: function () {
                        //on page load, start the slideshow
                        setSlider();
                    },
                    afterLoad: function(anchorLink, index){
                        //set slider when in slide 1
                        if (index == '1' && !slideTimeout) {
                            setSlider();
                        }
                    },
                    onLeave: function (index, direction) {
                        //remove slider when leaving
                        if (index == '1') {
                            clearInterval(slideTimeout);
                            slideTimeout =null;
                        }
                    }
                });
            }
            initialization();
            $(window).on("resize",function() {
                var win = $(this); //this = window
                if( win.width() >=400){
                    // initialization();
                   // $("#fullpage").css("margin-top","50px");
                //    $(".vestidos-main-nav").css("position","absolute");
                    $(".vestidos-main-nav-top").removeClass("show")
                    $("#main_slider_arrow_cont").css("display","block");
                    $("#brands_section").css("background-image","url('{{ asset('/images/home_main_img2.jpg') }}')");
                    $(".brands_img img").css("display","none");
                    $(".quince_img img").css("display","none");
                }else{
                   // $.fn.fullpage.destroy('all');
                 //  $("#fullpage").css("margin-top","0px");
                
                //  $(".vestidos-main-nav-top").css("position","fixed");
                //  $(".vestidos-main-nav").css("position","fixed");
                 $(".brands_img img").css("display","block");
                 $(".quince_img img").css("display","block");
                   $("#main_slider_arrow_cont").css("display","none");
                   $("#brands_section").css("background-image","none");
                   
                }
            });
            $("#main_slider_arrow_cont .main_arrow_slider_txt a").click(function(e){
                e.preventDefault();
                $.fn.fullpage.moveSectionDown();
            });
		});
    </script>
   <div id="fullpage">
        <div class="section" id="home_main_slider">
            <div id="main_slider_arrow_cont">
                    <div class="main_arrow_slider_txt">
                        Scroll Down<br/>
                        <a href=''></a>
                    </div>
            </div>
            <div class="slide playfair-display-black-italic" id="slide2">
               
            
                <div class="container">
                    <div class="row"  style="margin: 0px auto;">
                        <div class="col main_slider_txt">
                            <div style="margin-right:84px">
                                <div class="vesti_font_color_a">
                                    <span>Lorem Ipsum has?</span><br/>
                                    <span>2018</span>
                                </div>
                            </div>
                        </div>
                        <div class="col main_slider_btn">
                            <div>
                                <div class="vesti_font_color_a">Lorem Ipsum has?</div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="slide" id="slide1"><h1>Totally customizable</h1></div>
            <div class="slide" id="slide3"><h1>Totally customizable</h1></div>
        </div>
        <div class="section" id="top_middle_sec">
        <div class="intro">
                <div class="container">
                    <div class="row">
                        <div class="col top_middle_sec_title">
                            Top Dresses
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <a href="#" class="thumbnail">
                                <img src="{{asset('images/middle_1.jpg')}}" alt="model1">
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <a href="#" class="thumbnail">
                                <img src="{{asset('images/middle_2.jpg')}}" alt="model1">
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <a href="#" class="thumbnail">
                                <img src="{{asset('images/middle_3.jpg')}}" alt="model1">
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col top_middle_sec_title2">
                            <span class="vesti-excla vesti_font_color_b">"</span>I love how easy it was for me and my bridesmaids. The Dresses turned out perfect! Everyone was very comfortable and they looked amazing <span class="vesti-excla vesti_font_color_b">"</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="brands_section">
        <div class="intro">
                <div class="container">
                    <div class="row" style="margin: 0px auto;">
                        <div class="col brands_txt">
                            <div class="brands_img">
                                <img src="{{asset('images/home_main_img2_min.jpg')}}" alt="model1">
                            </div>
                            <div>
                                <div class="vesti_font_color_b">Lorem Ipsum has?</div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque condimentum elit justo, sed iaculis ipsum elementum eget. Nullam sed nibh justo. Maecenas sed enim at ante dignissim maximus quis eget elit</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="quince_main">
            <div class="intro">
                <div class="container">
                    <div class="row"  style="margin: 0px auto;">
                        <div class="col quince_txt">
                            <div class="quince_img">
                                <img src="{{asset('images/home_main_img2_min.jpg')}}" alt="model1">
                            </div>
                            <div>
                                <div class="vesti_font_color_b">Lorem Ipsum has?</div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque condimentum elit justo, sed iaculis ipsum elementum eget. Nullam sed nibh justo. Maecenas sed enim at ante dignissim maximus quis eget elit</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="quince_selec_sec">
            <div class="intro">
                <div class="container">
                    <div class="row">
                         <div class="col quince-select-title vesti_font_color_b text-center">Top Quinceanera Dresses</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mt-4 col-md-4">
                           <a href='' class="thumbnail"><img style="width:100%" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                        </div>
                        <div class="col-sm-6 mt-4 col-md-4">
                           <a href='' class="thumbnail"><img style="width:100%" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                        </div>
                        <div class="col-sm-6 mt-4 col-md-4">
                           <a href='' class="thumbnail"><img style="width:100%" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                        </div>
                        <div class="col-sm-6 mt-4 col-md-4">
                           <a href='' class="thumbnail"><img style="width:100%" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                        </div>
                        <div class="col-sm-6 mt-4 col-md-4">
                           <a href='' class="thumbnail"><img style="width:100%" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                        </div>
                        <div class="col-sm-6 mt-4 col-md-4">
                           <a href='' class="thumbnail"><img style="width:100%" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section vestidos-footer fp-auto-height vest-maincolor">
            <div class="intro footer">
                
            

                <div class="container">
                    <div class="row vesti-footer-section-1">
                        <div class="col-md-4  text-center">
                            Vestidos Boutique
                        </div>

                        <div class="col-md-8  text-center">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 text-center">
                                        <ul class="list-unstyled">
                                            <li>About Us</li>
                                            <li>Contact Us</li>
                                            <li>Faqs</li>
                                            <li>Terms of Use</li>
                                            <li>Privacy</li>
                                        </ul>

                                    </div>
                                    <div class="col-md-6 text-center">
                                        <ul class="list-unstyled">
                                            <li>Got Questions? Call Us</li>
                                            <li>PHONE: +507 203-5848</li>
                                            <li>EMAIL: info@vestidosboutique.com</li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row vesti-footer-section-2">
                        <div class="col-md-4 text-center">
                            We Accept:
                            <img src="/images/cc-visa.svg" class="vestidos-icons-payment"/>
                            <img src="/images/cc-master.svg" class="vestidos-icons-payment"/>
                            <img src="/images/cc-amex.svg" class="vestidos-icons-payment"/>
                            <img src="/images/cc-discover.svg" class="vestidos-icons-payment"/>
                        </div>

                        <div class="col-md-4 text-center">
                            <img src="/images/social-facebook.svg" class="vestidos-icons-social-b"/>
                            <img src="/images/social-instagram.svg" class="vestidos-icons-social"/>
                            <img src="/images/social-twitter.svg" class="vestidos-icons-social"/>
                            <img src="/images/social-pinterest.svg" class="vestidos-icons-social"/>
                        </div>
                    </div>
                </div>

            </div>
        </div>
  </div>
@endsection