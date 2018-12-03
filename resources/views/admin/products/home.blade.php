@extends('admin/layouts.app')
@section('content')
<script>
$(document).ready(function(){
    $('.delete_button').click(function(event) {
        event.preventDefault();
        $("#custom_home_form").submit();
    });
})
</script>
<div class="container">
    <form id="custom_home_form" method="post" action="
        @if(isset($delete_menu)) 
            {{ $delete_menu }}
        @endif">
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
    </div>-
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
        <div class="col-md-1"><input  class="form-control" type="checkbox" name="product_ids[]" value="{{ $product->id }}"></div>
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
    </form>
</div>
@endsection