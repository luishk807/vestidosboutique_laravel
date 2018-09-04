@extends('admin/layouts.app')
@section('content')


<form action="{{ route('create_image',['product_id'=>$product_id]) }}" method="post" enctype="multipart/form-data">


{{ csrf_field() }}
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