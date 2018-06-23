@extends('admin/layouts.app')
@section('content')
<h1>{{$page_title}}</h1>
<form action="{{ route('save_category',['category_id'=>$category_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="categoryName">Name:</label>
        <input type="text" id="categoryName" class="form-control" name="name" value="" placeholder="Brand Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="categoryDressType">Dress Type:</label>
        <select class="custom-select" name="dress_type" id="categoryDressType">
            <option>Select Dress Type</option>
            @foreach($dresstypes as $dresstype)
                <option value="{{ $dresstype->id }}">{{$dresstype->getDressType->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("dress_type")}}</small>
    </div>
    <div class="form-group">
        <label for="categoryDressStyle">Dress Style:</label>
        <select class="custom-select" name="dress_type" id="categoryDressStyle">
            <option>Select Dress Style</option>
            @foreach($vestidosstyles as $vestidosstyles)
                <option value="{{ $dresstyle->id }}">{{$vestidosstyles->getDressStyle->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("dress_style")}}</small>
    </div>
    <div class="form-group">
        <label for="categoryStatus">Status:</label>
        <select class="custom-select" name="status" id="categoryStatus">
            <option>Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_category') }}">
                    Back To Categories
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Save Category"/>
            </div>
        </div>
    </div>
</form>
@endsection