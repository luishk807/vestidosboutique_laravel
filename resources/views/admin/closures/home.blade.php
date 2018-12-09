@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row container-title">
        <div class="col-md-2"></div>
        <div class="col-md-4">Name</div>
        <div class="col-md-3">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($main_items as $closure)
    <div class="row container-data row-even">
        <div class="col-md-2"><input  class="form-control" type="checkbox" name="closure_ids[]" value="{{ $closure->id }}"></div>
        <div class="col-md-4">{{$closure->name}}</div>
        <div class="col-md-3">{{ $closure->getStatusName->name }}</div>
        <div class="col-md-3 container-button">
            <a href="{{ route('confirm_closure',['closure_id'=>$closure->id])}}">delete</a>
            <a href="{{ route('edit_closure',['closure_id'=>$closure->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection