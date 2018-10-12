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
                    <span class="confirm-data-key">{{ 1+ $indexKey }}&#46;</span>&nbsp;<input type="checkbox" checked name="product_confirm[{{$indexKey}}][key]" id="productcheck{{$indexKey}}]" value="{{ $indexKey }}"/>
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
                                Choose Category:<br/>
                                <ul class="custom-ul">
                                    @foreach($categories as $catIndex => $category)
                                    <li>
                                        <input value="{{ $category->id }}" id="category_{{$catIndex}}" class="custom-checkbox" type="checkbox" name="product_confirm[{{$indexKey}}][cat][]">
                                        <label for="category_{{$catIndex}}" >{{$category->name}} </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>                   
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
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
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="productRent">
                                <input type="checkbox" 
                                @if($product['is_rent'])
                                echo checked='checked'
                                @endif
                                name="product_confirm[{{$indexKey}}][is_rent]" value="true"/>&nbsp;For Rent?:</label>
                                <input type="number" id="productRent" class="form-control" name="product_confirm[{{$indexKey}}][total_rent]" min="0" step="0.01" value="{{ $product['total_rent'] }}" placeholder="0.00"/>
                                <small class="error">{{$errors->first("total_rent")}}</small>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="productSell">
                                <input type="checkbox" 
                                @if($product['is_sell'])
                                echo checked='checked'
                                @endif
                                name="product_confirm[{{$indexKey}}][is_sale]" value="true"/>&nbsp;For Sale?:</label>
                                <input type="number" id="productSell" class="form-control" name="product_confirm[{{$indexKey}}][total_sale]" min="0" step="0.01" value="{{ $product['total_sale'] }}" placeholder="0.00"/>
                                <small class="error">{{$errors->first("total_sale")}}</small>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="productStock">Available Stock:</label>
                                <input type="text" id="productStock" class="form-control" name="product_confirm[{{$indexKey}}][product_stock]" value="{{ $product['product_stock'] }}" placeholder="Number of Stock Available"/>
                                <small class="error">{{$errors->first("product_stock")}}</small>
                            </div>
                            <div class="form-group col-md-3">
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
                                <ul class="custom-ul">
                                    @foreach($p_detail as $key_sizes => $p_sizes)
                                    <li>
                                        <input checked value="{{ $p_sizes}}" id="category_{{$key_sizes}}" class="custom-checkbox" type="checkbox" name="product_confirm[{{$indexKey}}][color][{{$key_detail}}][sizes][]">
                                        <label for="category_{{$key_sizes}}" >{{ $p_sizes}} </label>
                                    </li>
                                    @endforeach
                                </ul>



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