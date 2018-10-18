@extends('admin/layouts.app')
@section('content')
<form action="{{ route('save_payment',['payment_id'=>$payment_type->id]) }}" method="post">
{{ csrf_field() }}
    <div class="row">
        <div class="col text-center">
            <div class="warning-cont">
            <p class="title">For Credit Card Payment</p>
            <p>To make this into a credit card container, just leave the description emtpy</p>
            </div>
        </div>
    </div>
    <div class="form-group">
            <label for="paymentFirstName">Name:</label>
            <input type="text" id="paymentFirstName" class="form-control" name="name" value="{{ old('name') ? old('name') : $payment_type->name }}" placeholder="Name"/>
            <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="paymentDescription">Description:</label>
        <textarea class="form-control" id="paymentDescription" rows="3" name="description">{{ old('description') ? old('description') : $payment_type->description }}</textarea>
        <small class="error">{{$errors->first("description")}}</small>
    </div>
    <div class="form-group">
        <label for="paymentStatus">Status:</label>
        <select class="custom-select" name="status" id="paymentStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($payment_type->status==$status->id)
                    selected="selected"
                @endif
                >{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_payments') }}">
                    Back To Payment Types
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Save Payment Types"/>
            </div>
        </div>
    </div>

</form>
@endsection