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
    background: white;
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
.adminNewOrderActions a{
    padding: 5px 10px;
    display: inline-block;
    font-size: 1.5rem;
    color: black;
}
</style>
<script>
function adminOrderAddProductCart(prd){
    console.log("add",prd)
    // $.ajax({
    //     type: "GET",
    //     url: "/admin/orders/products/new",
    //     data: {
    //         data:prd
    //     },
    //     success: function(data) {
    //         if(data.length>0){
    //             console.log(data);
    //         }
    //     }
    // });
}
function adminOrderUpdateProductCart(prd){
    console.log("update",prd)
    // $.ajax({
    //     type: "GET",
    //     url: "/admin/orders/products/new",
    //     data: {
    //         data:prd
    //     },
    //     success: function(data) {
    //         if(data.length>0){
    //             console.log(data);
    //         }
    //     }
    // });
}
function adminOrderRemoveProductCart(prd){
    console.log("remove",prd)
    // $.ajax({
    //     type: "GET",
    //     url: "/admin/orders/products/new",
    //     data: {
    //         data:prd
    //     },
    //     success: function(data) {
    //         if(data.length>0){
    //             console.log(data);
    //         }
    //     }
    // });
}
function on_searchProduct_(event){
    $("#on_searchBar_result").hide();
    if(event.target.value.length > 3){
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
                        listul.append('<li><a class="on_search_item" href="" data="'+element.id+'">'+element.products_name+' '+' '+element.product_model+' '+element.brand_name+'</a></li>');
                    });
                    $(".on_search_item").on("click",function(e){
                        e.preventDefault();
                        let prd_id = $(e.target).attr("data");
                        location.href="/admin/orders/products/new?data="+prd_id;
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
                    <input type="text" onkeyup="on_searchProduct_(event)" class="form-control" id="on_searchBar_input" placeholder="Search for product">
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
            <div class="col-md-1">
                Price
            </div>
            <div class="col-md-2">
            </div>
        </div>
        @foreach($main_items as $indexKey=>$product)
        <div class="row container-data row-even">
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
            <div class="col-md-1">
                <span id="admin_new_order_total">{{$product->total_sale}}</span>
            </div>
            <div class="col-md-2 adminNewOrderActions">
                <a href="javascript:adminOrderRemoveProductCart('{{ $product->id }}')"><i class="fas fa-trash-alt"></i></a>
            </div>
        </div>
        @endforeach
        @foreach($main_items as $indexKey=>$product)
        <div class="row container-data row-even">
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
            <div class="col-md-1">
                <span id="admin_new_order_total">{{$product->total_sale}}</span>
            </div>
            <div class="col-md-2 adminNewOrderActions">
                <a href="javascript:adminOrderAddProductCart('{{ $product->id }}')"><i class="fas fa-plus"></i></a>
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