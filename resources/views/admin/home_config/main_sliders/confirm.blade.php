@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_main_slider',['main_slider_id'=>$main_slider->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $main_slider->image_name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('main_sliders_page') }}">
                    Back To Sliders
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Slider"/>
        </div>
    </div>
</div>
</form>
@endsection