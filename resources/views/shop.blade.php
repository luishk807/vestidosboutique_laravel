@extends("layouts.sub-layout")
@section('content')
<style>
.vesti-new-txt-b{
  font-size: .7rem;
  margin-top: 10px;
    margin-left: 5px;
}
.shoplist-cont{
    list-style-type: none;
    display: block;
    padding: 0;
    margin: 0;
    position: relative;
    -moz-columns: 3 200px;
    -webkit-columns: 3 200px;
    columns: 3 200px;
    -moz-column-gap: 1em;
    -webkit-column-gap: 1em;
    column-gap: 1em;
}
.shoplist-cont li{
    /* display:table-cell; */
    padding-top: 30px;
}
.shoplist-list > div{
    display:inline-table;
}
.shoplist-list-cont-in .row div{
    padding-right:0px;
    padding-left:0px;
}
.shoplist-list-cont-in .row div:nth-child(1){
    text-align:left;
}
.shoplist-list-cont-in .row div:nth-child(2){
    text-align:right;
}
.shoplist-list-cont-in .shoplist-thumb-name{
    font-family: Arial;
    font-size: .8rem;
}
.shoplist-list-cont-in .shoplist-thumb-price{
    font-family: Arial;
    font-size: 1.1rem;
}
.shoplist-list-cont-in .shoplist-thumb-auth{
    font-family: Arial;
    font-size: .7rem;
}
.color_cubes_view_a{
  width: 23px;
  height: 15px;
}
.shoplist-nav{
    text-align:right;
    margin: 20px 0px 10px 0px;
}
.shoplist-nav ul{
    list-style:none;
}
.shoplist-nav ul li{
    display:inline-block;
}
.shoplist-nav ul li:not(:first-child):not(:last-child){
    margin:0px 10px;
}
.shoplist-nav a,
.shoplist-nav{
    font-family: arial;
    font-size: 1rem;
    color: black;
}
.shoplist-nav select{
    padding: 10px 40px 10px 2px;
    background-color: transparent;
    text-align: left;
    background: none;
}
.shoplist-search-cont ul{
    list-style:none;
    padding: 0;
    margin: 0;
}
.shoplist-search-cont h3{
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    line-height: 3rem;
}
.shoplist-search-cont ul li{
    text-align:left;
}
.shoplist-search-list-cont{
    max-height: 250px;
    overflow: auto;
}
.shoplist-search-type-cont{
    margin-bottom:20px;
}
#mobile-sort-nav{
    display:none;
    margin: 10px 0px;
}
#mobile-sort-nav #accordion .card-header{
    background-color:black !important;;
}
#mobile-sort-nav button{
    color:white;
}
.vestidos-check{

}
.vestidos-label{

}
@media only screen and (max-width: 600px) {
    #mobile-sort-nav{
        display:block;
    }
    #desktop-sort-nav{
        display:none;
    }
}
@media only screen and (max-device-width: 812px) and (orientation: landscape) {
    #mobile-sort-nav{
        display:block;
    }
    #desktop-sort-nav{
        display:none;
    }
}
</style>
<script>
	$(document).ready(function(){
		$(".rate-shop").rate({
			readonly:true
        });
        $("#shopPage_select").change(function(){
            $("#shop_sort_form").submit();
        });
        $(".vestidos-check").on("click",function(){
            $("#shop_sort_form").submit();
        })
    })
</script>
<div class="main_sub_body main_body_height">
<div class="container">
    <form method="post" id="shop_sort_form" action="{{ route('shop_sort_check') }}">
    <div class="row">
        <div class="col container-in-center">
            <div class="container container-in-space">
                <div class="row">
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
                    <div class="col-md-3" id="desktop-sort-nav">
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
                        <div><img src="{{ asset('images/shop_banners') }}/{{$shop_banners->image_url}}" class="img-fluid" alt/></div>
                        <div class="shoplist-nav">
                            <ul>
                                <li>{{ $products->total() }} {{ trans_choice('general.product',3) }}</li>
                                <li>{{ __('pagination.sort_by') }}
                                    <select id="shopPage_select" name="shopPage_select">
                                        @foreach($sort_ops as $sort_op)
                                        <option value='{{ $sort_op }}'
                                        @if($sort_op==$sort)
                                        selected='selected'
                                        @endif
                                        >{{ ucfirst(trans($sort_op)) }}</option>
                                        @endforeach
                                    </select>
                                </li>
                                @if(!empty($products->previousPageUrl()))
                                <li><a href="{{ $products->previousPageUrl()}}">&lt; Back</a></li>
                                @endif
                                <li>{{ $products->currentPage()}} of {{ $products->count() }}</li>
                                @if($products->nextPageUrl())
                                <li><a href="{{ $products->nextPageUrl() }}">Next &gt;</a></li>
                                @endif
                            </ul>
                        </div>
                        <div>
                            <ul class="shoplist-cont">
                            
                                @foreach($products as $product)
                                <!--each pod-->
                                <li class="shoplist-list">
                                    <div>
                                        @if($product->is_new)
                                        <div class="vesti-new-txt vesti-new-txt-b">NEW</div><div class="vesti-new-border vesti-new-border-b"></div>
                                        @endif
                                        <a href='/product/{{$product->id}}' class="flash_hover_link thumbnail"><img class="img-fluid" src="
                                        @if($product->images->count()>0)
                                            {{asset('images/products')}}/{{$product->images->first()->img_url}}
                                        @else
                                             {{asset('images/no-image.jpg')}}
                                        @endif
                                        " alt/></a>
                                        <div class="container shoplist-list-cont-in">
                                            <div class="row">
                                                <div class="col-md-8"><span class="shoplist-thumb-name">{{$product->products_name}}</span><br/><span class="shoplist-thumb-auth">By {{ $product->vendor->getFullVendorName() }}</span></div>
                                                <div class="col-md-4"><span  class="shoplist-thumb-price">${{ $product->total_rent }}</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class='rate-shop' data-rate-value="{{ $product->rates->avg('user_rate') }}"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    @foreach($product->colors as $color)
                                                    <span class="colors_cubes color_cubes_view_a" style="background-color:{{ $color->color_code }}"></span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!--end pod-->
                                @endforeach
                            </ul>
                        </div><!--end of product list container-->
                        <div class="shoplist-nav">
                            <ul>
                                 @if(!empty($products->previousPageUrl()))
                                <li><a href="{{ $products->previousPageUrl()}}">&lt; Back</a></li>
                                @endif
                                <li>{{ $products->currentPage()}} of {{ $products->count() }}</li>
                                @if($products->nextPageUrl())
                                <li><a href="{{ $products->nextPageUrl() }}">Next &gt;</a></li>
                                @endif
                            </ul>
                        </div><!--end of nav container-->
                    </div><!--end of main product list container-->
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
</div>
@endsection