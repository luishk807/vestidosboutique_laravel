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
            <option value="">Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_necklines') }}">
                    Back To Necklines
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Create Neckline"/>
            </div>
        </div>
    </div>
</form>
@endsection