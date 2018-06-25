@extends('admin/layouts.app')
@section('content')
<form action="{{ route('edit_color',['color_id'=>$color_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="colorName">Name:</label>
        <input type="text" id="colorName" class="form-control" name="name" value="{{ $name }}" placeholder="Color Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="colorStatus">Status:</label>
        <select class="custom-select colorStatus" name="status" id="colorStatus">
            <option value="">Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($status==$status)
                    selected="selected"
                @endif
                >{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_colors') }}">
                    Back To Colors
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Save Color"/>
            </div>
        </div>
    </div>

</form>
@endsection