@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_alert',['alert_id'=>$alert->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $alert->name }}
        </div>
    </div>
    <div class="row form-btn-container">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_alerts') }}">
                    Back To Alerts
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Alert"/>
        </div>
    </div>
</div>
</form>
@endsection