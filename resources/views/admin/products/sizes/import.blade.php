@extends('admin/layouts.app')
@section('content')


<form action="{{ route('save_import_size') }}" method="post" enctype="multipart/form-data">


{{ csrf_field() }}
    <div class="form-group">
        <small class="error">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
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
                <a class="admin-btn" href="{{ route('admin_sizes',['product_id'=>$product_id]) }}">
                    Back To Sizes
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="{{ $import_btn }}"/>
            </div>
        </div>
    </div>
</form>
@endsection