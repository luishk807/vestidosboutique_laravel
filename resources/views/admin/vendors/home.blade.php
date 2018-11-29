@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="shoplist-nav">
                <ul>
                        @if(!empty($vendors->previousPageUrl()))
                    <li><a href="{{ $vendors->previousPageUrl()}}">&lt; Back</a></li>
                    @endif
                    <li>{{ $vendors->currentPage()}} {{ __('pagination.of') }} {{ $vendors->count() }}</li>
                    @if($vendors->nextPageUrl())
                    <li><a href="{{ $vendors->nextPageUrl() }}">Next &gt;</a></li>
                    @endif
                </ul>
            </div><!--end of nav container-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-3">Company Name</div>
        <div class="col-md-3">Name</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($vendors as $vendor)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-3">{{$vendor->company_name}}</div>
        <div class="col-md-3">{{$vendor->first_name}} {{$vendor->last_name}}</div>
        <div class="col-md-2">{{ $vendor->getStatusName->name }}</div>
        <div class="col-md-2">
            <a href="{{ route('confirm_vendor',['vendor_id'=>$vendor->id])}}">delete</a>
            <a href="{{ route('edit_vendor',['vendor_id'=>$vendor->id])}}">edit</a>
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col">
            <div class="shoplist-nav">
                <ul>
                        @if(!empty($vendors->previousPageUrl()))
                    <li><a href="{{ $vendors->previousPageUrl()}}">&lt; Back</a></li>
                    @endif
                    <li>{{ $vendors->currentPage()}} {{ __('pagination.of') }} {{ $vendors->count() }}</li>
                    @if($vendors->nextPageUrl())
                    <li><a href="{{ $vendors->nextPageUrl() }}">Next &gt;</a></li>
                    @endif
                </ul>
            </div><!--end of nav container-->
        </div>
    </div>
</div>
@endsection