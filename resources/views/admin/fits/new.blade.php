@extends('admin/layouts.app')
@section('content')
<h1>{{$page_title}}</h1>
<form action="{{ route('create_fit') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="fitName">Name:</label>
        <input type="text" id="fitName" class="form-control" name="name" value="" placeholder="Fit Type Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="fitStatus">Status:</label>
        <select class="custom-select D" name="status" id="fitStatus">
            <option>Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_fits') }}">
                    Back To Fits
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Create Fit"/>
            </div>
        </div>
    </div>
</form>
@endsection