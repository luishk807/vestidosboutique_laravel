@extends('admin/layouts.app')
@section('content')
<h1>{{$page_title}}</h1>
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
            <option value="">Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("first_name")}}</small>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_brands') }}">
                    Back To Brands
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Save Client"/>
            </div>
        </div>
    </div>
</form>
@endsection