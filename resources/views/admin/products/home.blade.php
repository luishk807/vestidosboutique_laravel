@extends('admin/layouts.app')
@section('content')
<style>
#search-result-holder {
    width: 100%;
    background: white;
    border-left: 1px solid #ced4da;
    border-right: 1px solid #ced4da;
    border-bottom: 1px solid #ced4da;
    position: absolute;
    z-index: 999;
}
#search-bar-holder{
    position:relative;
}
#search-bar-holder ul{
    list-style: none;
    margin: 0px;
    padding: 0px;
}
#search-bar-holder ul li a{
    width: 100%;
    display: inline-block;
    padding: 10px 15px;
    font-size: .9rem;
    text-decoration:none;
    color:black;
}
#search-bar-holder ul li:not(:first-child){
    border-top:1px solid #ced4da
}
#search-bar-holder ul li a:hover{
    background-color:#f5f5f5;
    color:black;
}
#search-result-holder{
    display:none;
}
</style>
<script type="text/javascript">
var searchBarUrl = "{{ url('api/searchProductList') }}";
$(document.body).click(function (e) {
    if($("#search-result-holder").is(":visible")){
        $("#search-result-holder").hide();
    }
});
function searchBarProductName(event){
    $("#search-result-holder").hide();
    if(event.target.value.length > 3){
        $.ajax({
            type: "GET",
            url: "{{ url('api/searchProductList') }}",
            data: {
                data:event.target.value
            },
            success: function(data) {
                if(data.length>0){
                    $("#search-result-holder").show();
                    var listul=$("#search-result-holder ul");
                    listul.empty();
                    $.each(data, function(index,element){
                        var purl = "{{ url('/admin/products/edit') }}"+"/"+element.id;
                        listul.append('<li><a href="'+purl+'">'+element.products_name+' '+' '+element.product_model+' '+element.brand_name+'</a></li>');
                    });
                    setTimeout(function(){
                        $("#search-result-holder ul li a")[0].focus();
                    },1000)
                }
            }
        });
    }
}
</script>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div id="search-bar-holder">
                <input id="search-input-text" onKeyUp="searchBarProductName(event)" class="form-control" type="text" placeholder="Find a Product"/>
                <div id="search-result-holder">
                    <ul onBlur="test()"></ul>
                </div>
            </div>

        </div>
    </div>
    <div class="row container-title">
        <div class="col-md-1"></div>
        <div class="col-md-2">Image</div>
        <div class="col-md-1">Model</div>
        <div class="col-md-2">Name</div>
        <div class="col-md-1">Brand</div>
        <div class="col-md-1">Category</div>
        <div class="col-md-1">Stock</div>
        <div class="col-md-1">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($main_items as $product)
    <div class="row container-data row-even">
        <div class="col-md-1"><input  class="form-control" type="checkbox" name="product_ids[]" value="{{ $product->id }}"></div>
        <div class="col-md-2"><img src="
        @if($product->images->count()>0)
            {{asset('images/products')}}/{{$product->images->first()->img_url}}
        @else
           {{asset('images/no-image.jpg')}}
        @endif
        " class="img-fluid"/></div>
        <div class="col-md-1">{{$product->product_model}}</div>
        <div class="col-md-2">{{$product->products_name}}</div>
        <div class="col-md-1">{{ $product->getBrand->name or '' }}</div>
        <div class="col-md-1">{{$product->getCategory->name or '' }}</div>
        <div class="col-md-1">{{$product->getAllSizesCount()[0]->count > 0 ? "In Stock" : "Out of Stock"}}</div>
        <div class="col-md-1">{{ $product->getStatus->name or '' }}</div>
        <div class="col-md-2 container-button">
            <a href="{{ route('confirm_product',['product_id'=>$product->id])}}">delete</a>
            <a href="{{ route('edit_product',['product_id'=>$product->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection