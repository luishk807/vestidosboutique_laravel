@extends('admin/layouts.app')
@section('content')
<form action="{{ route('edit_vendor',['vendor_id'=>$vendor_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="vendorName">Name:</label>
        <input type="text" id="vendorName" class="form-control" name="name" value="{{ $name }}" placeholder="Vendor Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="vendorStatus">Status:</label>
        <select class="custom-select vendorStatus" name="status" id="vendorStatus">
            <option value="">Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($vendor->status==$status->id)
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
                <a class="btn-block vesti_in_btn" href="{{ route('admin_vendors') }}">
                    Back To Vendors
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Save Vendor"/>
            </div>
        </div>
    </div>

</form>
@endsection