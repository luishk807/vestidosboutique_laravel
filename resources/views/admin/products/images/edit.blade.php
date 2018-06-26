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
        <div class="col-md-2"><img src="{{asset('images/products')}}/{{$image->img_name}}" class="img-fluid"/></div>
    </div>
    <div class="form-group">
        <label for="imageLabels">Replace Image</label>
        <input type="file" name="image" class="form-control-file" id="imageLabels">
    </div>
    <div class="form-group">
        <label for="imageStatus">Status:</label>
        <select class="custom-select imageStatus" name="status" id="imageStatus">
            <option value="">Select Status</option>
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
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_images',['product_id'=>$product_id]) }}">
                    Back To Images
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Save Image"/>
            </div>
        </div>
    </div>

</form>
@endsection