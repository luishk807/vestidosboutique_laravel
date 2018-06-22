@extends('admin/layouts.app')
@section('content')
<h1>Brands</h1>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">Name</div>
        <div class="col-md-3">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($brands as $brand)
    <div class="row">
        <div class="col-md-2">{{$brand->name}}</div>
        <div class="col-md-4">{{ $status }}</div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
    </div>
    @endforeach
</div>
@endsection