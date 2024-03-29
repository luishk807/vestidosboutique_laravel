@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_neckline') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="necklineName">Name:</label>
        <input type="text" id="necklineName" class="form-control" name="name" value="" placeholder="Neckline Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="necklineStatus">Status:</label>
        <select class="custom-select D" name="status" id="necklineStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_necklines') }}">
                    Back To Necklines
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Neckline"/>
            </div>
        </div>
    </div>
</form>
@endsection