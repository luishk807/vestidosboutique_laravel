@extends('admin/layouts.app')
@section('content')
<form action="{{ route('edit_dressstyle',['dressstyle_id'=>$dressstyle_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="dressstyleName">Name:</label>
        <input type="text" id="dressstyleName" class="form-control" name="name" value="{{ $name }}" placeholder="Dress Style Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="dressstyleStatus">Status:</label>
        <select class="custom-select dressstyleStatus" name="status" id="dressstyleStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($dressstyle->id==$status->id)
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
                <a class="admin-btn" href="{{ route('admin_dressstyles') }}">
                    Back To Dress Styles
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Save Dress Style"/>
            </div>
        </div>
    </div>

</form>
@endsection