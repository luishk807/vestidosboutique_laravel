@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row container-title">
        <div class="col-md-2"></div>
        <div class="col-md-4">Name</div>
        <div class="col-md-3">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($fabrics as $fabric)
    <div class="row container-data row-even">
        <div class="col-md-2"><input  class="form-control" type="checkbox" name="fabric_ids[]" value="{{ $fabric->id }}"></div>
        <div class="col-md-4">{{$fabric->name}}</div>
        <div class="col-md-3">{{ $fabric->getStatusName->name }}</div>
        <div class="col-md-3 container-button">
            <a href="{{ route('confirm_fabric',['fabric_id'=>$fabric->id])}}">delete</a>
            <a href="{{ route('edit_fabric',['fabric_id'=>$fabric->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection