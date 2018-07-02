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
<form action="{{ route('create_order_products') }}" method="post">
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
                <td class="item"><img src="{{asset('images/products')}}/{{$product->images->first()->img_url}}" alt="" class="img-fluid"></td>
                <td class="item">{{$product->products_name}}</td>
                <td class="item">{{$product->product_total}}</td>
                <td class="item"><input type="number" name="order_products[{{$indexKey}}][quantity]" value=""/></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <small class="error">
    <ul>
    @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
    </ul>
    </small>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Create Order"/>
            </div>
        </div>
    </div>
</form>
@endsection