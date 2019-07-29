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
                    <div class="container text-cont">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12 main_slider_txt">
                                    <div class="vesti_font_color_a main_slider_in">
                                        <span>{{ $main_slider->image_name }}</span><br/>
                                        <span>{{ $main_slider->image_name_2 }}</span>
                                    </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12 main_slider_btn">
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
                        {{ __('general.page_header.top_dresses') }}
                        </div>
                    </div>
                    <div id="top_middle_sec_row" class="row">
                        @foreach($top_dresses as $keyIndex=>$top_dress)
                        <div id="top_middle_img{{ $keyIndex+1 }}" class="col-12 col-sm-4 col-md-4 col-lg-4">
                            @if($top_dress->is_new)
                            <div class="vesti-new-txt vesti-new-txt-a">{{ __('general.product_title.new') }}</div>
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
                                <img 
                                @if($top_dress->images->count()>0)
                                src="{{asset('images/products')}}/{{ $top_dress->images->first()->img_url }}" 
                                @else
                                src="{{asset('images/no-image.jpg')}}" 
                                @endif
                             class="img-fluid" alt="model1">
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <svg version="1.1" class="vector-excla" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 612 792" xml:space="preserve">
                            <g>
                                <g id="Layer_x0020_1">
                                    <path fill="#EE4290" d="M68.6,281.1c44.9-61.7,104.7-110.4,183.4-144l9.3,26.3c-52.4,26.3-93.5,58-127.2,97.3S83.4,343,79.7,387.9
                                        c29.9-31.8,63.6-48.6,104.7-48.6c31.8,0,54.2,7.5,71.1,24.3c16.9,16.8,24.3,37.4,24.3,67.4c0,46.8-16.8,84.2-48.6,117.9
                                        c-33.7,33.7-71.1,48.6-117.9,48.6C40.4,597.4,3,558.2,3,477.8C1.2,408.4,23.6,342.9,68.6,281.1L68.6,281.1z"/>
                                </g>
                                <path fill="#EE4290" d="M397.7,281.1c44.9-61.7,104.7-110.4,183.4-144l9.3,26.3c-52.4,26.3-93.5,58-127.2,97.3S410.8,343,409,387.9
                                    c31.8-31.8,67.4-48.6,104.7-48.6c31.8,0,54.2,7.5,71.1,24.3c16.8,16.8,24.3,37.4,24.3,65.5v1.8c0,46.8-16.8,84.2-48.6,117.9
                                    c-33.7,33.7-71.1,48.6-117.9,48.6c-72.9,0-110.4-39.2-110.4-119.7C330.4,408.4,352.9,342.9,397.7,281.1z"/>
                            </g>
                        </svg>
                        </div>
                        <div class="col-md-8 top_middle_sec_title2">
                        <blockquote class="blockquote">
  <p>Sabemos que cuando creamos un vestido, no sólo estamos haciendo algo para usar. Estamos haciendo Magia.</p>
  <footer class="blockquote-footer">Madeline Gardner</footer>
</blockquote>
                        </div>
                        <div class="col-md-2">
                            <svg version="1.1" class="vector-excla" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 612 792" xml:space="preserve" transform="rotate(180)">
                                <g>
                                    <g id="Layer_x0020_1">
                                        <path fill="#EE4290" d="M68.6,281.1c44.9-61.7,104.7-110.4,183.4-144l9.3,26.3c-52.4,26.3-93.5,58-127.2,97.3S83.4,343,79.7,387.9
                                            c29.9-31.8,63.6-48.6,104.7-48.6c31.8,0,54.2,7.5,71.1,24.3c16.9,16.8,24.3,37.4,24.3,67.4c0,46.8-16.8,84.2-48.6,117.9
                                            c-33.7,33.7-71.1,48.6-117.9,48.6C40.4,597.4,3,558.2,3,477.8C1.2,408.4,23.6,342.9,68.6,281.1L68.6,281.1z"/>
                                    </g>
                                    <path fill="#EE4290" d="M397.7,281.1c44.9-61.7,104.7-110.4,183.4-144l9.3,26.3c-52.4,26.3-93.5,58-127.2,97.3S410.8,343,409,387.9
                                        c31.8-31.8,67.4-48.6,104.7-48.6c31.8,0,54.2,7.5,71.1,24.3c16.8,16.8,24.3,37.4,24.3,65.5v1.8c0,46.8-16.8,84.2-48.6,117.9
                                        c-33.7,33.7-71.1,48.6-117.9,48.6c-72.9,0-110.4-39.2-110.4-119.7C330.4,408.4,352.9,342.9,397.7,281.1z"/>
                                </g>
                            </svg>
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
                            <div>
                                <div class="vesti_font_color_b">Tu estilo</div>
                                <div>
                                    <blockquote class="blockquote">
                                    <p>Decide lo que eres, lo que quieres expresar con tu manera de vestir y el modo en que vives.</p>
                                    <footer class="blockquote-footer">Gianni Versace</footer>
                                    </blockquote>
                                </div>
                                <div>
                                    <a href="http://127.0.0.1:8000/shop/event/1" class="btn btn-vesti-slide vesti_font_color_a">{{ __('buttons.see_more') }}</a>
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
                        <div class="col-lg-12 col-md-9 quince_txt ">
                            <div>
                                <div class="vesti_font_color_b">Tu gran dia</div>
                                <div>A la hora de buscar vestidos para el baile de graduación opten por looks “frescos” y con un toque divertido, sin dejar de lado lo más importante siempre: su estilo personal…</div>
                               
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
                         <div class="col quince-select-title vesti_font_color_b text-center">{{ __('general.page_header.top_quince') }}</div>
                    </div>
                    <div class="row">
                        @foreach($top_quinces as $keyIndex=>$top_quince)
                        <div id="quince_thumb_{{ $keyIndex+1 }}" class="quince_thumb col-sm-6 mt-4 col-md-4">
                            @if($top_quince->is_new)
                            <div class="vesti-new-txt vesti-new-txt-a">{{ __('general.product_title.new') }}</div><div class="vesti-new-border vesti-new-border-a"></div>
                            @endif
                            <a href="{{ route('product_page',['product_id'=>$top_quince->id])}}" class="vesti-heart-link"><span class="vesti-svg
                            @if(Auth::guard('vestidosUsers')->check())
                            @if(!($products->isWishlist(Auth::guard('vestidosUsers')->user()->id, $top_quince->id))->isEmpty())
                                active
                            @endif
                            @endif
                            "></span></a>
                           <a href="{{ route('product_page',['product_id'=>$top_quince->id])}}" class="flash_hover_link thumbnail"><img style="width:100%" 
                           @if($top_quince->images->count()>0)
                           src="{{asset('images/products')}}/{{ $top_quince->images->first()->img_url }}"
                           @else
                            src="{{asset('images/no-image.jpg')}}" 
                            @endif
                             alt/></a>
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