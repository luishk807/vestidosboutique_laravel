@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_size') }}" method="post">
<input type="hidden" name="product_id" value="{{ $product_id }}"/>
{{ csrf_field() }}
    <div class="container">
        @for($i = 0;$i<$size_entries;$i++)
        <div class="row row_section_sep">
            <div class="col-md-1">
                {{$i + 1}}.
            </div>
            <div class="col-md-11">
                <div class="form-group">
                    <label for="sizeName">Size:</label>
                    <input type="number" id="sizeName" class="form-control" name="sizes[{{$i}}][size]" value="" placeholder="Size"/>
                </div>
                <div class="form-group">
                    <label for="productRent">Rent Total:</label>
                    <input type="number" id="productRent" class="form-control" name="sizes[{{$i}}][total_rent]" min="0" step="0.01" value="" placeholder="0.00"/>
                </div>
                <div class="form-group">
                    <label for="productSell">Sale Total:</label>
                    <input type="number" id="productSell" class="form-control" name="sizes[{{$i}}][total_sale]" min="0" step="0.01" value="" placeholder="0.00"/>
                </div>
                <div class="form-group">
                    <label for="sizeStock">Stock:</label>
                    <input type="number" id="sizeStock" class="form-control" name="sizes[{{$i}}][stock]" value="" placeholder="Stock"/>
                </div>
                <div class="form-group">
                    <label for="sizeColor">Select Color for Size:</label>
                    <select class="custom-select" name="sizes[{{$i}}][color]" id="sizeColor">
                        @foreach($colors as $color)
                            <option value="{{ $color->id }}">{{$color->name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="sizeStatus">Status:</label>
                    <select class="custom-select" name="sizes[{{$i}}][status]" id="sizeStatus">
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}">{{$status->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @endfor
    </div>
    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_sizes',['product_id'=>$product_id]) }}">
                    Back To Sizes
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Size"/>
            </div>
        </div>
    </div>
</form>
@endsection