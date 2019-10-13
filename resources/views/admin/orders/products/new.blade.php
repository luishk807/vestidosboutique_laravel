@extends('admin/layouts.app')
@section('content')
<form id="admin_order_page_products_panel" action="{{ route('admin_create_order_products') }}" method="post">
{{ csrf_field() }}
<div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a href="{{ route('admin_show_new_order_address') }}" class="admin-btn">Back To Addresses</a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Continue To Payment"/>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                    <input type="text" onkeyup="on_searchProduct_(event)" class="form-control" id="on_searchBar_input" placeholder="Search for product">
            </div>
        </div>
        <div class="row">
            <div id="on_searchBar_col" class="col">
                <div id="on_searchBar_result">
                    <ul>
                        <li><a href="" class="on_search_item"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if(isset($cart))
    <div class="container no-cart-btn-panel">
        <div class="row">
            <div class="col">
                <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Show Cart Items
                </a>
            </div>
        </div>
    </div>
    <div class="collapse no-cart-items-panel" id="collapseExample">
        <div class="container">
            <div class="row container-title">
                <div class="col-md-2">
                    Images
                </div>
                <div class="col-md-2">
                    Name
                </div>
                <div class="col-md-2">
                    Color
                </div>
                <div class="col-md-2">
                    Size
                </div>
                <div class="col-md-1">
                    Quant
                </div>
                <div class="col-md-1">
                    Price
                </div>
                <div class="col-md-2">
                </div>
            </div>
            @foreach($cart as $indexKey=>$product)
            <div class="row container-data">
                <div class="col-md-2">
                    <img src="
                    @if($product['img'])
                        {{asset('images/products')}}/{{ $product['img'] }}
                    @else
                    {{asset('images/no-image.jpg')}}
                    @endif
                    " alt class="img-fluid">
                </div>
                <div class="col-md-2">
                    {{$product['name']}}
                </div>
                <div class="col-md-2">
                    {{$product["color"]}}
                </div>
                <div class="col-md-2">
                    {{ $product["size"] }}
                </div>
                <div class="col-md-1">
                    <select class="custom-select no_update_select">
                        @for ($i = 1; $i < 10; $i++)
                        <option data="{{ $product['product_id'] }}" value="{{$i}}" 
                        @if($i == $product["quantity"])
                        selected
                        @endif
                        >{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-1">
                    <span class="no_price_input">{{$product['total']}}</span>
                </div>
                <div class="col-md-2 adminNewOrderActions">
                    <a href="" data="{{ $product['product_id'] }}" class="no_adminRemoveCartProduct"><i class="fas fa-trash-alt"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    <div class="container">
        <div class="row container-title">
            <div class="col-md-2">
                Images
            </div>
            <div class="col-md-2">
                Name
            </div>
            <div class="col-md-2">
                Color
            </div>
            <div class="col-md-2">
                Size
            </div>
            <div class="col-md-1">
                Quant
            </div>
            <div class="col-md-1">
                Price
            </div>
            <div class="col-md-2">
            </div>
        </div>
        @foreach($main_items as $indexKey=>$product)
        <div class="row container-data row-even">
            <div class="col-md-2">
                <img src="
                @if($product->images->count()>0)
                    {{asset('images/products')}}/{{$product->getMainImage()[0]->img_url}}
                @else
                {{asset('images/no-image.jpg')}}
                @endif
                " alt class="img-fluid">
            </div>
            <div class="col-md-2">
                {{$product->products_name}}
            </div>
            <div class="col-md-2">
                <select class="custom-select no_color_select">
                    <option value="">Select Color</option>
                    @foreach($product->colors as $color)
                    <option value="{{$color->id}}">{{$color->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select class="custom-select no_size_select">
                    <option value="">Select Size</option>
                </select>
            </div>
            <div class="col-md-1">
                <select class="custom-select no_quantity_select">
                    @for ($i = 1; $i < 10; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-1">
                <span class="no_price_input">{{$product->total_sale}}</span>
            </div>
            <div class="col-md-2 adminNewOrderActions">
                <a data-error="{{ __('general.product_title.missing_size_color',['name'=>$product->products_name]) }}"/ data="{{ $product->id }}" class="no_adminAddCartProduct"><i class="fas fa-plus"></i></a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a href="{{ route('admin_show_new_order_address') }}" class="admin-btn">Back To Addresses</a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Continue To Payment"/>
            </div>
        </div>
    </div>
</form>
@endsection