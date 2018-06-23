@extends('admin/layouts.app')
@section('content')
<h1>{{$page_title}}</h1>
<form action="{{ route('create_closure') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="closureName">Name:</label>
        <input type="text" id="closureName" class="form-control" name="name" value="" placeholder="Closure"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="closureStatus">Status:</label>
        <select class="custom-select D" name="status" id="closureStatus">
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
                <a class="btn-block vesti_in_btn" href="{{ route('admin_closures') }}">
                    Back To Closures
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Create Closure"/>
            </div>
        </div>
    </div>
</form>
@endsection