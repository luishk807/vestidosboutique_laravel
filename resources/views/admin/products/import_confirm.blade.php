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
    <div class="container">
            <div class="row form-btn-container">
                <div class="col-md-6">
                    <a href="{{ route('show_import_product') }}" class="admin-btn">Back To Import</a>
                </div>
                <div class="col-md-6">
                    <input type="submit" class="admin-btn" value="Confirm Import"/>
                </div>
            </div>
        </div>
    {{ csrf_field() }}
        <div class="container">
            @foreach($data_confirm["insert"] as $indexKey=>$product)
            @php( $old1 = "product_confirm.".$indexKey.".products_name" )
            @php( $old2 = "product_confirm.".$indexKey.".product_model" )
            @php( $old3 = "product_confirm.".$indexKey.".brand" )
            @php( $old4 = "product_confirm.".$indexKey.".vendor" )
            @php( $old5 = "product_confirm.".$indexKey.".closure" )
            @php( $old6 = "product_confirm.".$indexKey.".fabric" )
            @php( $old7 = "product_confirm.".$indexKey.".category" )
            @php( $old8 = "product_confirm.".$indexKey.".product_type" )
            @php( $old9 = "product_confirm.".$indexKey.".neckline" )
            @php( $old10 = "product_confirm.".$indexKey.".style" )
            @php( $old11 = "product_confirm.".$indexKey.".product_length")
            @php( $old12 = "product_confirm.".$indexKey.".product_detail" )
            @php( $old13 = "product_confirm.".$indexKey.".product_description" )
            @php( $old14 = "product_confirm.".$indexKey.".purchased_date" )
            <div class="row confirm-data-row">
                <div class="col-md-1">
                    <span class="confirm-data-key">{{ 1+ $indexKey }}&#46;</span>&nbsp;<input type="checkbox" checked name="product_confirm[{{$indexKey}}][key]" id="productcheck[{{$indexKey}}]" value="{{ $indexKey }}"/>
                </div><!--end of checkbox column-->
                <div class="col-md-11">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="productName">Name:</label>
                                <input type="text" id="productName" class="form-control" name="product_confirm[{{$indexKey}}][products_name]" value="{{ old($old1) ? old($old1) : $product['products_name'] }}" placeholder="Product Name"/>
                                <small class="error">{{$errors->first("products_name")}}</small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="productModel">Model No.:</label>
                                <input type="text" id="productModel" class="form-control" name="product_confirm[{{$indexKey}}][product_model]" value="{{ old($old2) ? old($old2) : $product['product_model'] }}" placeholder="Model No"/>
                                <small class="error">{{$errors->first("product_model")}}</small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="productBrand">Brand:</label>
                                <select class="custom-select" name="product_confirm[{{$indexKey}}][brand]" id="productBrand">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                        @if(old($old3) ? old($old3)==$brand->id : $product['brand_id']==$brand->id || $product['brand_id']==$brand->name )
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
                                        @if(old($old4) ? old($old4)==$vendor->id : $product['vendor_id']==$vendor->id || $product['vendor_id']==$vendor->company_name)
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
                                        @if(old($old5) ? old($old5)==$closure->id : $product['product_closure_id']==$closure->id || $product['product_closure_id']==$closure->name)
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
                                        @if(old($old6) ? old($old6)==$fabric->id : $product['product_fabric_id']==$fabric->id || $product['product_fabric_id']==$fabric->name)
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
                                    @php( $old15 = "product_confirm.".$indexKey.".event" )
                                    <li>
                                        <input value="{{ $event->id }}" id="event_{{$eventIndex}}" class="custom-checkbox" type="checkbox" name="product_confirm[{{$indexKey}}][event][]" 
                                        @if(old($old15))
                                            @foreach(old($old15) as $old_event)
                                                @if($old_event == $event->id)
                                                    checked
                                                @endif
                                            @endforeach
                                        @elseif($product["product_events"])
                                            @if(
                                                array_search($event->id,$product["product_events"]) > -1
                                            )
                                                checked
                                            @endif
                                        @endif
                                        >
                                        <label for="event_{{$eventIndex}}" 
                                        >{{$event->name}} </label>
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
                                        @if(old($old7) ? old($old7)==$category->id : $product['category_id']==$category->id || $product['category_id']==$category->name)
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
                                        @if(old($old8) ? old($old8)==$product_type->id : $product['product_type_id']==$product_type->id || $product['product_type_id']==$product_type->name)
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
                                        @if(old($old9) ? old($old9)==$neckline->id : $product['product_neckline_id']==$neckline->id || $product['product_neckline_id']==$neckline->name)
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
                                        @if(old($old10) ? old($old10)==$style->id : $product['product_style_id']==$style->id || $product['product_style_id']==$style->name)
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
                                <input type="date" id="productDop" min="2017-01-01" class="form-control" name="product_confirm[{{$indexKey}}][purchased_date]" value="{{ old($old14) ? old($old14) : $date }}" placeholder="Date of Purchase"/>
                                <small class="error">{{$errors->first("purchase_date")}}</small>
                            </div>          
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="productLength">Length:</label>
                                <select class="custom-select" name="product_confirm[{{$indexKey}}][product_length]" id="productLength">
                                    <option value="">Select Length:</option>
                                    @foreach($lengths as $length)
                                        <option value="{{ $length->id }}"
                                        @if(old($old11) ? old($old11)==$length->id : $product['product_length']==$length->id || $product['product_length']==$length->name)
                                            selected="selected"
                                        @endif
                                        >{{$length->name}} </option>
                                    @endforeach
                                </select>
                                <small class="error">{{$errors->first("product_length")}}</small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="productDetail">Detail:</label>
                                <input type="text" id="productDetail" class="form-control" name="product_confirm[{{$indexKey}}][product_detail]" value="{{ old($old12) ? old($old12) : $product['product_detail'] }}" placeholder="Product Detail"/>
                                <small class="error">{{$errors->first("product_detail")}}</small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="productDescription">Description:</label>
                                <textarea class="form-control" id="productDescription" rows="3" name="product_confirm[{{$indexKey}}][products_description]">{{ old($old13) ? old($old13) : $product['products_description'] }}</textarea>
                                <small class="error">{{$errors->first("products_description")}}</small>
                            </div>                     
                        </div>
                        @if(array_key_exists($product['product_model'],$data_confirm["detail"]))
                            @foreach($data_confirm["detail"][$product['product_model']] as $key_detail=>$p_detail)
                            @php( $oldcolor_name= "product_confirm.".$indexKey.".color.".$key_detail.".name" )
                            @php( $oldcolor_code  = "product_confirm.".$indexKey.".color.".$key_detail.".code" )
                            @php ( $color_code = array_key_exists('color_code',$data_confirm["detail"][$product['product_model']][$key_detail][0]) ? $data_confirm["detail"][$product['product_model']][$key_detail][0]['color_code'] : '' );
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="product_color_{{$indexKey}}">Color Name:</label>
                                        <input type="text" id="product_color_{{$indexKey}}" class="form-control" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][name]" value="{{ old($oldcolor_name) ? old($oldcolor_name) : $key_detail}}" placeholder="Color Name"/>
                                        <small class="error">{{$errors->first("product_length")}}</small>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="productDetail">Color Code:</label><br/>
                                        <input type="color" id="colorCode" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][code]" value="{{ old($oldcolor_code) ? old($oldcolor_code) : $color_code }}"/>
                                        <small class="error">{{$errors->first("product_detail")}}</small>
                                    </div>                  
                                </div>
                                
                                Choose Sizes For {{$key_detail}}:<br/>

                                    @foreach($p_detail as $key_sizes => $p_sizes)
                                    @php( $oldsize_sell = "product_confirm.".$indexKey.".color.".$key_detail.".sizes.".$key_sizes.".is_sell" )
                                    @php( $oldsize_rent  = "product_confirm.".$indexKey.".color.".$key_detail.".sizes.".$key_sizes.".is_rent")
                                    @php( $oldsize_size  = "product_confirm.".$indexKey.".color.".$key_detail.".sizes.".$key_sizes.".size")
                                    @php( $oldsize_stock  = "product_confirm.".$indexKey.".color.".$key_detail.".sizes.".$key_sizes.".stock")
                                    @php( $oldsize_sale  = "product_confirm.".$indexKey.".color.".$key_detail.".sizes.".$key_sizes.".total_sale")
                                    @php( $oldsize_rent  = "product_confirm.".$indexKey.".color.".$key_detail.".sizes.".$key_sizes.".total_rent")
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
                                        <input 
                                        @if($p_sizes['total_sale'] > 0 || old($oldsize_sell)=='0')
                                        checked
                                        @endif 
                                        value="{{ $p_sizes['is_sell']}}" id="size_is_sell_{{$key_sizes}}" type="checkbox" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][sizes][{{$key_sizes}}][is_sell]">is sell?
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="size_rent_{{$key_sizes}}" >Total Rent
                                            <input 
                                            @if($p_sizes['total_rent'] > 0 || old($oldsize_rent)=='0')
                                            checked
                                            @endif 
                                            value="{{ $p_sizes['is_rent']}}" id="size_is_rent_{{$key_sizes}}" type="checkbox" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][sizes][{{$key_sizes}}][is_rent]">is Rent?
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-1">
                                        <input type="checkbox" onclick="return false;" checked name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][sizes][{{$key_sizes}}][key_size]" id="product_confirm[{{$indexKey}}][color][{{$key_sizes}}]" value="{{ $key_sizes }}"/>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input value="{{ old($oldsize_size) ? old($oldsize_size) : $p_sizes['size']}}" id="size_size_{{$key_sizes}}"  type="text" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][sizes][{{$key_sizes}}][size]">

                                    </div>
                                    <div class="form-group col-md-2">
                                        <input value="{{ old($oldsize_stock) ? old($oldsize_stock) : $p_sizes['stock']}}" id="size_stock_{{$key_sizes}}"  type="text" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][sizes][{{$key_sizes}}][stock]">
                                    </div>
                                    <div class="form-group col-md-2">    
                                        <input value="{{ old($oldsize_sale) ? old($oldsize_sale) : $p_sizes['total_sale']}}" id="size_sale_{{$key_sizes}}"  type="text" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][sizes][{{$key_sizes}}][total_sale]">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input value="{{ old($oldsize_rent) ? old($oldsize_rent) : $p_sizes['total_rent']}}" id="size_rent_{{$key_sizes}}" type="text" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][sizes][{{$key_sizes}}][total_rent]">
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
            <div class="row form-btn-container">
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