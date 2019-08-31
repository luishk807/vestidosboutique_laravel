@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_alert') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="alertTitle">Pop Up Title:</label>
        <input type="text" id="alertTitle" class="form-control" name="title" value="" placeholder="Pop Up Title"/>
        <small class="error">{{$errors->first("title")}}</small>
    </div>
    <div class="form-group">
        <label for="alertLine1">Line 1:</label>
        <textarea class="form-control" id="alertLine1" rows="3" name="line_1">{{ old('line_1')}}</textarea>
        <small class="error">{{$errors->first("line_1")}}</small>
    </div>
    <div class="form-group">
        <label for="alertLine2">Line 2 (optional):</label>
        <input type="text" id="alertLine2"  class="form-control" name="line_2" value="{{ old('line_2')}}" placeholder=""/>
        <small class="error">{{$errors->first("line_2")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-7">
            <label for="alertLink">Type Link (optional):</label>
            <input type="text" id="alertLink" class="form-control" name="action_link" value="{{ old('action_link') }}" placeholder="Type button link"/>
            <small class="error">{{$errors->first("action_link")}}</small>
        </div>
        <div class="form-group col-md-3">
            <label for="alertText">Type Button Text (optional):</label>
            <input type="text" id="alertText" class="form-control" name="action_text" value="{{ old('action_text')}}" placeholder="Type button text"/>
            <small class="error">{{$errors->first("action_text")}}</small>
        </div>
        <div class="form-group col-md-2">
            <label for="alertTab">Open New Tab?:</label>
            <select class="custom-select" name="action_tab" id="alertTab">
                    <option value="0" selected>No</option>
                    <option value="1">Yes</option>
            </select>
            <small class="error">{{$errors->first("action_tab")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="alertStatus">Status:</label>
        <select class="custom-select D" name="status" id="alertStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_alerts') }}">
                    Back To Alerts
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Alert"/>
            </div>
        </div>
    </div>
</form>
@endsection