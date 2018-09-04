@extends('admin/layouts.app')
@section('content')
<form action="{{ route('edit_brand',['brand_id'=>$brand_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="brandName">Name:</label>
        <input type="text" id="brandName" class="form-control" name="name" value="{{ $name }}" placeholder="Brand Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="brandStatus">Status:</label>
        <select class="custom-select brandStatus" name="status" id="brandStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($brand->status==$status->id)
                    selected="selected"
                @endif
                >{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_brands') }}">
                    Back To Brands
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Save Brand"/>
            </div>
        </div>
    </div>

</form>
@endsection