@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">Name</div>
        <div class="col-md-3">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($main_items as $alert)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">{{$alert->name}}</div>
        <div class="col-md-3">{{ $alert->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_alert',['alert_id'=>$alert->id])}}">delete</a>
            <a href="{{ route('edit_alert',['alert_id'=>$alert->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection