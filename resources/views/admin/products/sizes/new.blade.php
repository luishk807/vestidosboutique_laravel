@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_size',['product_id'=>$product_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="sizeName">Name:</label>
        <input type="number" id="sizeName" class="form-control" name="size" value="" placeholder="Size"/>
        <small class="error">{{$errors->first("size")}}</small>
    </div>
    <div class="form-group">
        <label for="sizeStatus">Status:</label>
        <select class="custom-select" name="status" id="sizeStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_sizes',['product_id'=>$product_id]) }}">
                    Back To Sizes
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Create Size"/>
            </div>
        </div>
    </div>
</form>
@endsection