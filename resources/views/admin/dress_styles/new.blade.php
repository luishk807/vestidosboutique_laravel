@extends('admin/layouts.app')
@section('content')
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
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_dressstyles') }}">
                    Back To Dress Style
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Dress Style"/>
            </div>
        </div>
    </div>
</form>
@endsection