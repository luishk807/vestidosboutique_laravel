@extends("layouts.sub-layout")
@section('content')
<div id="popup_bgOverlay">
    <div id="popup_text">
        <div id="popup_text_in"></div>
        <div class="popup_close_btn_pnl"><button onclick="closeCartPopUp()" class="popup_close_btn">Close</button></div>
    </div>
</div>
<div class="main_sub_body main_body_height">
<div class="container">
    <div class="row">
        <div class="col container-in-center">
            <div class="container-fluid container-in-space">
                <div class="row">
                    <div class="col-md-2 product_thumnnail">
                            @foreach($product->images as $image)
                            <a href="" class="product_thumnb_link"><img src="{{ asset('/images/products/') }}/{{ $image->img_url }}" alt="{{ $image->img_name }}" class="float-left img-thumbnail"/></a>
                            @endforeach
                    </div>
                    <div class="col-md-6 product_main_img">
                        <div class="product_main_img_in">
                            <a href="javascript:addWishlist('{{ $product->id }}')" class="vesti-heart-link-b"><span class="vesti-svg"></span></a>
                            <a href=""><img src="{{ asset('/images/products/') }}/{{ $product->images->first()->img_url }}" class="img-fluid" alt="{{ $product->images->first()->img_name }}" /></a>
                        </div>
                    </div>
                    <div class="col-md-4 product_main_txt">
                        <div>
                            <div class="col">
                                    <form action="{{ route('add_cart',['product_id'=>$product->id]) }}" method="post" onsubmit="return checkCartSubmit()">
                                    <input type="hidden" id="product_color" name="product_color" value=""/>
                                    <input type="hidden" id="product_size" name="product_size" value=""/>
                                    <h2 class="product_in_title">{{ $product->products_name }}</h2>
                                    <div class="product_in_vendor">By {{ $product->vendor->getFullVendorName() }}</div>
                                    <div class="product_in_rate">
                                        <div class='rate-view' data-rate-value="{{ $product->rates->avg('user_rate') }}"></div>
                                    </div>
                                    <div class="product_in_detail crimson-txt">
                                    {{ $product->product_detail }}
                                    </div>
                                    <div class="product_in_price">${{ $product->product_total }}</div>
                                    <div class="product_in_colors">
                                        <div class="product_in_sub_title">
                                            Select Colors
                                        </div>
                                        @foreach($product->colors as $color)
                                        <button class="colors_cubes color_cubes_btn_a" data-class="colors_cubes" data-input="product_color" data-value="{{ $color->id }}" onclick="addCart(event)" style="background-color:{{ $color->color_code }}"></button>
                                        @endforeach
                                    </div>
                                   <div class="product_in_size">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="product_in_sub_title">
                                                Select Size
                                            </div>
                                            @foreach($product->sizes as $size)
                                            <button class="size_spheres" onclick="addCart(event)" data-class="size_spheres" data-input="product_size" data-value="{{ $size->id }}">{{ $size->name }}</button>
                                            @endforeach
                                        </div>
                                        <div class="col-md-6">
                                            <div class="product_in_sub_title">
                                               Quantity
                                            </div>
                                            <select class="custom-select" name="product_quantity">
                                            @for ($i = 1; $i < 10; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                            </select>
                                        </div>
                                        </div>

                                        
                                    </div>
                                    <div class="product_in_detail_drop">
                                        <div id="accordion">
                                            <div class="card">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapse-btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                           + Detail
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseOne" class="collapse" aria-labelleby="headingOne" data-parent="#accordion">
                                                {{ $product->product_detail }}

                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingTwo">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapse-btn" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                           + Description
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelleby="headingTwo" data-parent="#accordion">
                                               {{ $product->products_description }}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vesti_in_btn_pnl">
                                        <input class="btn-block vesti_in_btn"  type="submit" value="ADD TO CART"/>
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
                        <h2 class="product_in_title_loved">People Also Loved</h2>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 col-md-2  col-md-offset-1">
                                    <a href="#" class="vesti-heart-link-c"><span class="vesti-svg"></span></a>
                                    <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="img-responsive"/></a>
                                </div>
                                <div class="col-xs-6 col-md-2">
                                     <a href="#" class="vesti-heart-link-c"><span class="vesti-svg"></span></a>
                                    <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="img-responsive"/></a>
                                </div>
                                <div class="col-xs-6 col-md-2">
                                    <a href="#" class="vesti-heart-link-c"><span class="vesti-svg"></span></a>
                                    <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="img-responsive"/></a>
                                </div>
                                <div class="col-xs-6 col-md-2">
                                    <a href="#" class="vesti-heart-link-c"><span class="vesti-svg"></span></a>
                                    <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="img-responsive"/></a>
                                </div>
                                <div class="col-xs-6 col-md-2">
                                    <a href="#" class="vesti-heart-link-c"><span class="vesti-svg"></span></a>
                                    <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="img-responsive"/></a>
                                </div>
                                <div class="col-xs-6 col-md-2">
                                    <a href="#" class="vesti-heart-link-c"><span class="vesti-svg"></span></a>
                                    <a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt class="img-responsive"/></a>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection