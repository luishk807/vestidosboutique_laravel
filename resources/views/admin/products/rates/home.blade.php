@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row container-title">
        <div class="col-md-1"></div>
        <div class="col-md-3">Name</div>
        <div class="col-md-2">Rate</div>
        <div class="col-md-3">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($main_items as $rate)
    <div class="row container-data row-even">
        <div class="col-md-1"><input  class="form-control" type="checkbox" name="rate_ids[]" value="{{ $rate->id }}"></div>
        <div class="col-md-3">{{$rate->user->getFullName()}}</div>
        <div class="col-md-2"><div class='rate-view' data-rate-value="{{$rate->user_rate}}"></div></div>
        <div class="col-md-3">{{ $rate->getStatusName->name }}</div>
        <div class="col-md-3 container-button">
            <a href="{{ route('confirm_rate',['rate_id'=>$rate->id])}}">delete</a>
            <a href="{{ route('edit_rate',['rate_id'=>$rate->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection