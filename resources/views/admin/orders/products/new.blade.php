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

    <table class="table order-product-list">
        <thead>
            <tr>
                <td class="item"></td>
                <td class="item">Image</td>
                <td class="item">Name</td>
                <td class="item">Total</td>
                <td class="item">Quantity</td>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $indexKey=>$product)
            <tr>
                <td class="item">
                    <label class="form-check-label" for="productcheck{{$indexKey}}" class="label-table"></label>
                    <input type="checkbox" name="order_products[{{$indexKey}}][product_id]" id="productcheck{{$indexKey}}" value="{{ $product->id }}">
                </td>
                <td class="item"><img src="
                @if($product->images->count()>0)
                    {{asset('images/products')}}/{{$product->images->first()->img_url}}
                @else
                {{asset('images/no-image.jpg')}}
                @endif
                " alt="" class="img-fluid"></td>
                <td class="item">{{$product->products_name}}</td>
                <td class="item">{{$product->total_rent}}</td>
                <td class="item">
                    <select name="order_products[{{$indexKey}}][quantity]">
                        @for ($i = 1; $i < 10; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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