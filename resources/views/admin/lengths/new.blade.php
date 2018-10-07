@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_length') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="lengthName">Name:</label>
        <input type="text" id="lengthName" class="form-control" name="name" value="" placeholder="Length"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="lengthStatus">Status:</label>
        <select class="custom-select D" name="status" id="lengthStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_lengths') }}">
                    Back To Lengths
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Length"/>
            </div>
        </div>
    </div>
</form>
@endsection