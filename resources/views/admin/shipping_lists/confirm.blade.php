@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_shipping_list',['shipping_list_id'=>$shipping_list->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $shipping_list->name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_shipping_lists') }}">
                    Back To Shipping_lists
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Shipping_list"/>
        </div>
    </div>
</div>
</form>
@endsection