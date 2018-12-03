@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row container-title">
        <div class="col-md-1"></div>
        <div class="col-md-3">Name</div>
        <div class="col-md-1">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($categories as $category)
    <div class="row container-data row-even">
    <div class="col-md-1"><input  class="form-control" type="checkbox" name="category_ids[]" value="{{ $category->id }}"></div>
        <div class="col-md-3">{{$category->name}}</div>
        <div class="col-md-1">{{ $category->getStatus->name }}</div>
        <div class="col-md-3 container-button">
             <a href="{{ route('confirm_category',['category_id'=>$category->id])}}">delete</a>
            <a href="{{ route('edit_category',['category_id'=>$category->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection