@extends('admin/layouts.app')
@section('content')
<form action="{{ route('edit_order',['order_id'=>$order_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="orderName">Name:</label>
        <input type="text" id="orderName" class="form-control" name="name" value="{{ $name }}" placeholder="Order Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="orderStatus">Status:</label>
        <select class="custom-select orderStatus" name="status" id="orderStatus">
            <option value="">Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($order->status==$status->id)
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
                <a class="btn-block vesti_in_btn" href="{{ route('admin_orders') }}">
                    Back To Orders
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Save Order"/>
            </div>
        </div>
    </div>

</form>
@endsection