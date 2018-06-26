@extends('admin/layouts.app')
@section('content')
<style>
.admin_product_img{
    width:500px;
}
</style>
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_image',['product_id'=>$product_id]) }}" class="nav-link">Add Image</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-2">Image</div>
        <div class="col-md-3">Name</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($images as $image)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-2"><img src="{{asset('images/products')}}/{{$image->img_name}}" class="img-fluid"/></div>
        <div class="col-md-3">{{$image->img_name}}</div>
        <div class="col-md-2">{{ $image->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_image',['image_id'=>$image->id])}}">delete</a>
            <a href="{{ route('edit_image',['image_id'=>$image->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection