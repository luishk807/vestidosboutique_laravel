@extends("layouts.sub-layout")
@section('content')
<div class="main_sub_body main_body_height">
<div class="container-fluid vest-shop-container">
    <form method="post" id="shop_sort_form" action="">
    <input type="hidden" id="evtid" name="evtid" value="{{ $evtid }}">
    <input type="hidden" id="evtype" name="evtype" value="{{ $evtype }}">
    <div class="row">
        <div class="col container-in-center">
            <div class="container-fluid container-in-space">
               {{-- <div class="row">
                    <div class="col-md-3" id="mobile-sort-nav"><!--mobile search-->
                        <!--hiding mobile menu-->
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapse-btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            +{{ __('general.optimized_search') }}
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelleby="headingOne" data-parent="#accordion">
                                    <div class="shoplist-search-cont vesti-search-cont">
                                        <div class="shoplist-search-type-cont">
                                            <h3>{{ __('header.event') }}</h3>
                                            <div class="shoplist-search-list-cont">
                                                <ul>
                                                @foreach($categories as $category)
                                                <li><input id="vestidos_cat_3" type="checkbox" class="vestidos-check" name="vestidos_category[]" value="{{ $category->id }}"/><label for="vestidos_cat_3" class="vestidos-label"/>{{ $category->name }}</label></li>
                                                @endforeach
                                                </ul>
                                            </div>   
                                        </div><!--end of search type-->
                                    </div>
                                </div>
                            </div>
                        </div>
                                      <!--hiding mobile menu-->
                                      
                    </div><!--end of mobile search-->
                    --}}
                    {{--<div class="col-md-3" id="desktop-sort-nav">
                        <input type="hidden" name="shopPage_select_input" id="shopPage_select_input">
                        <div class="shoplist-search-cont vesti-search-cont">
                            <div class="shoplist-search-type-cont">
                                <h3>{{ __('header.event') }}</h3>
                                <div class="shoplist-search-list-cont">
                                    <ul>
                                        @foreach($categories as $keyCat=>$category)
                                        <li><input id="vestidos_cat_{{$keyCat}}" type="checkbox" class="vestidos-check" name="vestidos_categories[]" 
                                        @foreach($categoryids as $catid)
                                        @if($catid==$category->id)
                                        checked
                                        @endif
                                        @endforeach
                                         value="{{ $category->id }}"/><label for="vestidos_cat_{{$keyCat}}" class="vestidos-label"/>{{ $category->name }}</label></li>
                                        @endforeach
                                    </ul>
                                </div>   
                            </div><!--end of search type-->
                            <div class="shoplist-search-type-cont">
                                <h3>{{ __('header.brands') }}</h3>
                                <div class="shoplist-search-list-cont">
                                    <ul>
                                    @foreach($brands as $keyBrand=>$brand)
                                    <li><input id="vestidos_cat_{{$keyBrand}}" type="checkbox" class="vestidos-check" name="vestidos_brands[]" 
                                    @foreach($brandids as $branid)
                                        @if($branid==$brand->id)
                                        checked
                                        @endif
                                        @endforeach
                                    value="{{ $brand->id }}"/><label for="vestidos_cat_{{$keyBrand}}" class="vestidos-label"/>{{ $brand->name }}</label></li>
                                    @endforeach
                                    </ul>
                                </div>   
                            </div><!--end of search type-->
                        </div>

                    </div>
                    <div class="col-md-9">
                    --}}
                    <div class="col">
                        @if($event && $event->image_url)
                        <div class="text-center"><img src="{{ asset('images/shop_banners') }}/{{$event->image_url}}" class="img-fluid" alt/></div>
                        @else
                        <div class="text-center"><img src="{{ asset('images') }}/event_misc.jpg" class="img-fluid" alt/></div>
                        @endif
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
                    </div><!--end of main product list container-->
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
</div>
@endsection