@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row container-title">
        <div class="col-md-1"></div>
        <div class="col-md-1">Id</div>
        <div class="col-md-4">Name</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-4">Action</div>
    </div>
    @foreach($main_items as $category)
    <div class="row container-data row-even">
        <div class="col-md-1"><input  class="form-control" type="checkbox" name="category_ids[]" value="{{ $category->id }}"></div>
        <div class="col-md-1">{{ $category->id }}</div>
        <div class="col-md-4">{{$category->name}}</div>
        <div class="col-md-2">{{ $category->getStatus->name }}</div>
        <div class="col-md-4 container-button">
             <a href="{{ route('confirm_category',['category_id'=>$category->id])}}">delete</a>
            <a href="{{ route('edit_category',['category_id'=>$category->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection