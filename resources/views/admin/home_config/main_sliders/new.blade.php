@extends('admin/layouts.app')
@section('content')


<form action="{{ route('create_main_slider') }}" method="post" enctype="multipart/form-data">


{{ csrf_field() }}
    <div class="form-group">
        <small class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </small>
    </div>
    <div class="form-group">
        <label for="imageLabels">Choose Slider</label>
        <input type="file" name="image" class="form-control-file" id="imageLabels">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('main_sliders_page') }}">
                    Back To Sliders
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Slider"/>
            </div>
        </div>
    </div>
</form>
@endsection