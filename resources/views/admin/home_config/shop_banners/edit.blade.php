@extends('admin/layouts.app')
@section('content')
<form action="{{ route('save_shop_banner',['shop_banner_id'=>$shop_banner->id]) }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <div class="form-group">
        <small class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </small>
    </div>
    <div class="form-group">
        <div class="col-md-2"><img src="{{asset('images/shop_banners')}}/{{$shop_banner->image_url}}" alt="{{$shop_banner->image_name}}" class="img-fluid"/></div>
    </div>
    <div class="form-group">
        <label for="imageName">Name:</label>
        <input type="text" id="imageName" class="form-control" name="image_name" value="{{ old('image_name') ? old('image_name') : $shop_banner->image_name }}" placeholder="Product Name"/>
        <small class="error">{{$errors->first("image_name")}}</small>
    </div>
    <div class="form-group">
        <label for="imageDestination">Destination:</label>
        <input type="text" id="imageDestination" class="form-control" name="image_destination" value="{{ old('image_destination') ? old('image_destination') : $shop_banner->image_destination }}" placeholder="image destination"/>
        <small class="error">{{$errors->first("image_destination")}}</small>
    </div>
    <div class="form-group">
        <label for="imageLabels">Replace Banner</label>
        <input type="file" name="shop_banner" class="form-control-file" id="imageLabels">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('shop_banners_page') }}">
                    Back To Banners
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Save Banner"/>
            </div>
        </div>
    </div>

</form>
@endsection