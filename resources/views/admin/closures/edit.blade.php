@extends('admin/layouts.app')
@section('content')
<form action="{{ route('edit_closure',['closure_id'=>$closure_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="closureName">Name:</label>
        <input type="text" id="closureName" class="form-control" name="name" value="{{ $name }}" placeholder="Brand Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="closureStatus">Status:</label>
        <select class="custom-select closureStatus" name="status" id="closureStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($closure->status==$status->id)
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
                <a class="admin-btn" href="{{ route('admin_closures') }}">
                    Back To Closures
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Save Closure"/>
            </div>
        </div>
    </div>

</form>
@endsection