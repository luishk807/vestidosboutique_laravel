@extends('admin/layouts.app')
@section('content')
<form action="{{ route('admin_delete_order_products',['order_product_id'=>$order_product->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container cancel-container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $order_product->getProduct->products_name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_orders') }}">
                    Back To Orders
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Product"/>
        </div>
    </div>
</div>
</form>
@endsection