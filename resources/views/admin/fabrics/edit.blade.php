@extends('admin/layouts.app')
@section('content')
<h1>{{$page_title}}</h1>
<form action="{{ route('edit_fabric',['fabric_id'=>$fabric_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="fabricName">Name:</label>
        <input type="text" id="fabricName" class="form-control" name="name" value="{{ $name }}" placeholder="Fabric Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="fabricStatus">Status:</label>
        <select class="custom-select fabricStatus" name="status" id="fabricStatus">
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
                <a class="btn-block vesti_in_btn" href="{{ route('admin_fabrics') }}">
                    Back To Fabrics
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Save Fabric"/>
            </div>
        </div>
    </div>

</form>
@endsection