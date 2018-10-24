@extends('admin/layouts.app')
@section('content')
<script>
var urlColorSizes = "{{ url('api/loadSizes') }}";
</script>
<form action="{{ route('create_restock',['product_id'=>$product->id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="restockDate">Order Date:</label>
        <input type="date" id="restockDate" min="2017-01-01"  class="form-control" name="restock_date" value="" placeholder="Restock Date"/>
        <small class="error">{{$errors->first("restock_date")}}</small>
    </div>
    <div class="form-group">
        <label for="restockQuantity">Quantity:</label>
        <input type="text" id="restockQuantity" class="form-control" name="quantity" value="" placeholder="Restock Quantity"/>
        <small class="error">{{$errors->first("quantity")}}</small>
    </div>
    <div class="form-group">
        <label for="restockColor">Color:</label>
        <select class="custom-select" name="color" id="restockColor" onChange="loadSizes(this.value,0)">
        <option value="">Select Color</option> 
            @foreach($product->colors as $color)
                <option value="{{ $color->id }}">{{$color->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("vendor")}}</small>
    </div>
    <div class="form-group">
        <label for="size_drop_0">Size:</label>
        <select class="custom-select" name="size" id="size_drop_0">
            <option value="">Select Size</option> 
        </select>
        <small class="error">{{$errors->first("size")}}</small>
    </div>
    <div class="form-group">
        <label for="restockVendor">Vendor:</label>
        <select class="custom-select" name="vendor" id="restockVendor">
            <option value="">Select Vendor</option>
            @foreach($vendors as $vendor)
                <option value="{{ $vendor->id }}">{{$vendor->getFullVendorName()}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("vendor")}}</small>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_restocks',['product_id'=>$product->id]) }}">
                    Back To Restocks
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Restock"/>
            </div>
        </div>
    </div>
</form>
@endsection