@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_vendor') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="vendorName">Name:</label>
        <input type="text" id="vendorName" class="form-control" name="name" value="" placeholder="Vendor Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="vendorStatus">Status:</label>
        <select class="custom-select D" name="status" id="vendorStatus">
            <option value="">Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
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
                <input type="submit" class="btn-block vesti_in_btn" value="Create Vendor"/>
            </div>
        </div>
    </div>
</form>
@endsection