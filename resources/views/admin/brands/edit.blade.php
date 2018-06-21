@extends('admin/layouts.app')
@section('content')
<h1>{{$page_title}}</h1>
<form action="{{ route('edit_brand',['brand_id'=>$brand_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="brandName">Name:</label>
        <input type="text" id="brandName" class="form-control" name="name" value="{{ $name }}" placeholder="Brand Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="brandStatus">Status:</label>
        <select class="custom-select brandStatus" name="status" id="brandStatus">
            <option>Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}" >{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("first_name")}}</small>
    </div>
    <input type="submit" class="btn-block vesti_in_btn" value="Save Brand"/>
</form>
@endsection