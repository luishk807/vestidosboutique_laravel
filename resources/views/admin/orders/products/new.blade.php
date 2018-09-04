@extends('admin/layouts.app')
@section('content')
<style>
.order-product-list img {
    max-width: 100%;
}
.order-product-list td{
    width:20%;
}
</style>
<form action="{{ route('admin_create_order_products') }}" method="post">
{{ csrf_field() }}

    <div class="container">
        <div class="row">
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
        @foreach($products as $indexKey=>$product)
        <div class="row">
            <div class="col-md-1">
                <input type="checkbox" name="order_products[{{$indexKey}}][product_id]" id="productcheck{{$indexKey}}" value="{{ $product->id }}">
            </div>
            <div class="col-md-2">
                <img src="
                @if($product->images->count()>0)
                    {{asset('images/products')}}/{{$product->images->first()->img_url}}
                @else
                {{asset('images/no-image.jpg')}}
                @endif
                " alt class="img-fluid">
            </div>
            <div class="col-md-2">
                {{$product->products_name}}
            </div>
            <div class="col-md-2">
                <select class="custom-select" name="order_products[{{$indexKey}}][color]">
                    @foreach($product->colors as $color)
                    <option value="{{$color->id}}">{{$color->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select class="custom-select" name="order_products[{{$indexKey}}][size]">
                    @foreach($product->sizes as $size)
                    <option value="{{$size->id}}">{{$size->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <select class="custom-select" name="order_products[{{$indexKey}}][quantity]">
                    @for ($i = 1; $i < 10; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                {{$product->total_sale}}
            </div>
        </div>
        @endforeach
    </div>
    <div class="container">
        <div class="row text-center">
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