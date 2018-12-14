@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_shipping_list') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
            <label for="shipping_listFirstName">Name:</label>
            <input type="text" id="shipping_listFirstName" class="form-control" name="name" value="" placeholder="Name"/>
            <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="shipping_listDescription">Description:</label>
        <textarea class="form-control" id="shipping_listDescription" rows="3" name="description"></textarea>
        <small class="error">{{$errors->first("description")}}</small>
    </div>
    <div class="form-group">
        <label for="shipping_listtotal">Total:</label>
        <input type="text" id="shipping_listtotal" class="form-control" name="total" value="" placeholder="Total"/>
        <small class="error">{{$errors->first("total")}}</small>
    </div>
    <div class="form-group">
        <label for="shipping_listStatus">Status:</label>
        <select class="custom-select" name="status" id="shipping_listStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_shipping_lists') }}">
                    Back To Shipping Lists
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Shipping List"/>
            </div>
        </div>
    </div>
</form>
@endsection