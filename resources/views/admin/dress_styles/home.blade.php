@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row container-title">
        <div class="col-md-2"></div>
        <div class="col-md-4">Name</div>
        <div class="col-md-3">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($main_items as $dressstyle)
    <div class="row container-data row-even">
        <div class="col-md-2"><input  class="form-control" type="checkbox" name="dressstyle_ids[]" value="{{ $dressstyle->id }}"></div>
        <div class="col-md-4">{{$dressstyle->name}}</div>
        <div class="col-md-3">{{ $dressstyle->getStatusName->name }}</div>
        <div class="col-md-3 container-button">
            <a href="{{ route('confirm_dressstyle',['dressstyle_id'=>$dressstyle->id])}}">delete</a>
            <a href="{{ route('edit_dressstyle',['dressstyle_id'=>$dressstyle->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection