@extends('admin/layouts.app')
@section('content')
<form action="{{ route('save_main_slider',['main_slider_id'=>$main_slider->id]) }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <div class="form-group">
        <small class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </small>
    </div>
    <div class="form-group">
        <div class="col-md-2"><img src="{{asset('images/main_sliders')}}/{{$main_slider->image_url}}" alt="{{$main_slider->image_name}}" class="img-fluid"/></div>
    </div>
    <div class="form-group">
        <label for="imageName">Name:</label>
        <input type="text" id="imageName" class="form-control" name="image_name" value="{{ old('image_name') ? old('image_name') : $main_slider->image_name }}" placeholder="Product Name"/>
        <small class="error">{{$errors->first("image_name")}}</small>
    </div>
    <div class="form-group">
        <label for="imageLabels">Replace Slider</label>
        <input type="file" name="main_slider" class="form-control-file" id="imageLabels">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('main_sliders_page') }}">
                    Back To Sliders
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Save Slider"/>
            </div>
        </div>
    </div>

</form>
@endsection