@extends("layouts.app")
@section('content')
@foreach($main_sliders as $indexKey => $main_slider)
<style>
#slide{{$indexKey}}{
    background-image:url('{{ asset('images/main_sliders/')}}/{{ $main_slider->image_url }}');
}
</style>
@endforeach
   <div id="fullpage">
        <div class="section" id="home_main_slider">
            <div id="main_slider_arrow_cont">
                    <div class="main_arrow_slider_txt">
                        {{ __('buttons.scroll_down') }}<br/>
                        <a class="vesti-svg vesti-down-arrow" href=''></a>
                    </div>
            </div>
            @foreach($main_sliders as $indexKey => $main_slider)
            <div class="slide slide-slide playfair-display-black-italic" id="slide{{$indexKey}}">
               
                <div class="intro">
                    <div class="container">
                        <div class="row">
                            <div class="col main_slider_txt">
                                    <div class="vesti_font_color_a main_slider_in">
                                        <span>{{ $main_slider->image_name }}</span><br/>
                                        <span>{{ $main_slider->image_name_2 }}</span>
                                    </div>
                            </div>
                            <div class="col main_slider_btn">
                                <div>
                                    <a href="{{ $main_slider->image_destination }}" class="btn btn-vesti-slide vesti_font_color_a">{{ __('buttons.see_more') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
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
                        @foreach($top_dresses as $keyIndex=>$top_dress)
                        <div id="top_middle_img{{ $keyIndex+1 }}" class="col-sm-6 col-md-4">
                            @if($top_dress->is_new)
                            <div class="vesti-new-txt vesti-new-txt-a">{{ __('general.new') }}</div>
                            <div class="vesti-new-border vesti-new-border-a"></div>
                            @endif
                            <a href="{{ route('product_page',['product_id'=>$top_dress->id])}}" class="vesti-heart-link"><span class="vesti-svg
                            @if(Auth::guard('vestidosUsers')->check())
                            @if(!($products->isWishlist(Auth::guard('vestidosUsers')->user()->id, $top_dress->id))->isEmpty())
                                active
                            @endif
                            @endif
                            "></span></a>
                            <a href="{{ route('product_page',['product_id'=>$top_dress->id])}}" class="flash_hover_link thumbnail">
                                <img src="{{asset('images/products')}}/{{ $top_dress->images->first()->img_url }}"  class="img-fluid" alt="model1">
                            </a>
                        </div>
                        @endforeach
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
                                    <a href="" class="btn btn-vesti-slide vesti_font_color_a">{{ __('buttons.see_more') }}</a>
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
                        @foreach($top_quinces as $keyIndex=>$top_quince)
                        <div id="quince_thumb_{{ $keyIndex+1 }}" class="quince_thumb col-sm-6 mt-4 col-md-4">
                            @if($top_quince->is_new)
                            <div class="vesti-new-txt vesti-new-txt-a">{{ __('general.new') }}</div><div class="vesti-new-border vesti-new-border-a"></div>
                            @endif
                            <a href="{{ route('product_page',['product_id'=>$top_quince->id])}}" class="vesti-heart-link"><span class="vesti-svg
                            @if(Auth::guard('vestidosUsers')->check())
                            @if(!($products->isWishlist(Auth::guard('vestidosUsers')->user()->id, $top_quince->id))->isEmpty())
                                active
                            @endif
                            @endif
                            "></span></a>
                           <a href="{{ route('product_page',['product_id'=>$top_quince->id])}}" class="flash_hover_link thumbnail"><img style="width:100%" src="{{asset('images/products')}}/{{ $top_quince->images->first()->img_url }}" alt/></a>
                        </div>
                        @endforeach
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