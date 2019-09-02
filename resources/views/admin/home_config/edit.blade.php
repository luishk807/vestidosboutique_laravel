@extends('admin/layouts.app')
@section('content')
<form action="{{ route('admin_home_config_save') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="allow_credit_card">Allow Credit Card?:</label>
        <select class="form-control"  name="allow_credit_card" id="allow_credit_card">
            <option value="false" {{ !$main_config->allow_credit_card ? 'selected': '' }}>No</option>
            <option value="true" {{ $main_config->allow_credit_card ? 'selected': '' }}>Yes</option>
        </select>
    </div>
    <div class="form-group">
        <label for="allow_shipping">Allow Shipping?:</label>
        <select class="form-control"  name="allow_shipping" id="allow_shipping">
            <option value="false" {{ !$main_config->allow_shipping ? 'selected': '' }}>No</option>
            <option value="true" {{ $main_config->allow_shipping ? 'selected': '' }}>Yes</option>
        </select>
    </div>
    <div class="form-group">
        <label for="alert_id">Select Pop up?:</label>
        <select class="form-control"  name="alert_id" id="alert_id">
            <option value="">No Pop Up</option>
            @foreach($alerts as $alert)
            <option value="{{ $alert->id }}"
            @if($alert->id == $main_config->alert_id)
            selected
            @endif
            >{{ $alert->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="alert_id_single">Show Single Alert?:</label>
        <select class="form-control"  name="alert_id_single" id="alert_id_single">
            <option value="">No Alert</option>
            @foreach($alerts as $alert)
            <option value="{{ $alert->id }}"
            @if($alert->id == $main_config->alert_id_single)
            selected
            @endif
            >{{ $alert->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="container">
        <div class="row form-btn-container">
            <div class="col">
                <input type="submit" class="admin-btn" value="Save Configuration"/>
            </div>
        </div>
    </div>

</form>
@endsection