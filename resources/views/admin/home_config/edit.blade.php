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
        <label for="allow_shipping">Show Pop Up?:</label>
        <select class="form-control"  name="allow_shipping" id="allow_shipping">
            <option value="false" {{ !$main_config->allow_shipping ? 'selected': '' }}>No</option>
            <option value="true" {{ $main_config->allow_shipping ? 'selected': '' }}>Yes</option>
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