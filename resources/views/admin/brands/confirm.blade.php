@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_brand',['brand_id'=>$brand->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $brand->name }}
        </div>
    </div>
    <div class="row form-btn-container">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_brands') }}">
                    Back To Brands
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Brand"/>
        </div>
    </div>
</div>
</form>
@endsection