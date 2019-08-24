@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_coupon') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="couponCode">Code:</label>
        <input type="text" id="couponCode" class="form-control" name="code" value="{{ old('code')}}" placeholder="Code"/>
        <small class="error">{{$errors->first("code")}}</small>
    </div>
    <div class="form-group">
        <label for="couponSDesc">Short Description:</label>
        <input type="text" id="couponSDesc" class="form-control" name="short_desc" value="{{ old('short_desc')}}" placeholder="short description"/>
        <small class="error">{{$errors->first("short_desc")}}</small>
    </div>
    <div class="form-group">
        <label for="couponDescription">Description:</label>
        <textarea class="form-control" id="couponDescription" rows="3" name="description">{{ old('description')}}</textarea>
        <small class="error">{{$errors->first("description")}}</small>
    </div>
    <div class="form-group">
        <label for="couponDiscount">Discount [ &percnt; ]:</label>
        <input type="number" id="couponDiscount" class="form-control" name="discount" min="0" step="0.01" value="{{ old('discount') }}" placeholder="0.00"/>
        <small class="error">{{$errors->first("discount")}}</small>
    </div>
    <div class="form-group">
        <label for="couponExpDate">Expiration Date?:</label>
        <input type="date" id="couponExpDate" min="2018-01-01" class="form-control" name="exp_date" value="{{ old('exp_date')}}" placeholder="Expiration Date"/>
        <small class="error">{{$errors->first("exp_date")}}</small>
    </div>
    <div class="form-group">
        <label for="couponStatus">Status:</label>
        <select class="custom-select D" name="status" id="couponStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_coupons') }}">
                    Back To Coupons
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Coupon"/>
            </div>
        </div>
    </div>
</form>
@endsection