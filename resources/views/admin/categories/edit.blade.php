@extends('admin/layouts.app')
@section('content')
<form action="{{ route('save_category',['category_id'=>$category_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="categoryName">Name:</label>
        <input type="text" id="categoryName" class="form-control" name="name" value="{{ $category->name }}" placeholder="Category Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="categoryDressType">Dress Type:</label>
        <select class="custom-select" name="dress_type" id="categoryDressType">
            <option value="">Select Dress Type</option>
            @foreach($dresstypes as $dresstype)
                <option value="{{ $dresstype->id }}"
                @if($category->dress_type_id == $dresstype->id)
                    selected=selected
                @endif
                >{{$dresstype->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("dress_type")}}</small>
    </div>
    <div class="form-group">
        <label for="categoryDressStyle">Dress Style:</label>
        <select class="custom-select" name="dress_style" id="categoryDressStyle">
            <option value="">Select Dress Style</option>
            @foreach($dressstyles as $dressstyle)
                <option value="{{ $dressstyle->id }}"
                @if($category->dress_style_id==$dressstyle->id)
                selected=selected
                @endif 
                >{{$dressstyle->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("dress_style")}}</small>
    </div>
    <div class="form-group">
        <label for="categoryStatus">Status:</label>
        <select class="custom-select" name="status" id="categoryStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($category->status==$status->id)
                selected=selected
                @endif 
                >{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_category') }}">
                    Back To Categories
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Save Category"/>
            </div>
        </div>
    </div>
</form>
@endsection