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
    <div class="row">
        <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('brands') }}">
                    Back To Brands
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="btn-block vesti_in_btn" value="Delete Client"/>
        </div>
    </div>
</div>
</form>
@endsection