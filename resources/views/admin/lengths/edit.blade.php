@extends('admin/layouts.app')
@section('content')
<form action="{{ route('edit_length',['length_id'=>$length_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="lengthName">Name:</label>
        <input type="text" id="lengthName" class="form-control" name="name" value="{{ $name }}" placeholder="Length Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="lengthStatus">Status:</label>
        <select class="custom-select lengthStatus" name="status" id="lengthStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($length->status==$status->id)
                    selected="selected"
                @endif
                >{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_lengths') }}">
                    Back To Lengths
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Save Length"/>
            </div>
        </div>
    </div>

</form>
@endsection