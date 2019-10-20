@extends('admin/layouts.app')
@section('content')


<form action="{{ route('create_product_delivery') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="deliveryName">Delivery Name:</label>
        <input type="text" id="deliveryName" class="form-control" name="name" value="{{ old('name')}}" placeholder="Delivery Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="deliveryTotal">Total:</label>
        <input type="number" id="deliveryTotal" class="form-control" name="total" min="0" step="0.01" value="" placeholder="0.00"/>
        <small class="error">{{$errors->first("total")}}</small>
    </div>
    <div class="form-group">
        <label for="deliveryDescription">Description:</label>
        <textarea class="form-control" id="deliveryDescription" rows="3" name="description"></textarea>
        <small class="error">{{$errors->first("description")}}</small>
    </div>
    <div class="form-group">
        <label for="deliveryMain">Main Option?:</label>
        <select class="form-control"  name="main" id="deliveryMain">
            <option value="false" selected>No</option>
            <option value="true">Yes</option>
        </select>
    </div>
    <div class="form-group">
        <label for="deliveryStatus">Status:</label>
        <select class="custom-select" name="status" id="deliveryStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_deliveries') }}">
                    Back To Deliveries
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Delivery"/>
            </div>
        </div>
    </div>
</form>
@endsection