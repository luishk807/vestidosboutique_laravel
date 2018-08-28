@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_restock',['restock_id'=>$restock_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="restockDate">Order Date:</label>
        <input type="date" id="restockDate" min="2017-01-01"  class="form-control" name="restock_date" value="" placeholder="Restock Date"/>
        <small class="error">{{$errors->first("restock_date")}}</small>
    </div>
    <div class="form-group">
        <label for="restockQuantity">Quantity:</label>
        <input type="text" id="restockQuantity" class="form-control" name="quantity" value="" placeholder="Restock Quantity"/>
        <small class="error">{{$errors->first("quantity")}}</small>
    </div>
    <div class="form-group">
        <label for="restockVendor">Vendor:</label>
        <select class="custom-select" name="vendor" id="restockVendor">
            <option value="">Select Vendor</option>
            @foreach($vendors as $vendor)
                <option value="{{ $vendor->id }}">{{$vendor->getFullVendorName()}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("vendor")}}</small>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_restocks',['restock_id'=>$restock_id]) }}">
                    Back To Restocks
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Create Restock"/>
            </div>
        </div>
    </div>
</form>
@endsection