@extends("layouts.app")
@section('content')
    <style>
    #slide1{
        background-image: url({{ asset('images/vestidos_slide1.jpg') }});
        text-align:center;
    }
    #slide2{
        background-image: url({{ asset('images/vestidos_slide3.jpg') }});
    }
    #slide3{
        background-image: url({{ asset('images/home_main_img3.jpg') }});
    }
    .section{
		background-size: cover;
	}
	.slide{
		background-size: cover;
    }
    .home_bg_2{
        background:url('{{ asset('images/home_main_img2.jpg') }}') no-repeat top center;
        background-size:1551px 752px;
        height:752px;
    }
    .home_w100{
        max-width:100% !important;
    }
    .gray_bg{
        background-color:#dfdfe1;
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
            <div class="slide playfair-display-black-italic" id="slide1"><h1>Slide Backgrounds</h1></div>
            <div class="slide" id="slide2"><h1>Totally customizable</h1></div>
        </div>
        <div class="section " id="top_middle_sec">
        <div class="slide">
                <div class="container">
                    <div class="row">
                        <div class="col">
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
                        <div class="col">
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
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h1>Brands</h1>
                        </div>
                    </div>
                </div>
                <div class="container">
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