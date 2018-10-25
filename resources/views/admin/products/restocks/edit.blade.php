@extends('admin/layouts.app')
@section('content')
<script type="text/javascript">
var urlColorSizes = "{{ url('api/loadSizes') }}";
</script>
<form action="{{ route('save_restock',['restock_id'=>$restock->id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="restockDate">Order Date:</label>
        <input type="date" id="restockDate" min="2017-01-01"  class="form-control" name="restock_date" value="{{ old('restock_date') ? old('restock_date') : $restock->restock_date }}" placeholder="Restock Date"/>
        <small class="error">{{$errors->first("restock_date")}}</small>
    </div>
    <div class="form-group">
        <label for="restockQuantity">Quantity:</label>
        <input type="text" id="restockQuantity" class="form-control" name="quantity" value="{{ old('quantity') ? old('quantity') : $restock->quantity }}" placeholder="Restock Quantity"/>
        <small class="error">{{$errors->first("quantity")}}</small>
    </div>
    <div class="form-group">
        <label for="restockVendor">Vendor:</label>
        <select class="custom-select" name="vendor" id="restockVendor">
            <option value="">Select Vendor</option>
            @foreach($vendors as $vendor)
                <option value="{{ $vendor->id }}"
                @if($restock->vendor_id==$vendor->id)
                    selected="selected"
                @endif
                >{{$vendor->getFullVendorName()}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("vendor")}}</small>
    </div>
    <div class="form-group">
        <label for="restockColor">Color:</label>
        <select class="custom-select" name="color" id="restockColor" onChange="loadSizes(this.value,0)">
            @foreach($restock->product->colors as $color)
                <option value="{{ $color->id }}"
                @if($restock->color == $color->id)
                selected='selected'
                @endif
                >{{$color->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("vendor")}}</small>
    </div>
    <div class="form-group">
        <label for="size_drop_0">Size:</label>
        <select class="custom-select" name="size" id="size_drop_0">
            <option value="">Select Size</option>
            @foreach($sizes as $size)
                <option value="{{ $size->id }}"
                @if($restock->size == $size->id)
                selected='selected'
                @endif
                >{{$size->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("size")}}</small>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_restocks',['product_id'=>$restock->product_id]) }}">
                    Back To Restocks
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Save Restock"/>
            </div>
        </div>
    </div>

</form>
@endsection