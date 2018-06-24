@extends('admin/layouts.app')
@section('content')
<h1>{{$page_title}}</h1>
<form action="{{ route('edit_neckline',['neckline_id'=>$neckline_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="necklineName">Name:</label>
        <input type="text" id="necklineName" class="form-control" name="name" value="{{ $name }}" placeholder="Neckline Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="necklineStatus">Status:</label>
        <select class="custom-select necklineStatus" name="status" id="necklineStatus">
            <option>Select Status</option>
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
                <a class="btn-block vesti_in_btn" href="{{ route('admin_necklines') }}">
                    Back To Necklines
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Save Neckline"/>
            </div>
        </div>
    </div>

</form>
@endsection