@extends('admin/layouts.app')
@section('content')
<style>
.sub-menu{

}
.sub-menu .nav-link{
    background-color: rgba(0,0,0,0.03);
    margin: 0px 5px;
    color: black;
    border: 1px solid rgba(0,0,0,0.1);
    font-size: .8rem;
    padding: 8px 15px !important;
    font-family: Arial;
    font-weight: bold;
    box-shadow: 0 0 3px rgba(0,0,0,0.1);
    border-radius: 5px;
}
.shoplist-nav{
    text-align: right;
    margin: 10px;
}
.shoplist-nav ul{
    padding: 0px;
    margin: 0px;
}
.shoplist-nav ul li{
    display: inline-block;
    margin: 5px;
}
.shoplist-nav ul li a{
    
}
.shoplist-nav ul li a:hover{
    
}
.container-title{
    margin: 15px 0px;
    font-weight: bold;
    text-align: center;
}
.container-title div{
    text-align:center;
}
.container-title div:first-child{
    text-align:left;
}
.container-title div:last-child{
    text-align:right;
}
.container-data{
    text-align: center;
    margin: 10px 0px;
    padding: 20px 0px;
}
.container-data div:first-child{
    text-align:left;
}
.container-data div:last-child{
    text-align:right;
}
.container-data .container-button a{
    background-color: rgba(0,0,0,.02);
    padding: 8px 10px;
    color: black;
    border-radius: 5px;
    font-size: .9rem;
    border: 1px solid rgba(0,0,0,.1);
    font-family: arial;
}
.container-data .container-button a:hover{
    text-decoration:none;
    background-color:#851a1d;
    color:white;
}
.row-even:nth-child(even){
    background-color:rgba(0,0,0,.02);
}
</style>
<div class="container">
    <div class="row sub-menu">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_product') }}" class="nav-link">Add Product Manually</a></li>
                <li class="nav-item"><a href="{{ route('show_import_product') }}" class="nav-link">Add Product From File</a></li>
                <li class="nav-item"><a href="{{ route('admin_restocks') }}" class="nav-link">Restock</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="shoplist-nav">
                <ul>
                    @if(!empty($products->previousPageUrl()))
                    <li><a href="{{ $products->previousPageUrl()}}">&lt; Back</a></li>
                    @endif
                    <li>{{ $products->currentPage()}} {{ __('pagination.of') }} {{ $products->count() }}</li>
                    @if($products->nextPageUrl())
                    <li><a href="{{ $products->nextPageUrl() }}">Next &gt;</a></li>
                    @endif
                </ul>
            </div><!--end of nav container-->
        </div>
    </div>
    <div class="row container-title">
        <div class="col-md-1"></div>
        <div class="col-md-2">Image</div>
        <div class="col-md-2">Name</div>
        <div class="col-md-1">Brand</div>
        <div class="col-md-2">Category</div>
        <div class="col-md-1">Stock</div>
        <div class="col-md-1">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($products as $product)
    <div class="row container-data row-even">
        <div class="col-md-1"><input  class="form-control" type="checkbox" name="products[]" value="{{ $product->id }}"></div>
        <div class="col-md-2"><img src="
        @if($product->images->count()>0)
            {{asset('images/products')}}/{{$product->images->first()->img_url}}
        @else
           {{asset('images/no-image.jpg')}}
        @endif
        " class="img-fluid"/></div>
        <div class="col-md-2">{{$product->products_name}}</div>
        <div class="col-md-1">{{$product->getBrand->name }}</div>
        <div class="col-md-2">{{$product->getCategory->name }}</div>
        <div class="col-md-1">{{$product->getAllSizesCount()[0]->count > 0 ? "In Stock" : "Out of Stock"}}</div>
        <div class="col-md-1">{{ $product->getStatus->name }}</div>
        <div class="col-md-2 container-button">
            <a href="{{ route('confirm_product',['product_id'=>$product->id])}}">delete</a>
            <a href="{{ route('edit_product',['product_id'=>$product->id])}}">edit</a>
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col">
            <div class="shoplist-nav">
                <ul>
                        @if(!empty($products->previousPageUrl()))
                    <li><a href="{{ $products->previousPageUrl()}}">&lt; Back</a></li>
                    @endif
                    <li>{{ $products->currentPage()}} {{ __('pagination.of') }} {{ $products->count() }}</li>
                    @if($products->nextPageUrl())
                    <li><a href="{{ $products->nextPageUrl() }}">Next &gt;</a></li>
                    @endif
                </ul>
            </div><!--end of nav container-->
        </div>
    </div>
</div>
@endsection