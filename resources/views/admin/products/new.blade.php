@extends('admin/layouts.app')
@section('content')
<style>
.custom-ul{
    -moz-column-count: 4;
    -moz-column-gap: 20px;
    -webkit-column-count: 4;
    -webkit-column-gap: 20px;
    column-count: 4;
    column-gap: 20px;
    list-style-type: none;
    padding: 0px;
    margin: 5px 0px;
}
</style>
<form action="{{ route('create_product') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="productName">Name:</label>
        <input type="text" id="productName" class="form-control" name="products_name" value="" placeholder="Product Name"/>
        <small class="error">{{$errors->first("products_name")}}</small>
    </div>
    <div class="form-group">
        <label for="productModel">Model No.:</label>
        <input type="text" id="productModel" class="form-control" name="product_model" value="" placeholder="Model No"/>
        <small class="error">{{$errors->first("product_model")}}</small>
    </div>
    <div class="form-group">
        <label for="productCategory">Category:</label>
        <select class="custom-select" name="category" id="productCategory">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{$category->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("brand")}}</small>
    </div>
    <div class="form-group">
        <label for="productProductType">Product Type:</label>
        <select class="custom-select" name="product_type" id="productProductType">
            <option value="">Select Product Type</option>
            @foreach($product_types as $product_type)
                <option value="{{ $product_type->id }}">{{$product_type->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("brand")}}</small>
    </div>
    <div class="form-group">
        <label for="productBrand">Brand:</label>
        <select class="custom-select" name="brand" id="productBrand">
            <option value="">Select Brand</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{$brand->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("brand")}}</small>
    </div>
    <div class="form-group">
        <label for="productStyle">Style:</label>
        <select class="custom-select" name="style" id="productStyle">
            <option value="">Select Style</option>
            @foreach($vestidos_styles as $style)
                <option value="{{ $style->id }}">{{$style->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("style")}}</small>
    </div>
    <div class="form-group">
        <label for="productVendor">Vendor:</label>
        <select class="custom-select" name="vendor" id="productVendor">
            <option value="">Select Vendor</option>
            @foreach($vendors as $vendor)
                <option value="{{ $vendor->id }}">{{$vendor->getFullVendorName()}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("vendor")}}</small>
    </div>
    <div class="form-group">
        Choose Events:<br/>
        <ul class="custom-ul">
            @foreach($events as $eventIndex => $event)
            <li>
                <input value="{{ $event->id }}" id="event_{{$eventIndex}}" class="custom-checkbox" type="checkbox" name="events[]">
                <label for="event_{{$eventIndex}}" >{{$event->name}} </label>
            </li>
            @endforeach
        </ul>
           
    </div>
    <div class="form-group">
        <label for="productClosure">Closure Type:</label>
        <select class="custom-select" name="closure" id="productClosure">
            <option value="">Select Closure</option>
            @foreach($closures as $closure)
                <option value="{{ $closure->id }}">{{$closure->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("closure")}}</small>
    </div>
    <div class="form-group">
        <label for="productFabric">Fabric Type:</label>
        <select class="custom-select" name="fabric" id="productFabric">
            <option value="">Select Fabric</option>
            @foreach($fabrics as $fabric)
                <option value="{{ $fabric->id }}">{{$fabric->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("fabric")}}</small>
    </div>
    <div class="form-group">
        <label for="productNeckline">Neckline Type:</label>
        <select class="custom-select" name="neckline" id="productNeckline">
            <option value="">Select Neckline</option>
            @foreach($necklines as $neckline)
                <option value="{{ $neckline->id }}">{{$neckline->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("neckline")}}</small>
    </div>
    <div class="form-group">
        <label for="productLength">Length Type:</label>
        <select class="custom-select" name="length" id="productLength">
            <option value="">Select Length</option>
            @foreach($lengths as $length)
                <option value="{{ $length->id }}">{{$length->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("length")}}</small>
    </div>
    <div class="form-group">
        <label for="productRent"><input type="checkbox" name="is_for_rent" value="true"/>&nbsp;For Rent?:</label>
        <input type="number" id="productRent" class="form-control" name="total_rent" min="0" step="0.01" value="" placeholder="0.00"/>
        <small class="error">{{$errors->first("total_rent")}}</small>
    </div>
    <div class="form-group">
        <label for="productSell"><input type="checkbox" name="is_for_sale" value="true"/>&nbsp;For Sale?:</label>
        <input type="number" id="productSell" class="form-control" name="total_sale" min="0" step="0.01" value="" placeholder="0.00"/>
        <small class="error">{{$errors->first("total_sale")}}</small>
    </div>
    <div class="form-group">
        <label for="productDop">Date of Purchase:</label>
        <input type="date" id="productDop" min="1950-01-01" class="form-control" name="purchase_date" value="{{ old('purchase_date')}}" placeholder="Date of Purchase"/>
        <small class="error">{{$errors->first("purchase_date")}}</small>
    </div>
    <div class="form-group">
        <label for="productSearchLabel">Search Labels:</label>
        <textarea class="form-control" id="productSearchLabel" rows="3" name="search_labels"></textarea>
        <small class="error">{{$errors->first("search_labels")}}</small>
    </div>
    <div class="form-group">
        <label for="productDetail">Detail:</label>
        <input type="text" id="productDetail" class="form-control" name="product_detail" value="" placeholder="Product Detail"/>
        <small class="error">{{$errors->first("product_detail")}}</small>
    </div>
    <div class="form-group">
        <label for="productDescription">Description:</label>
        <textarea class="form-control" id="productDescription" rows="3" name="products_description"></textarea>
        <small class="error">{{$errors->first("products_description")}}</small>
    </div>
    <div class="form-group">
        <label for="productisNew">Is New?:</label>
        <select class="custom-select" name="is_new" id="productisNew">
            @for($i=0;$i<sizeof($is_news); $i++)
                <option value="{{ $is_news[$i] }}"
                @if($is_news[$i]==0)
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
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
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
                <input type="submit" class="admin-btn" value="Create Product"/>
            </div>
        </div>
    </div>
</form>
@endsection