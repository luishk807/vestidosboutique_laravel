@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_color_entries') }}" method="post">
    <input type="hidden" name="product_id" value="{{ $product_id }}">
    <div class="form-group">
        <label for="colorEntries">{{ __('general.product_title.color_entries') }}:</label>
        <input type="number" id="colorEntries" class="form-control" name="color_entries" value="" placeholder="Color Entries"/>
        <small class="error">{{$errors->first("color_entries")}}</small>
    </div>

    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_colors',['product_id'=>$product_id]) }}">
                    Back To Colors
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Enter Entries"/>
            </div>
        </div>
    </div>
</form>
@endsection