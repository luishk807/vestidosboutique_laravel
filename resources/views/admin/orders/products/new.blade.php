@extends('admin/layouts.app')
@section('content')
<style>
.order-product-list img {
    max-width: 100%;
}
.order-product-list td{
    width:20%;
}
#on_searchBar_col{
    position:relative;
    display:block;
}
#on_searchBar_result{
    display:none;
    width: 100%;
    background: rgba(255,255,255,0.9);
    position: absolute;
    z-index: 2;
    padding: 5px;
    border: 1px solid rgba(0,0,0,0.1);
    top: 50%;
}
#on_searchBar_result ul li:not(:first-child){
    border-top: 1px solid rgba(0,0,0,0.1);
}
#on_searchBar_result ul{
    list-style: none;
    list-style-type: none;
}
#on_searchBar_result ul,
#on_searchBar_result ul li{
    padding: 0px;
    margin: 0px;
}
.on_search_item{
    padding: 15px 5px;
    color: black;
    display: block;
}
</style>
<script>
$(document).ready(function(){

})
function on_searchProduct_(event){
    $("#on_searchBar_result").hide();
    if(event.target.value.length > 3){
        console.log("Hey hey ")
        $.ajax({
            type: "GET",
            url: "/api/searchProductList",
            data: {
                data:event.target.value
            },
            success: function(data) {
                if(data.length>0){
                    $("#on_searchBar_result").show();
                    var listul=$("#on_searchBar_result ul");
                   listul.empty();
                    $.each(data, function(index,element){
                        listul.append('<li><a class="on_search_item" href="">'+element.products_name+' '+' '+element.product_model+' '+element.brand_name+'</a></li>');
                    });
                    $(".on_search_item").on("click",function(e){
                        location.href="/api/adminAddProductToCart"
                    })
                }
            }
        });
    }
}
</script>
<script>
var urlColorSizes = "{{ url('api/loadSizes') }}";
var urlProductQuantityArray = "{{ url('api/loadProdQuantityArray') }}";
</script>
<form action="{{ route('admin_create_order_products') }}" method="post">
{{ csrf_field() }}
<div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a href="{{ route('admin_show_new_order_address') }}" class="admin-btn">Back To Addresses</a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Continue To Payment"/>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                    <input type="text" onkeyup="on_searchProduct_(event)" class="form-control" id="on_searchBar_input" placeholder="First name">
            </div>
        </div>
        <div class="row">
            <div id="on_searchBar_col" class="col">
                <div id="on_searchBar_result">
                    <ul>
                        <li><a href="" class="on_search_item"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row container-title">
            <div class="col-md-1">
            </div>
            <div class="col-md-2">
                Images
            </div>
            <div class="col-md-2">
                Name
            </div>
            <div class="col-md-2">
                Color
            </div>
            <div class="col-md-2">
                Size
            </div>
            <div class="col-md-1">
                Quant
            </div>
            <div class="col-md-2">
                Total (sale)
            </div>
        </div>
        @foreach($main_items as $indexKey=>$product)
        <div class="row container-data row-even">
            <div class="col-md-1">
                <input type="checkbox" name="order_products[{{$indexKey}}][product_id]" id="productcheck{{$indexKey}}" value="{{ $product->id }}">
            </div>
            <div class="col-md-2">
                <img src="
                @if($product->images->count()>0)
                    {{asset('images/products')}}/{{$product->getMainImage()[0]->img_url}}
                @else
                {{asset('images/no-image.jpg')}}
                @endif
                " alt class="img-fluid">
            </div>
            <div class="col-md-2">
                {{$product->products_name}}
            </div>
            <div class="col-md-2">
                <select class="custom-select" id="color_drop_{{ $indexKey }}"  onChange="loadSizes(this.value,'{{ $indexKey }}')" name="order_products[{{$indexKey}}][color]">
                    <option value="">Select Color</option>
                    @foreach($product->colors as $color)
                    <option value="{{$color->id}}">{{$color->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select class="custom-select" id="size_drop_{{ $indexKey }}" onChange="loadSizeDropDownArray(this.value,'{{ $indexKey }}')" name="order_products[{{$indexKey}}][size]">
                    <option value="">Select Size</option>
                </select>
            </div>
            <div class="col-md-1">
                <select class="custom-select" id="quantity_drop_{{ $indexKey }}" name="order_products[{{$indexKey}}][quantity]">
                    @for ($i = 1; $i < 10; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <span id="admin_new_order_total">{{$product->total_sale}}</span>
            </div>
        </div>
        @endforeach
    </div>
    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a href="{{ route('admin_show_new_order_address') }}" class="admin-btn">Back To Addresses</a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Continue To Payment"/>
            </div>
        </div>
    </div>
</form>
@endsection