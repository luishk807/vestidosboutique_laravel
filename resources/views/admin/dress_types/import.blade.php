@extends('admin/layouts.app')
@section('content')


<form action="{{ route('save_import_dresstype') }}" method="post" enctype="multipart/form-data">


{{ csrf_field() }}
    <div class="form-group">
        <small class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </small>
    </div>
    <div class="form-group">
        <label for="excel">Choose Excel File</label>
        <input type="file" name="file" class="form-control-file" id="file">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_dresstypes') }}">
                    Back To Dress Types
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="{{ $import_btn }}"/>
            </div>
        </div>
    </div>
</form>
@endsection