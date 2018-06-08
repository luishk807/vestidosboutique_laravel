@extends("layouts.app")
@section('content')
   <div id="fullpage">
        <div class="section" id="home_main_slider">
            <div id="main_slider_arrow_cont">
                    <div class="main_arrow_slider_txt">
                        Scroll Down<br/>
                        <a class="vesti-svg vesti-down-arrow" href=''></a>
                    </div>
            </div>
            <div class="slide playfair-display-black-italic" id="slide2">
               
                <div class="intro">
                    <div class="container">
                        <div class="row">
                            <div class="col main_slider_txt">
                                    <div class="vesti_font_color_a main_slider_in">
                                        <span>Lorem Ipsum has?</span><br/>
                                        <span>2018</span>
                                    </div>
                            </div>
                            <div class="col main_slider_btn">
                                <div>
                                    <a href="" class="btn btn-vesti-slide vesti_font_color_a">Ver Mas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="slide playfair-display-black-italic" id="slide1">
            <div class="intro">
                    <div class="container">
                        <div class="row">
                            <div class="col main_slider_txt">
                                    <div class="vesti_font_color_a main_slider_in">
                                        <span>Lorem Ipsum has?</span><br/>
                                        <span>2018</span>
                                    </div>
                            </div>
                            <div class="col main_slider_btn">
                                <div>
                                    <a href="" class="btn btn-vesti-slide vesti_font_color_a">Ver Mas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide playfair-display-black-italic" id="slide3">
                <div class="intro">
                    <div class="container">
                        <div class="row">
                            <div class="col main_slider_txt">
                                    <div class="vesti_font_color_a main_slider_in">
                                        <span>Lorem Ipsum has?</span><br/>
                                        <span>2018</span>
                                    </div>
                            </div>
                            <div class="col main_slider_btn">
                                <div>
                                    <a href="" class="btn btn-vesti-slide vesti_font_color_a">Ver Mas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="top_middle_sec">
        <div class="intro">
                <div class="container">
                    <div class="row">
                        <div class="col top_middle_sec_title">
                            Top Dresses
                        </div>
                    </div>
                    <div id="top_middle_sec_row" class="row">
                        <div id="top_middle_img1" class="col-sm-6 col-md-4">
                            <div class="vesti-new-txt vesti-new-txt-a">NEW</div><div class="vesti-new-border vesti-new-border-a"></div>
                            <a href="#" class="vesti-heart-link"><span class="vesti-svg"></span></a>
                            <a href="/product" class="flash_hover_link thumbnail">
                                <img src="{{asset('images/middle_1.jpg')}}" alt="model1">
                            </a>
                        </div>
                        <div id="top_middle_img2" class="col-sm-6 col-md-4">
                            <a href="#" class="vesti-heart-link"><span class="vesti-svg"></span></a>
                            <a href="/product" class="flash_hover_link thumbnail">
                                <img src="{{asset('images/middle_2.jpg')}}" alt="model1">
                            </a>
                        </div>
                        <div id="top_middle_img3" class="col-sm-6 col-md-4">
                            <a href="#" class="vesti-heart-link"><span class="vesti-svg"></span></a>
                            <a href="/product" class="flash_hover_link thumbnail">
                                <img src="{{asset('images/middle_3.jpg')}}" alt="model1">
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ asset('images/home_main_ad1-01.svg') }}" class="vesti-svg vesti-excla" />
                        </div>
                        <div class="col-md-8 top_middle_sec_title2">
                            I love how easy it was for me and my bridesmaids. The Dresses turned out perfect! Everyone was very comfortable and they looked amazing
                        </div>
                        <div class="col-md-2">
                            <img src="{{ asset('images/home_main_ad2-01.svg') }}" class="vesti-svg vesti-excla" />
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
                                <img src="{{asset('images/home_main_img2_minb.jpg')}}" alt="model1">
                            </div>
                            <div>
                                <div class="vesti_font_color_b">Lorem Ipsum has?</div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque condimentum elit justo, sed iaculis ipsum elementum eget. Nullam sed nibh justo. Maecenas sed enim at ante dignissim maximus quis eget elit</div>
                                <div>
                                    <a href="" class="btn btn-vesti-slide vesti_font_color_a">Ver Mas</a>
                                </div>
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
                                <img src="{{asset('images/home_main_img3-minb.jpg')}}" alt="model1">
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
                        <div id="quince_thumb_1" class="quince_thumb col-sm-6 mt-4 col-md-4">
                            <div class="vesti-new-txt vesti-new-txt-a">NEW</div><div class="vesti-new-border vesti-new-border-a"></div>
                            <a href="#" class="vesti-heart-link"><span class="vesti-svg"></span></a>
                           <a href='' class="flash_hover_link thumbnail"><img style="width:100%" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                        </div>
                        <div id="quince_thumb_2" class="quince_thumb col-sm-6 mt-4 col-md-4">
                            <a href="#" class="vesti-heart-link"><span class="vesti-svg"></span></a>
                           <a href='' class="flash_hover_link thumbnail"><img style="width:100%" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                        </div>
                        <div id="quince_thumb_3" class="quince_thumb col-sm-6 mt-4 col-md-4">
                            <a href="#" class="vesti-heart-link"><span class="vesti-svg"></span></a>
                           <a href='' class="flash_hover_link thumbnail"><img style="width:100%" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                        </div>
                        <div id="quince_thumb_4" class="quince_thumb col-sm-6 mt-4 col-md-4">
                            <a href="#" class="vesti-heart-link"><span class="vesti-svg"></span></a>
                           <a href='' class="flash_hover_link thumbnail"><img style="width:100%" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                        </div>
                        <div id="quince_thumb_5" class="quince_thumb col-sm-6 mt-4 col-md-4">
                            <a href="#" class="vesti-heart-link"><span class="vesti-svg"></span></a>
                           <a href='' class="flash_hover_link thumbnail"><img style="width:100%" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                        </div>
                        <div id="quince_thumb_6" class="quince_thumb col-sm-6 mt-4 col-md-4">
                            <a href="#" class="vesti-heart-link"><span class="vesti-svg"></span></a>
                           <a href='' class="flash_hover_link thumbnail"><img style="width:100%" src="{{asset('images/home_main_img4.jpg')}}" alt/></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section vestidos-footer fp-auto-height vest-maincolor">
            <div class="intro footer">
            @include('includes.footer')
            </div>
        </div>
  </div>
@endsection