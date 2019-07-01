@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div id="search-bar-holder">
                <input id="search-input-text" onKeyDown="inputSearchKeyDown(event)" onKeyUp="searchBarProductName(event)" class="form-control" type="text" placeholder="Find a Product"/>
                <div id="search-result-holder">
                    <ul onKeyDown="searchOnKeyDown(event)"></ul>
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