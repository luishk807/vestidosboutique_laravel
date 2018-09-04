@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_shop_banner',['shop_banner_id'=>$shop_banner->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $shop_banner->image_name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('shop_banners_page') }}">
                    Back To Banners
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Banner"/>
        </div>
    </div>
</div>
</form>
@endsection