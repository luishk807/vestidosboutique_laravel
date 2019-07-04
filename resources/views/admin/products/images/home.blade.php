@extends('admin/layouts.app')
@section('content')
<style>
.admin_product_img{
    width:500px;
}
</style>
<div class="container">
    <div class="row container-title">
        <div class="col-md-1"></div>
        <div class="col-md-1">Main</div>
        <div class="col-md-2">Image</div>
        <div class="col-md-3">Name</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($main_items as $image)
    <div class="row container-data row-even">
        <div class="col-md-1"><input  class="form-control" type="checkbox" name="image_ids[]" value="{{ $image->id }}"></div>
        <div class="col-md-1"><input type="radio" disabled name="main_image" 
        @if($image->main_image)
            checked
        @endif
        /></div>
        <div class="col-md-2"><img src="{{asset('images/products')}}/{{$image->img_url}}" alt="{{$image->img_name}}" class="img-fluid"/></div>
        <div class="col-md-3">{{$image->img_name}}</div>
        <div class="col-md-2">{{ $image->getStatusName->name }}</div>
        <div class="col-md-3 container-button">
            <a href="{{ route('confirm_image',['image_id'=>$image->id])}}">delete</a>
            <a href="{{ route('edit_image',['image_id'=>$image->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection