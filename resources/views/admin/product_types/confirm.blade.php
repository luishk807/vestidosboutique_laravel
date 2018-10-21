@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_product_type',['product_type_id'=>$product_type_id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $product_type->name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_product_types') }}">
                    Back To Product Types
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Product Type"/>
        </div>
    </div>
</div>
</form>
@endsection