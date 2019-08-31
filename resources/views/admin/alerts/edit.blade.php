@extends('admin/layouts.app')
@section('content')
<form action="{{ route('edit_alert',['alert_id'=>$alert_id]) }}" method="post">
{{ csrf_field() }}
<div class="form-group">
        <label for="alertTitle">Pop Up Title:</label>
        <input type="text" id="alertTitle" class="form-control" name="title" value="{{ old('title') ? old('title') : $alert->title }}" placeholder="Pop Up Title"/>
        <small class="error">{{$errors->first("title")}}</small>
    </div>
    <div class="form-group">
        <label for="alertLine1">Line 1:</label>
        <textarea class="form-control" id="alertLine1" rows="3" name="line_1">{{ old('line_1') ? old('line_1') : $alert->line_1 }}</textarea>
        <small class="error">{{$errors->first("line_1")}}</small>
    </div>
    <div class="form-group">
        <label for="alertLine2">Line 2 (optional):</label>
        <textarea class="form-control" id="alertLine2" rows="3" name="line_2">{{ old('line_2') ? old('line_2') : $alert->line_2 }}</textarea>
        <small class="error">{{$errors->first("line_2")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-7">
            <label for="alertLink">Type Link (optional):</label>
            <input type="text" id="alertLink" class="form-control" name="action_link" value="{{ old('action_link') ? old('action_link') : $alert->action_link }}" placeholder="Type button link"/>
            <small class="error">{{$errors->first("action_link")}}</small>
        </div>
        <div class="form-group col-md-3">
            <label for="alertText">Type Button Text (optional):</label>
            <input type="text" id="alertText" class="form-control" name="action_text" value="{{ old('action_text') ? old('action_text') : $alert->action_text }}" placeholder="Type button text"/>
            <small class="error">{{$errors->first("action_text")}}</small>
        </div>
        <div class="form-group col-md-2">
            <label for="alertTab">Open New Tab?:</label>
            <select class="custom-select" name="action_tab" id="alertTab">
                @foreach($alert_tabs as $alert_tab)
                    <option value="{{ $alert_tab }}"
                    @if($alert_tab == $alert->action_tab )
                    selected
                    @endif
                    >{{$alert_tab==0 ? 'No':'Yes'}} </option>
                @endforeach
            </select>
            <small class="error">{{$errors->first("action_tab")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="alertStatus">Status:</label>
        <select class="custom-select D" name="status" id="alertStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($status->id == $alert->status )
                selected
                @endif
                >{{$status->name}} </option>
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
                <input type="submit" class="admin-btn" value="Save Alert"/>
            </div>
        </div>
    </div>

</form>
@endsection