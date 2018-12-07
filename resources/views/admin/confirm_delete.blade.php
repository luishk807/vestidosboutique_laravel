@extends('admin/layouts.app')
@section('content')
<form action="{{ $confirm_delete_url }}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row container-title">
        <div class="col-md-1"></div>
        <div class="col-md-2">Image</div>
        <div class="col-md-5">Name</div>
        <div class="col-md-2">Brand</div>
        <div class="col-md-2">Category</div>
    </div>
    @foreach($confirm_data as $product)
    <div class="row container-data row-even">
        <div class="col-md-1"><input  class="form-control" type="checkbox" checked name="product_ids[]" value="{{ $product->id }}"></div>
        <div class="col-md-2"><img src="
        @if($product->image_url)
            {{asset('images/products')}}/{{$product->image_url }}
        @else
           {{asset('images/no-image.jpg')}}
        @endif
        " class="img-fluid"/></div>
        <div class="col-md-5">{{$product->products_name}}</div>
        <div class="col-md-2">{{$product->brand_name }}</div>
        <div class="col-md-2">{{$product->category_name }}</div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_products') }}">
                    Back To Products
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Product"/>
        </div>
    </div>
</div>
</div>
</form>
@endsection