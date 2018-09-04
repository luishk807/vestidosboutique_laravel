@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_brand') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="brandName">Name:</label>
        <input type="text" id="brandName" class="form-control" name="name" value="" placeholder="Brand Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="brandStatus">Status:</label>
        <select class="custom-select D" name="status" id="brandStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_brands') }}">
                    Back To Brands
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Brand"/>
            </div>
        </div>
    </div>
</form>
@endsection