@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_payment') }}" method="post">
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
            <input type="text" id="paymentFirstName" class="form-control" name="name" value="" placeholder="Name"/>
            <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="paymentDescription">Description:</label>
        <textarea class="form-control" id="paymentDescription" rows="3" name="description"></textarea>
        <small class="error">{{$errors->first("description")}}</small>
    </div>
    <div class="form-group">
        <label for="paymentDescription">Is this credit card?:</label>
        <select class="form-control"  name="is_credit_card" id="is_credit_card">
            <option value="false" selected>No</option>
            <option value="true">Yes</option>
        </select>
    </div>
    <div class="form-group">
        <label for="paymentStatus">Status:</label>
        <select class="custom-select" name="status" id="paymentStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_payments') }}">
                    Back To Payments
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Payment"/>
            </div>
        </div>
    </div>
</form>
@endsection