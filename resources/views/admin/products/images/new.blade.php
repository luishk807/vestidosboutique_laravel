@extends('admin/layouts.app')
@section('content')

<style>
.warning-text{
    font-size:1.5rem;
    font-weight:bold;
}
</style>
<form action="{{ route('create_image',['product_id'=>$product_id]) }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <div class="container cancel-container">
        <div class="row">
            <div class="col text-center warning-text">
                Images must be be <br/>{{$required_size["width"]}}px in width and {{$required_size["height"]}}px in Height
            </div>
        </div>
    </div>
    <div class="form-group">
        <small class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </small>
    </div>
    <div class="form-group">
        <label for="imageLabels">Choose Image</label>
        <input type="file" name="image[]" class="form-control-file" id="imageLabels" multiple>
    </div>
    <div class="form-group">
        <label for="imageStatus">Status:</label>
        <select class="custom-select" name="status" id="imageStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_images',['product_id'=>$product_id]) }}">
                    Back To Images
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Image"/>
            </div>
        </div>
    </div>
</form>
@endsection