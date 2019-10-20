@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_product_delivery',['delivery_id'=>$delivery->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $delivery->name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_deliveries') }}">
                    Back To Deliveries
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Delivery"/>
        </div>
    </div>
</div>
</form>
@endsection