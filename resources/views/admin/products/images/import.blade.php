@extends('admin/layouts.app')
@section('content')


<form action="{{ route('save_import_image') }}" method="post" enctype="multipart/form-data">


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
    <input type="hidden" name="product_id" value="{{ $product_id }}">
    <div class="form-group">
        <label for="excel">Choose Excel File</label>
        <input type="file" name="file" class="form-control-file" id="file">
    </div>
    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_images',['product_id'=>$product_id]) }}">
                    Back To Product Images
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="{{ $import_btn }}"/>
            </div>
        </div>
    </div>
</form>
@endsection