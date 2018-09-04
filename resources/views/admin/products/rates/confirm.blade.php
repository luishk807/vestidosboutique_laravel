@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_rate',['rate_id'=>$rate->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete rate from {{ $rate->user->getFullName() }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_rates',['product_id'=>$rate->product_id]) }}">
                    Back To Rates
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Rate"/>
        </div>
    </div>
</div>
</form>
@endsection