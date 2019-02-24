@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_color') }}" method="post">
{{ csrf_field() }}
    <input type="hidden" name="product_id" value="{{ $product_id }}"/>
    <div class="container">
    @for($i = 0;$i<$color_entries;$i++)
        <div class="row row_section_sep">
            <div class="col-md-1">
                {{$i + 1}}.
            </div>
            <div class="col-md-11">
                <div class="form-group">
                    <label for="colorName">Name:</label>
                    <input type="text" id="colorName" class="form-control" name="colors[{{$i}}][name]" value="" placeholder="Color Name"/>
                </div>
                <div class="form-group">
                    <label for="colorCode">Color:</label>
                    <input type="color" id="colorCode" name="colors[{{$i}}][color_code]" value=""/>
                </div>
                <div class="form-group">
                    <label for="colorStatus">Status:</label>
                    <select class="custom-select" name="colors[{{$i}}][status]" id="colorStatus">
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
                <a class="admin-btn" href="{{ route('admin_colors',['product_id'=>$product_id]) }}">
                    Back To Colors
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Colors"/>
            </div>
        </div>
    </div>
</form>
@endsection