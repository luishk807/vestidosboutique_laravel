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
                    <li class="nav-item"><a href="{{ route('admin_restocks',['product_id'=>$product_id]) }}" class="nav-link">Restock</a></li>
                </ul>
            </nav>
            
        </div>
    </div>
</div>
<form action="{{ route('save_product',['product_id'=>$product_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="productName">Name:</label>
        <input type="text" id="productName" class="form-control" name="products_name" value="{{ old('products_name') ? old('products_name') : $product->products_name }}" placeholder="Product Name"/>
        <small class="error">{{$errors->first("products_name")}}</small>
    </div>
    <div class="form-group">
        <label for="productModel">Model No.:</label>
        <input type="text" id="productModel" class="form-control" name="product_model" value="{{ old('product_model') ? old('product_model') : $product->product_model }}" placeholder="Model No"/>
        <small class="error">{{$errors->first("product_model")}}</small>
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
        Choose Category:<br/>
        <ul class="custom-ul">
            @foreach($categories as $catIndex => $category)
            <li>
                <input 
                @foreach($product->categories as $p_cat)
                    @if($p_cat->category_id==$category->id)
                        checked='checked'
                    @endif
                @endforeach
                value="{{ $category->id }}" id="category_{{$catIndex}}" class="custom-checkbox" type="checkbox" name="categories[]">
                <label for="category_{{$catIndex}}" >{{$category->name}} </label>
            </li>
            @endforeach
        </ul>
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
        <label for="productRent">
        <input type="checkbox" 
        @if($product->is_rent)
        echo checked='checked'
        @endif
        name="is_for_rent" value="true"/>&nbsp;For Rent?:</label>
        <input type="number" id="productRent" class="form-control" name="total_rent" min="0" step="0.01" value="{{ old('total_rent') ? old('total_rent') : $product->total_rent }}" placeholder="0.00"/>
        <small class="error">{{$errors->first("total_rent")}}</small>
    </div>
    <div class="form-group">
        <label for="productSell">
        <input type="checkbox" 
        @if($product->is_sell)
        echo checked='checked'
        @endif
         name="is_for_sale" value="true"/>&nbsp;For Sale?:</label>
        <input type="number" id="productSell" class="form-control" name="total_sale" min="0" step="0.01" value="{{ old('total_sale') ? old('total_sale') : $product->total_sale }}" placeholder="0.00"/>
        <small class="error">{{$errors->first("total_sale")}}</small>
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
        <label for="productDop">Date of Purchase:</label>
        <input type="date" id="productDop" min="1950-01-01" class="form-control" name="purchase_date" value="{{ old('purchase_date') ? old('purchase_date') : $product->purchase_date }}" placeholder="Date of Purchase"/>
        <small class="error">{{$errors->first("purchase_date")}}</small>
    </div>
    <div class="form-group">
        <label for="productisNew">Is New?:</label>
        <select class="custom-select" name="is_new" id="productisNew">
            @for($i=0;$i<sizeof($is_news); $i++)
                <option value="{{ $is_news[$i] }}"
                @if($product->is_new==$is_news[$i])
                    selected="selected"
                @endif
                >{{ ($is_news[$i])?"Yes":"No"}} </option>
            @endfor
        </select>
        <small class="error">{{$errors->first("is_new")}}</small>
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
                <a class="admin-btn" href="{{ route('admin_products') }}">
                    Back To Products
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Save Product"/>
            </div>
        </div>
    </div>

</form>
@endsection