@extends('admin/layouts.app')
@section('content')
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
        <small class="error">{{$errors->first("brand")}}</small>
    </div>
    <div class="form-group">
        <label for="productProductType">Product Type:</label>
        <select class="custom-select" name="product_type" id="productProductType">
            <option value="">Select Product Type</option>
            @foreach($product_types as $product_type)
                <option value="{{ $product_type->id }}"
                @if($product->product_type_id==$product_type->id)
                    selected="selected"
                @endif
                >{{$product_type->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("brand")}}</small>
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
        <label for="productStyle">Style:</label>
        <select class="custom-select" name="style" id="productStyle">
            <option value="">Select Style</option>
            @foreach($vestidos_styles as $style)
                <option value="{{ $style->id }}"
                @if($product->style==$style->id)
                    selected="selected"
                @endif
                >{{$style->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("style")}}</small>
    </div>
    <div class="form-group">
        Choose Events:<br/>
        <ul class="custom-ul">
            @foreach($events as $eventIndex => $event)
            <li>
                <input 
                @foreach($product->events as $p_cat)
                    @if($p_cat->event_id==$event->id)
                        checked='checked'
                    @endif
                @endforeach
                value="{{ $event->id }}" id="event_{{$eventIndex}}" class="custom-checkbox" type="checkbox" name="events[]">
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
        <label for="productLength">Length Type:</label>
        <select class="custom-select" name="length" id="productLength">
            <option value="">Select Length</option>
            @foreach($lengths as $length)
                <option value="{{ $length->id }}"
                @if($product->product_length==$length->id)
                    selected="selected"
                @endif
                >{{$length->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("length")}}</small>
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
                @if($product->status==$status->id)
                    selected="selected"
                @endif
                >{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    <div class="container">
        <div class="row form-btn-container">
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