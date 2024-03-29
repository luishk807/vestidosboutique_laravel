@extends("layouts.sub-layout")
@section('content')
<link rel="stylesheet" href="{{ asset('js/vendor/slick/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('js/vendor/slick/slick.css') }}">
<script src="{{ asset('js/vendor/slick/slick.js')}}"></script>
<div id="popup_bgOverlay">
    <div id="popup_text">
        <div id="popup_text_in"></div>
        <div class="popup_close_btn_pnl"><button onclick="closeCartPopUp()" class="popup_close_btn">{{ __('buttons.close') }}</button></div>
    </div>
</div>
<div class="main_sub_body main_body_height">
<div class="container">
    <div class="row">
        <div class="col container-in-center">
            <div class="container-fluid container-in-space">
                <div class="row">
                    <div class="col-md-2 desktop-view product_thumnnail">
                            @foreach($product->images as $image)
                            <a href="" class="product_thumnb_link"><img src="{{ asset('/images/products/') }}/{{ $image->img_url }}" alt="{{ $image->img_name }}" class="float-left img-thumbnail"/></a>
                            @endforeach
                    </div>
                    <div class="col-md-6 desktop-view product_main_img">
                        <div class="product_main_img_in">
                            <a href="javascript:addWishlist('{{ $product->id }}')" class="vesti-heart-link-b">
                            <span class="vesti-svg
                            @if(Auth::guard('vestidosUsers')->check())
                            @if(!($product->isWishlist(Auth::guard('vestidosUsers')->user()->id,$product->id))->isEmpty())
                                active
                            @endif
                            @endif
                            "></span></a>
                            @if($product->images->count()>0)
                            <a class="product_main_link_in" target="_black" href="{{ asset('/images/products/') }}/{{ $product->getMainImage()[0]->img_url }}"><img id="thumb" src="{{ asset('/images/products/') }}/{{ $product->getMainImage()[0]->img_url }}" data-large-img-url="{{ asset('/images/products/') }}/{{ $product->getMainImage()[0]->img_url }}" class="img-fluid" alt="{{ $product->getMainImage()[0]->img_name }}" /></a>
                            @else
                            <img src="{{asset('images/no-image.jpg')}}" class="img-fluid" alt="no image" />
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mobile-view product_main_img">
                        <div class="product_main_img_in slick">
                            @foreach($product->images as $image)
                            <a target="_black" href="{{ asset('/images/products/') }}/{{ $image->img_url }}"><img id="thumb" src="{{ asset('/images/products/') }}/{{ $image->img_url }}" class="img-fluid" alt="{{ $image->img_name }}" /></a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4 product_main_txt">
                        <div>
                            <div class="col">
                                    <form action="{{ route('add_cart',['product_id'=>$product->id]) }}" method="post" onsubmit="return checkCartSubmit()">
                                    <input type="hidden" id="product_color" name="product_color" value=""/>
                                    <input type="hidden" id="product_size" name="product_size" value=""/>
                                    <h2 class="product_in_title">{{ $product->products_name }}</h2>
                                    <h3 class="py-2 product_in_model">{{$product->product_model}}</h3>
                                    <div class="product_in_vendor">{{ __('general.cart_title.sell_by') }} {{ $product->getBrand->name }}</div>
                                    <div class="product_in_rate">
                                        <div class='rate-view' data-rate-value="{{ $product->getRatesByStatus(1)->avg('user_rate') }}"></div>
                                        <div class="rate-count">&#40;{{ $product->getRateCountApproved()->count()}}&#41;</div>
                                    </div>
                                    <div class="product_in_detail crimson-txt">
                                    {{ $product->product_detail }}
                                    </div>
                                    <div class="product_in_price">$<span>{{ $product->total_rent }}</span></div>
                                    <div class="product_in_colors">
                                        <div class="product_in_sub_title">
                                        {{ __('general.product_title.select_color') }}
                                        </div>
                                        <div class="my-2 px-0 col colors_cubes_name">
                                        <span></span>
                                        </div>
                                        @foreach($product->colors as $colorIndex => $color)
                                        @php( $colorSelected= $colorIndex==0 ? "selected":"" )
                                        <button class="colors_cubes {{ $colorSelected }} color_cubes_btn_a" data-class="colors_cubes" data-input="product_color" data-value="{{ $color->id }}" onclick="addCart(event)" style="background-color:{{ $color->color_code }}"></button>
                                        @endforeach
                                    </div>
                                   <div class="product_in_size">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="product_in_sub_title">
                                            {{ __('general.product_title.select_size') }}
                                            </div>
                                            <span id="size-container"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="product_in_sub_title">
                                            {{ trans_choice('general.cart_title.quantity',1) }}
                                            </div>
                                            <select id="product_quantity" class="custom-select" name="product_quantity">
                                            </select>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="shoplist-stock-txt">
                                        <span></span>
                                    </div>
                                    @if(!empty($product->style))
                                    <div class="product_in_styles">
                                        <span>{{ __('general.product_title.style') }}</span> &#58; <span>{{$product->getStyle->name}}</span>
                                    </div>
                                    @endif
                                    <div class="product_in_detail_drop">
                                        <div id="accordion">
                                            <div class="card">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="mb-0">
                                                        <a class="btn btn-link collapse-btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                           + {{ __('general.product_title.detail') }}
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseOne" class="collapse" aria-labelleby="headingOne" data-parent="#accordion">
                                                {{ $product->product_detail }}

                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingTwo">
                                                    <h5 class="mb-0">
                                                        <a class="btn btn-link collapse-btn" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                           + {{ __('general.product_title.description') }}
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelleby="headingTwo" data-parent="#accordion">
                                               {{ $product->products_description }}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vesti_in_btn_pnl">
                                            <input id="product_addCart_btn" class="btn-block vesti_in_btn"  type="submit" value="{{ __('buttons.add_cart') }}"/>
                                            <!-- <div id="product_out_stock_btn" class="vesti_out_stock_btn">{{ __('general.product_title.out_stock') }}</div> -->
                                            <input id="product_out_stock_btn" class="btn-block vesti_in_btn" type="submit" value="{{ __('buttons.pre_order') }}">
                                    </div>
                                    <div class="product_in_social">
                                        
                                    </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col product_in_loved">
                        <h2 class="product_in_title_loved">{{ __('general.also_loved') }}</h2>
                        <div class="container-fluid">
                            <div class="row">
                                @foreach($products_cat as $product_cat)
                                <div class="col-xs-6 col-md-2  col-md-offset-1">
                                    <a href="{{ route('product_page',['product_id'=>$product_cat->id])}}" class="vesti-heart-link-c"><span class="vesti-svg
                                    @if(Auth::guard('vestidosUsers')->check())
                                    @if(!($product->isWishlist(Auth::guard('vestidosUsers')->user()->id, $product_cat->id))->isEmpty())
                                        active
                                    @endif
                                    @endif
                                    "></span></a>
                                    <a href=""><a href="{{ route('product_page',['product_id'=>$product_cat->id])}}"><img src="{{ asset('/images/products/') }}/{{ $product_cat->image_url }}" alt="{{ $product_cat->image_name }}" class="img-responsive"/></a></a>
                                </div>
                                @endforeach
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
var imgUrl = $("#thumb").attr("data-large-img-url");
$(document).ready(function(){
    var evt = new Event(),
    m = new Magnifier(evt);
    m.attach({
        thumb: '#thumb',
        large: imgUrl,
        mode:'inside',
        zoom: 2,
    zoomable: true
    });
    $('.slick').slick();
})
</script>

@endsection