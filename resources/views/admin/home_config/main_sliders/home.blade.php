@extends('admin/layouts.app')
@section('content')
<style>
.admin_slider_img{
    width:500px;
}
</style>
<div class="container">
    <div class="row container-title">
        <div class="col-md-2"></div>
        <div class="col-md-4">Image</div>
        <div class="col-md-3">Name</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($main_sliders as $main_slider)
    <div class="row container-data row-even">
        <div class="col-md-2"><input  class="form-control" type="checkbox" name="main_slider_ids[]" value="{{ $main_slider->id }}"></div>
        <div class="col-md-4"><img src="{{asset('images/main_sliders')}}/{{$main_slider->image_url}}" alt="{{$main_slider->image_name}}" class="img-fluid"/></div>
        <div class="col-md-3">{{$main_slider->image_name}}</div>
        <div class="col-md-3 container-button">
            <a href="{{ route('confirm_main_slider',['main_slider_id'=>$main_slider->id])}}">delete</a>
            <a href="{{ route('edit_main_slider',['main_slider_id'=>$main_slider->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection