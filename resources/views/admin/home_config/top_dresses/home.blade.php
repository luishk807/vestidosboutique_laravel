@extends('admin/layouts.app')
@section('content')
<style>
.admin_product_img{
    width:500px;
}
</style>
<div class="container">
    <div class="row container-title">
        <div class="col-md-2"></div>
        <div class="col-md-2">Image</div>
        <div class="col-md-3">Name</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-3">Rate</div>
    </div>
    @foreach($products as $indexKey=>$product)
    <div class="row container-data row-even">
        <div class="col-md-2">
        <input  class="form-control" type="checkbox" name="product_ids[]" value="{{ $product->id }}">
        </div>
        <div class="col-md-2">
        <img src="
        @if($product->images->count()>0)
            {{asset('images/products')}}/{{$product->images->first()->img_url}}
        @else
           {{asset('images/no-image.jpg')}}
        @endif
        " class="img-fluid"/>
        </div>
        <div class="col-md-3">{{$product->products_name}}</div>
        <div class="col-md-2">{{ $product->getStatus->name }}</div>
        <div class="col-md-3">
            {{ $product->rates->avg('user_rate') }}
        </div>
    </div>
    @endforeach
</div>
@endsection