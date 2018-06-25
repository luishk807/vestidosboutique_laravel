@extends('admin/layouts.app')
@section('content')
<form action="{{ route('edit_dresstype',['dresstype_id'=>$dresstype_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="dresstypeName">Name:</label>
        <input type="text" id="dresstypeName" class="form-control" name="name" value="{{ $name }}" placeholder="Dress Type"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="dresstypeStatus">Status:</label>
        <select class="custom-select dresstypeStatus" name="status" id="dresstypeStatus">
            <option value="">Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($dresstype->id==$status->id)
                    selected="selected"
                @endif
                >{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first(status")}}</small>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('dresstypes') }}">
                    Back To Dress Types
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Save Dress Type"/>
            </div>
        </div>
    </div>

</form>
@endsection