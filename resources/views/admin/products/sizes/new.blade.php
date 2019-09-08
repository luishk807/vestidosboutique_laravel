@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_size') }}" method="post">
<input type="hidden" name="product_id" value="{{ $product_id }}"/>
{{ csrf_field() }}
    <div class="container">
        @for($i = 0;$i<$size_entries;$i++)
        @php( $old1 = old("sizes.".$i.".size") ? old("sizes.".$i.".size") : null )
        @php( $old2 = "sizes.".$i.".total_rent )
        @php( $old3 = "sizes.".$i.".total_sale" )
        @php( $old4 = "sizes.".$i.".stock" )
        @php( $old5 = "sizes.".$i.".color" )
        @php( $old6 = "sizes.".$i.".status" )
        <div class="row row_section_sep">
            <div class="col-md-1">
                {{$i + 1}}.
            </div>
            <div class="col-md-11">
                <div class="form-group">
                    <label for="sizeName">Size:</label>
                    <input type="number" id="sizeName" class="form-control" name="sizes[{{$i}}][size]" value="{{ old('sizes.0.size')}}" placeholder="Size"/>
                </div>
                <div class="form-group">
                    <label for="productRent">Rent Total:</label>
                    <input type="number" id="productRent" class="form-control" name="sizes[{{$i}}][total_rent]" min="0" step="0.01" value="{{ $old1 }}" placeholder="0.00"/>
                </div>
                <div class="form-group">
                    <label for="productSell">Sale Total:</label>
                    <input type="number" id="productSell" class="form-control" name="sizes[{{$i}}][total_sale]" min="0" step="0.01" value="{{ old('sizes.0.total_sale')}}" placeholder="0.00"/>
                </div>
                <div class="form-group">
                    <label for="sizeStock">Stock:</label>
                    <input type="number" id="sizeStock" class="form-control" name="sizes[{{$i}}][stock]" value="{{ old('sizes.0.stock')}}" placeholder="Stock"/>
                </div>
                <div class="form-group">
                    <label for="sizeColor">Select Color for Size:</label>
                    <select class="custom-select" name="sizes[{{$i}}][color]" id="sizeColor">
                        @foreach($colors as $color)
                            <option value="{{ $color->id }}"
                            @if(old('sizes.0.color')==$color->id)
                            selected
                            @endif
                            >{{$color->name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="sizeStatus">Status:</label>
                    <select class="custom-select" name="sizes[{{$i}}][status]" id="sizeStatus">
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}"
                            @if(old('sizes.0.status')==$status->id)
                            selected
                            @endif
                            >{{$status->name}} </option>
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