@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_coupon',['coupon_id'=>$coupon->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $coupon->code }}
        </div>
    </div>
    <div class="row form-btn-container">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_coupons') }}">
                    Back To Coupons
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Coupon"/>
        </div>
    </div>
</div>
</form>
@endsection