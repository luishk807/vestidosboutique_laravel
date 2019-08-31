@extends('admin/layouts.app')
@section('content')
@include('includes.footer-main')
<div class="container">
    <div class="row container-title">
        <div class="col-md-2"></div>
        <div class="col-md-3">Name</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-2">Test</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($main_items as $modal_key => $alert)
    <div class="row container-data row-even">
        <div class="col-md-2"><input  class="form-control" type="checkbox" name="alert_ids[]" value="{{ $alert->id }}"></div>
        <div class="col-md-3">{{$alert->title}}</div>
        <div class="col-md-2">{{ $alert->getStatusName->name }}</div>
        <div class="col-md-2"><a target="_blank" href="">Click To Test</a></div>
        <div class="col-md-3">
            <a href="{{ route('confirm_alert',['alert_id'=>$alert->id])}}">delete</a>
            <a href="{{ route('edit_alert',['alert_id'=>$alert->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection