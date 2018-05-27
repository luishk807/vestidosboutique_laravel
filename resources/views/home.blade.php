@extends("layouts.app")
@section('content')
    <style>
    #home_main_slider #main_slider_arrow_cont{
        position:absolute;
        bottom:5%;
        left:50%;
        right:0;
        z-index:999;
        width:100%;
    }
    .main_slider_txt{
        width: 200px;
        text-align: center;
        font-family:Arial;
        color:white;
        font-size:1.5rem;
        line-height:1rem;
    }
    #home_main_slider #main_slider_arrow_cont .main_slider_txt a{
        margin: 0px auto;
        display:block;
        width: 100px;
        height: 100px;
        background-image: url("{{ asset('images/ves-down-arrow.svg') }}");
        background-repeat:no-repeat;
        background-size: 100px 100px;
        text-indent: 100%;
        white-space: nowrap;
        overflow: hidden;
    }
    </style>
    <script type="text/javascript" src="{{ asset('js/fullpage/jquery.fullPage.js') }}"></script>
    <script type="text/javascript">
		$(document).ready(function() {
			$('#fullpage').fullpage({
				verticalCentered: false
			});
		});
    </script>
   <div id="fullpage">
        <div class="section" id="home_main_slider">
            <div id="main_slider_arrow_cont">
                    <div class="main_slider_txt">
                        Scroll Down<br/>
                        <a href=''></a>
                    </div>
            </div>
            <div class="slide playfair-display-black-italic" id="slide1">
                <h1>Slide Backgrounds</h1>
            </div>
            <div class="slide" id="slide2"><h1>Totally customizable</h1></div>
        </div>
        <div class="section " id="top_middle_sec">
        <div class="slide">
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
                            I love how easy it was for me and my bridesmaids. The Dresses turned out perfect! Everyone was very comfortable and they looked amazing
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="brands_section">
            <div class="slide">
                <div class="container home_w100">
                    <div class="row gray_bg">
                        <div class="col home_bg_2">
                            <h1>Brands</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h1>Brands</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="quince_main">
            <div class="slide" id="slide3">
                <div class="container home_w100">
                    <div class="row">
                        <div class="col home_bg_3">
                            <h1>Brands</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="quince_selec_sec">
            <div class="slide">
                <div class="container" id="vestidos-quince-top">
                    <div class="row">
                        <div class="col">
                            <h1>Brands</h1>
                        </div>
                    </div>
                </div>
                <div class="container" id="vestidos-footer">
                    <div class="row">
                        <div class="col">
                            <h1>footer</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
@endsection