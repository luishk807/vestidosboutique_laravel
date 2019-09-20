@extends("layouts.sub-layout")
@section('content')
<style>
.shoplist-no-result-pnl p:first-child{
    font-size: 1.5rem;
    font-weight: bold;
}
.shoplist-no-result-pnl p:last-child{
    font-size: 1.5rem;
}
</style>
<div class="main_sub_body main_body_height">
<div class="container-fluid vest-shop-container">
    <form method="post" id="shop_sort_form" action="">
    <input type="hidden" id="evtid" name="evtid" value="{{ isset($evtid) ? $evtid : null }}">
    <input type="hidden" id="evtype" name="evtype" value="{{ isset($evtype) ? $evtype : null }}">
    <input type="hidden" id="sstring" name="sstring" value="{{ isset($sstring) ? $sstring : null }}">
    <div class="row px-0 mx-0">
        <div class="col px-0 container-in-center">
            <div class="container-fluid container-in-space">
                <div class="row">
                <div class="col">
                        @if(isset($event) && $event->image_url)
                        <div class="text-center"><img src="{{ asset('images/shop_banners') }}/{{$event->image_url}}" class="img-fluid" alt/></div>
                        @else
                        <div class="text-center"><img src="{{ asset('images') }}/event_misc.jpg" class="img-fluid" alt/></div>
                        @endif
                        @if(count($products)>0)
                        <div class="shoplist-nav">
                            <ul>
                                <li>{{ $products->total() }} {{ trans_choice('general.cart_title.product',3) }}</li>
                                <li>{{ __('pagination.sort_by') }}
                                    <select id="shopPage_select" name="shopPage_select">
                                        @foreach($sort_ops as $keySort=>$sort_op)
                                        <option value='{{ $keySort }}'
                                        @if($keySort==$sort)
                                        selected='selected'
                                        @endif
                                        >{{ ucfirst(trans($sort_op)) }}</option>
                                        @endforeach
                                    </select>
                                </li>
                                @if(!empty($products->previousPageUrl()))
                                <li><a href="{{ $products->previousPageUrl()}}">&lt; {{ __('pagination.previous') }}</a></li>
                                @endif
                                <li>{{ $products->currentPage()}} {{ __('pagination.of') }} {{ $products->lastPage() }}</li>
                                @if($products->nextPageUrl())
                                <li><a href="{{ $products->nextPageUrl() }}">{{ __('pagination.next') }} &gt;</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                    @foreach($products as $product)
                                    <input type="hidden" name="product_lists[]" value="{{ $product->id }}"/>
                                    <div class="col-md-3 p-2 product-rows">
                                    <!--each pod-->
                                            @if($product->is_new)
                                            <div class="vesti-new-txt vesti-new-txt-b">{{ __('general.product_title.new') }}</div><div class="vesti-new-border vesti-new-border-b"></div>
                                            @endif
                                            <a href='/product/{{$product->id}}' class="flash_hover_link thumbnail">
                                            <img class="img-fluid" src="
                                            @if($product->img_url)
                                                {{asset('images/products')}}/{{$product->img_url}}
                                            @else
                                                {{asset('images/no-image.jpg')}}
                                            @endif
                                            " alt/>
                                            </a>
                                            <div class="container shoplist-list-cont-in">
                                                <div class="row">
                                                    <div class="col-md-7"><span class="shoplist-thumb-name">{{$product->products_name}}</span><br/>
                                                    <span class="shoplist-thumb-auth">{{ __('general.cart_title.sell_by') }} {{ $product->brand_name }}</span>
                                                    </div>
                                                    <div class="col-md-5"><span  class="shoplist-thumb-price">${{ $products_model->getSize_byId($product->id)->total_sale }}</span>
                                                    <br/>
                                                    <span  class="shoplist-stock-txt">
                                                        @if($product->stock > 0)
                                                            <span class='stock'>{{ __('general.product_title.in_stock')}}</span>
                                                        @else
                                                            <span class='out-stock'>{{ __('general.product_title.per_order')}}</span>
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        @php( $prod_rates = $products_model->getRates_byId($product->id))
                                                        <div class='rate-shop' data-rate-value="{{ $prod_rates[0]->rates }}"></div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        @php( $prod_colors = $products_model->getColors_byId($product->id))
                                                        @foreach($prod_colors as $color)
                                                        <span class="colors_cubes color_cubes_view_a" style="background-color:{{ $color->color_code }}"></span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                    </div><!--end of each pod-->
                                    @endforeach
                            </div>
                        </div><!--end of product list container-->
                        <div class="shoplist-nav">
                            <ul>
                                 @if(!empty($products->previousPageUrl()))
                                <li><a href="{{ $products->previousPageUrl()}}">&lt; {{ __('pagination.previous') }}</a></li>
                                @endif
                                <li>{{ $products->currentPage()}} {{ __('pagination.of') }} {{ $products->lastPage() }}</li>
                                @if($products->nextPageUrl())
                                <li><a href="{{ $products->nextPageUrl() }}">{{ __('pagination.next') }} &gt;</a></li>
                                @endif
                            </ul>
                        </div><!--end {{ __('pagination.of') }} nav container-->
                        @else
                        <div class="shoplist-no-result-pnl text-center py-5">
                            <p>
                            {{ __('search.no_result_line1') }} "{{$sstring}}"
                            </p>
                            <p>
                            {{ __('search.no_result_line2') }}
                            </p>
                        </div>
                        @endif
                    </div><!--end of main product list container-->
                </div>
            </div>
        </div> <!-- end of  container-in-center -->
    </div><!--end of first row-->
    </form>
</div>
</div>
@endsection