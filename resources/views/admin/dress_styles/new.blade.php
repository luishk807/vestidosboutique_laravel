@extends('admin/layouts.app')
@section('content')
<h1>{{$page_title}}</h1>
<form action="{{ route('create_dressstyle') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="dressstyleName">Name:</label>
        <input type="text" id="dressstyleName" class="form-control" name="name" value="" placeholder="Dress Style"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="dressstyleStatus">Status:</label>
        <select class="custom-select D" name="status" id="dressstyleStatus">
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
                <a class="btn-block vesti_in_btn" href="{{ route('admin_dressstyles') }}">
                    Back To Dress Style
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Create Dress Style"/>
            </div>
        </div>
    </div>
</form>
@endsection