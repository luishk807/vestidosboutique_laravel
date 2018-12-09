@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_vendor',['vendor_id'=>$vendor->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $vendor->name }}
        </div>
    </div>
    <div class="row form-btn-container">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_vendors') }}">
                    Back To Vendors
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Vendor"/>
        </div>
    </div>
</div>
</form>
@endsection