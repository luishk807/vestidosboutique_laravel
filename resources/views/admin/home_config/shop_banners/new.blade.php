@extends('admin/layouts.app')
@section('content')


<form action="{{ route('create_shop_banner') }}" method="post" enctype="multipart/form-data">


{{ csrf_field() }}
    <div class="form-group">
        <small class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </small>
    </div>
    <div class="form-group">
        <label for="imageLabels">Choose Banner</label>
        <input type="file" name="image" class="form-control-file" id="imageLabels">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('shop_banners_page') }}">
                    Back To Banners
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Banner"/>
            </div>
        </div>
    </div>
</form>
@endsection