@extends('admin/layouts.app')
@section('content')
<div class="import-confirm">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <strong>Please confirm the data.  Uncheck undesired data.</strong>
            </div>
        </div>
    </div>
    <form action="{{ route('save_confirm_import_product') }}" method="post">
    {{ csrf_field() }}
        <div class="container">
            @foreach($data_confirm["insert"] as $indexKey=>$product)
            <div class="row confirm-data-row">
                <div class="col-md-1">
                    <span class="confirm-data-key">{{ 1+ $indexKey }}&#46;</span>&nbsp;<input type="checkbox" checked name="product_confirm[{{$indexKey}}][key]" id="productcheck[{{$indexKey}}]" value="{{ $indexKey }}"/>
                </div><!--end of checkbox column-->
                <div class="col-md-11">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="productName">Name:</label>
                                <input type="text" id="productName" class="form-control" name="product_confirm[{{$indexKey}}][products_name]" value="{{ $product['products_name'] }}" placeholder="Product Name"/>
                                <small class="error">{{$errors->first("products_name")}}</small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="productModel">Model No.:</label>
                                <input type="text" id="productModel" class="form-control" name="product_confirm[{{$indexKey}}][product_model]" value="{{ $product['product_model'] }}" placeholder="Model No"/>
                                <small class="error">{{$errors->first("product_model")}}</small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="productBrand">Brand:</label>
                                <select class="custom-select" name="product_confirm[{{$indexKey}}][brand]" id="productBrand">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                        @if($product['brand_id']==$brand->id)
                                            selected="selected"
                                        @endif
                                        >{{$brand->name}} </option>
                                    @endforeach
                                </select>
                                <small class="error">{{$errors->first("brand")}}</small>
                            </div>                      
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="productVendor">Vendor:</label>
                                <select class="custom-select" name="product_confirm[{{$indexKey}}][vendor]" id="productVendor">
                                    <option value="">Select Vendor</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->id }}"
                                        @if($product['vendor_id']==$vendor->id)
                                            selected="selected"
                                        @endif
                                        >{{$vendor->getFullVendorName()}} </option>
                                    @endforeach
                                </select>
                                <small class="error">{{$errors->first("vendor")}}</small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="productClosure">Closure Type:</label>
                                <select class="custom-select" name="product_confirm[{{$indexKey}}][closure]" id="productClosure">
                                    <option value="">Select Closure</option>
                                    @foreach($closures as $closure)
                                        <option value="{{ $closure->id }}"
                                        @if($product['product_closure_id']==$closure->id)
                                            selected="selected"
                                        @endif
                                        >{{$closure->name}} </option>
                                    @endforeach
                                </select>
                                <small class="error">{{$errors->first("closure")}}</small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="productFabric">Fabric Type:</label>
                                <select class="custom-select" name="product_confirm[{{$indexKey}}][fabric]" id="productFabric">
                                    <option value="">Select Fabric</option>
                                    @foreach($fabrics as $fabric)
                                        <option value="{{ $fabric->id }}"
                                        @if($product['product_fabric_id']==$fabric->id)
                                            selected="selected"
                                        @endif
                                        >{{$fabric->name}} </option>
                                    @endforeach
                                </select>
                                <small class="error">{{$errors->first("fabric")}}</small>
                            </div>                    
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                Choose Events:<br/>
                                <ul class="custom-ul">
                                    @foreach($events as $eventIndex => $event)
                                    <li>
                                        <input value="{{ $event->id }}" id="event_{{$eventIndex}}" class="custom-checkbox" type="checkbox" name="product_confirm[{{$indexKey}}][event][]">
                                        <label for="event_{{$eventIndex}}" >{{$event->name}} </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>                   
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                Choose Category:<br/>
                                <select class="custom-select" name="product_confirm[{{$indexKey}}][category]" id="productCategory">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                        @if($product['category_id']==$category->id)
                                            selected="selected"
                                        @endif
                                        >{{$category->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                Choose Product Type:<br/>
                                <select class="custom-select" name="product_confirm[{{$indexKey}}][product_type]" id="productProductType">
                                    <option value="">Select Product Type</option>
                                    @foreach($product_types as $product_type)
                                        <option value="{{ $product_type->id }}"
                                        @if($product['product_type_id']==$product_type->id)
                                            selected="selected"
                                        @endif
                                        >{{$product_type->name}} </option>
                                    @endforeach
                                </select>
                            </div>               
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="productNeckline">Neckline Type:</label>
                                <select class="custom-select" name="product_confirm[{{$indexKey}}][neckline]" id="productNeckline">
                                    <option value="">Select Neckline</option>
                                    @foreach($necklines as $neckline)
                                        <option value="{{ $neckline->id }}"
                                        @if($product['product_neckline_id']==$neckline->id)
                                            selected="selected"
                                        @endif
                                        >{{$neckline->name}} </option>
                                    @endforeach
                                </select>
                                <small class="error">{{$errors->first("neckline")}}</small>
                            </div>    
                            <div class="form-group col-md-5">
                                <label for="productStyle">Style:</label>
                                <select class="custom-select" name="product_confirm[{{$indexKey}}][style]" id="productStyle">
                                    <option value="">Select Style</option>
                                    @foreach($vestidos_styles as $style)
                                        <option value="{{ $style->id }}"
                                        @if($product['product_style_id']==$style->id)
                                            selected="selected"
                                        @endif
                                        >{{$style->name}} </option>
                                    @endforeach
                                </select>
                                <small class="error">{{$errors->first("style")}}</small>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="productDop">Date of Purchase:</label>
                                @php( $date = date('Y-m-d', strtotime($product["purchase_date"])) );
                                <input type="date" id="productDop" min="2017-01-01" class="form-control" name="product_confirm[{{$indexKey}}][purchased_date]" value="{{ $date }}" placeholder="Date of Purchase"/>
                                <small class="error">{{$errors->first("purchase_date")}}</small>
                            </div>          
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="productLength">Length:</label>
                                <input type="text" id="productLength" class="form-control" name="product_confirm[{{$indexKey}}][product_length]" value="{{ $product['product_length'] }}" placeholder="Length"/>
                                <small class="error">{{$errors->first("product_length")}}</small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="productDetail">Detail:</label>
                                <input type="text" id="productDetail" class="form-control" name="product_confirm[{{$indexKey}}][product_detail]" value="{{ $product['product_detail'] }}" placeholder="Product Detail"/>
                                <small class="error">{{$errors->first("product_detail")}}</small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="productDescription">Description:</label>
                                <textarea class="form-control" id="productDescription" rows="3" name="product_confirm[{{$indexKey}}][products_description]">{{ $product['products_description'] }}</textarea>
                                <small class="error">{{$errors->first("products_description")}}</small>
                            </div>                     
                        </div>



                        @if(array_key_exists($product['product_model'],$data_confirm["detail"]))
                            @foreach($data_confirm["detail"][$product['product_model']] as $key_detail=>$p_detail)
                                

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="product_color_{{$indexKey}}">Color Name:</label>
                                        <input type="text" id="product_color_{{$indexKey}}" class="form-control" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][name]" value="{{$key_detail}}" placeholder="Color Name"/>
                                        <small class="error">{{$errors->first("product_length")}}</small>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="productDetail">Color Code:</label><br/>
                                        <input type="color" id="colorCode" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][code]" value=""/>
                                        <small class="error">{{$errors->first("product_detail")}}</small>
                                    </div>                  
                                </div>
                                
                                Choose Sizes For {{$key_detail}}:<br/>

                                    @foreach($p_detail as $key_sizes => $p_sizes)
                                <div class="row">
                                    <div class="form-group col-md-1">
                                        <span class="confirm-data-key">{{ 1+ $key_sizes }}&#46;</span>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="size_size_{{$key_sizes}}" >Size</label>

                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="size_stock_{{$key_sizes}}" >Stock</label>
                                    </div>
                                    <div class="form-group col-md-2">    
                                        <label for="size_sale_{{$key_sizes}}" >Total Sale</label>
                                        <input checked value="{{ $p_sizes['is_sell']}}" id="size_is_sell_{{$key_sizes}}" type="checkbox" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][sizes][{{$key_sizes}}][is_sell]">is sell?
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="size_rent_{{$key_sizes}}" >Total Rent
                                            <input checked value="{{ $p_sizes['is_rent']}}" id="size_is_rent_{{$key_sizes}}" type="checkbox" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][sizes][{{$key_sizes}}][is_rent]">is Rent?
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-1">
                                        <input type="checkbox" checked name="product_confirm[[{{$indexKey}}][color][{{$key_detail}}][sizes][{{$key_sizes}}][key_size]" id="product_confirm[{{$indexKey}}][color][{{$key_sizes}}]" value="{{ $key_sizes }}"/>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input value="{{ $p_sizes['size']}}" id="size_size_{{$key_sizes}}"  type="text" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][sizes][{{$key_sizes}}][size]">

                                    </div>
                                    <div class="form-group col-md-2">
                                        <input value="{{ $p_sizes['stock']}}" id="size_stock_{{$key_sizes}}"  type="text" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][sizes][{{$key_sizes}}][stock]">
                                    </div>
                                    <div class="form-group col-md-2">    
                                        <input value="{{ $p_sizes['total_sale']}}" id="size_sale_{{$key_sizes}}"  type="text" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][sizes][{{$key_sizes}}][total_sale]">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input value="{{ $p_sizes['total_rent']}}" id="size_rent_{{$key_sizes}}" type="text" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][sizes][{{$key_sizes}}][total_rent]">
                                    </div>
                                </div>
                                    @endforeach



                            @endforeach
                        @endif
                    </div><!--end of the product container-->
                </div><!--end of product column-->
            </div>
            @endforeach
        </div>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-6">
                    <a href="{{ route('show_import_product') }}" class="admin-btn">Back To Import</a>
                </div>
                <div class="col-md-6">
                    <input type="submit" class="admin-btn" value="Confirm Import"/>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection