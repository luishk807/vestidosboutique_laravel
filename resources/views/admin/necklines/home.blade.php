@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row container-title">
        <div class="col-md-2"></div>
        <div class="col-md-4">Name</div>
        <div class="col-md-3">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($main_items as $neckline)
    <div class="row container-data row-even">
        <div class="col-md-2"><input  class="form-control" type="checkbox" name="neckline_ids[]" value="{{ $neckline->id }}"></div>
        <div class="col-md-4">{{$neckline->name}}</div>
        <div class="col-md-3">{{ $neckline->getStatusName->name }}</div>
        <div class="col-md-3 container-button">
            <a href="{{ route('confirm_neckline',['neckline_id'=>$neckline->id])}}">delete</a>
            <a href="{{ route('edit_neckline',['neckline_id'=>$neckline->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection