@extends('admin/layouts.app')
@section('content')
<style>
.admin_slider_img{
    width:500px;
}
</style>
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_shop_banner') }}" class="nav-link">Add Banner</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">Image</div>
        <div class="col-md-3">Name</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($shop_banners as $shop_banner)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4"><img src="{{asset('images/shop_banners')}}/{{$shop_banner->image_url}}" alt="{{$shop_banner->image_name}}" class="img-fluid"/></div>
        <div class="col-md-3">{{$shop_banner->image_name}}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_shop_banner',['shop_banner_id'=>$shop_banner->id])}}">delete</a>
            <a href="{{ route('edit_shop_banner',['shop_banner_id'=>$shop_banner->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection