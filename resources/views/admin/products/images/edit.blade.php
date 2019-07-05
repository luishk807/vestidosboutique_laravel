@extends('admin/layouts.app')
@section('content')
<form action="{{ route('edit_image',['image_id'=>$image_id]) }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <div class="form-group">
        <small class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </small>
    </div>
    <div class="form-group">
        <div class="col-md-2"><img src="{{asset('images/products')}}/{{$image->img_url}}" alt="{{$image->img_name}}" class="img-fluid"/></div>
    </div>
    <div class="form-group">
        <label for="imageName">Name:</label>
        <input type="text" id="imageName" class="form-control" name="img_name" value="{{ old('img_name') ? old('img_name') : $image->img_name }}" placeholder="Product Name"/>
        <small class="error">{{$errors->first("img_name")}}</small>
    </div>
    <div class="form-group">
        <label for="imageLabels">Replace Image</label>
        <input type="file" name="image" class="form-control-file" id="imageLabels">
    </div>
    <div class="form-group">
        <label for="imageMain">Set Image to Main:</label>
        <select class="custom-select" name="main_image" id="imageMain">
                <option value="1" @if($image->main_img) selected @endif>Yes</option>
                <option value="0" @if(!$image->main_img) selected @endif>No</option>
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    <div class="form-group">
        <label for="imageStatus">Status:</label>
        <select class="custom-select imageStatus" name="status" id="imageStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($image->status==$status->id)
                    selected="selected"
                @endif
                >{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_images',['product_id'=>$product_id]) }}">
                    Back To Images
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Save Image"/>
            </div>
        </div>
    </div>

</form>
@endsection