@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_payment',['payment_type_id'=>$payment_type->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $payment_type->name }}
        </div>
    </div>
    <div class="row form-btn-container">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_payments') }}">
                    Back To Payments
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Payment"/>
        </div>
    </div>
</div>
</form>
@endsection