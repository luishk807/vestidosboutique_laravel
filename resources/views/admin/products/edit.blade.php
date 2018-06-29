@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="{{ route('admin_products') }}" class="nav-link">Back to Products</a></li>
                    <li class="nav-item"><a href="{{ route('admin_images',['product_id'=>$product_id]) }}" class="nav-link">[{{ $product->images()->count() }}] View Images</a></li>
                    <li class="nav-item"><a href="{{ route('admin_colors',['product_id'=>$product_id]) }}" class="nav-link">[{{ $product->colors()->count() }}] View Colors</a></li>
                    <li class="nav-item"><a href="{{ route('admin_sizes',['product_id'=>$product_id]) }}" class="nav-link">[{{ $product->sizes()->count() }}] View Sizes</a></li>
                    <li class="nav-item"><a href="{{ route('admin_rates',['product_id'=>$product_id]) }}" class="nav-link">[{{ $product->rates()->count() }}] View Rates</a></li>
                </ul>
            </nav>
            
        </div>
    </div>
</div>
<form action="{{ route('edit_product',['product_id'=>$product_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="productName">Name:</label>
        <input type="text" id="productName" class="form-control" name="products_name" value="{{ old('products_name') ? old('products_name') : $product->products_name }}" placeholder="Product Name"/>
        <small class="error">{{$errors->first("products_name")}}</small>
    </div>
    <div class="form-group">
        <label for="productBrand">Brand:</label>
        <select class="custom-select" name="brand" id="productBrand">
            <option value="">Select Brand</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}"
                @if($product->brand_id==$brand->id)
                    selected="selected"
                @endif
                >{{$brand->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("brand")}}</small>
    </div>
    <div class="form-group">
        <label for="productVendor">Vendor:</label>
        <select class="custom-select" name="vendor" id="productVendor">
            <option value="">Select Vendor</option>
            @foreach($vendors as $vendor)
                <option value="{{ $vendor->id }}"
                @if($product->vendor_id==$vendor->id)
                    selected="selected"
                @endif
                >{{$vendor->getFullVendorName()}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("vendor")}}</small>
    </div>
    <div class="form-group">
        <label for="productCategory">Category:</label>
        <select class="custom-select" name="category" id="productCategory">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                @if($product->category_id==$category->id)
                    selected="selected"
                @endif
                >{{$category->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("category")}}</small>
    </div>
    <div class="form-group">
        <label for="productClosure">Closure Type:</label>
        <select class="custom-select" name="closure" id="productClosure">
            <option value="">Select Closure</option>
            @foreach($closures as $closure)
                <option value="{{ $closure->id }}"
                @if($product->product_closure_id==$closure->id)
                    selected="selected"
                @endif
                >{{$closure->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("closure")}}</small>
    </div>
    <div class="form-group">
        <label for="productFabric">Fabric Type:</label>
        <select class="custom-select" name="fabric" id="productFabric">
            <option value="">Select Fabric</option>
            @foreach($fabrics as $fabric)
                <option value="{{ $fabric->id }}"
                @if($product->product_fabric_id==$fabric->id)
                    selected="selected"
                @endif
                >{{$fabric->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("fabric")}}</small>
    </div>
    <div class="form-group">
        <label for="productFit">Fit Type:</label>
        <select class="custom-select" name="fit" id="productFit">
            <option value="">Select Fit</option>
            @foreach($fits as $fit)
                <option value="{{ $fit->id }}"
                @if($product->product_fit_id==$fit->id)
                    selected="selected"
                @endif
                >{{$fit->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("fit")}}</small>
    </div>
    <div class="form-group">
        <label for="productNeckline">Neckline Type:</label>
        <select class="custom-select" name="neckline" id="productNeckline">
            <option value="">Select Neckline</option>
            @foreach($necklines as $neckline)
                <option value="{{ $neckline->id }}"
                @if($product->product_neckline_id==$neckline->id)
                    selected="selected"
                @endif
                >{{$neckline->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("neckline")}}</small>
    </div>
    <div class="form-group">
        <label for="productWaistline">Waistline Type:</label>
        <select class="custom-select" name="waistline" id="productWaistline">
            <option value="">Select Waistline</option>
            @foreach($waistlines as $waistline)
                <option value="{{ $waistline->id }}"
                @if($product->product_waistline_id==$waistline->id)
                    selected="selected"
                @endif
                >{{$waistline->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("waistline")}}</small>
    </div>
    <div class="form-group">
        <label for="productTotal">Total:</label>
        <input type="number" id="productTotal" class="form-control" name="product_total" min="0" step="0.01" value="{{ old('product_total') ? old('product_total') : $product->product_total }}" placeholder="0.00"/>
        <small class="error">{{$errors->first("product_total")}}</small>
    </div>
    <div class="form-group">
        <label for="productStock">Available Stock:</label>
        <input type="text" id="productStock" class="form-control" name="product_stock" value="{{ old('product_stock') ? old('product_stock') : $product->product_stock }}" placeholder="Number of Stock Available"/>
        <small class="error">{{$errors->first("product_stock")}}</small>
    </div>
    <div class="form-group">
        <label for="productSearchLabel">Search Labels:</label>
        <textarea class="form-control" id="productSearchLabel" rows="3" name="search_labels">{{ old('search_labels') ? old('search_labels') : $product->search_labels }}</textarea>
        <small class="error">{{$errors->first("search_labels")}}</small>
    </div>
    <div class="form-group">
        <label for="productDetail">Detail:</label>
        <input type="text" id="productDetail" class="form-control" name="product_detail" value="{{ old('product_detail') ? old('product_detail') : $product->product_detail }}" placeholder="Product Detail"/>
        <small class="error">{{$errors->first("product_detail")}}</small>
    </div>
    <div class="form-group">
        <label for="productDescription">Description:</label>
        <textarea class="form-control" id="productDescription" rows="3" name="products_description">{{ old('products_description') ? old('products_description') : $product->products_description }}</textarea>
        <small class="error">{{$errors->first("products_description")}}</small>
    </div>
    <div class="form-group">
        <label for="productStatus">Status:</label>
        <select class="custom-select" name="status" id="productStatus">
            <option value="">Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($product->product_waistline_id==$waistline->id)
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
                <a class="btn-block vesti_in_btn" href="{{ route('admin_products') }}">
                    Back To Products
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Save Product"/>
            </div>
        </div>
    </div>

</form>
@endsection