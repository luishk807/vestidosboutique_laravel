@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_size_entries') }}" method="post">
{{ csrf_field() }}
    <input type="hidden" name="product_id" value="{{ $product_id }}">
    <div class="form-group">
        <label for="sizeEntries">{{ __('general.product_title.size_entries') }}:</label>
        <input type="number" id="sizeEntries" class="form-control" name="size_entries" value="" placeholder="Size Entries"/>
        <small class="error">{{$errors->first("size_entries")}}</small>
    </div>

    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_sizes',['product_id'=>$product_id]) }}">
                    Back To Sizes
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Enter Entries"/>
            </div>
        </div>
    </div>
</form>
@endsection