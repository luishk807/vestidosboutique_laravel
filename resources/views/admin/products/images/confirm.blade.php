@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_image',['image_id'=>$image_id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $image->img_name }}
        </div>
    </div>
    <div class="row form-btn-container">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_images',['product_id'=>$image->product_id]) }}">
                    Back To Images
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Image"/>
        </div>
    </div>
</div>
</form>
@endsection