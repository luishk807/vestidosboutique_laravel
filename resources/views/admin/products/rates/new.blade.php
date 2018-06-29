@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_rate',['product_id'=>$product->id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="rateUser">User:</label>
        <select class="custom-select" name="user" id="rateUser">
            <option value="">Select User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{$user->getFullName()}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("user")}}</small>
    </div>
    <div class="form-group">
        <label for="rateRate">Rates:</label>
        <select class="custom-select" name="user_rate" id="rateRate">
            <option value="">Select User Rate</option>
            @for($i = 0; $i <= $rate_nums ; $i++)
                <option value="{{ $i }}">{{$i}} Stars</option>
            @endfor
        </select>
        <small class="error">{{$errors->first("user_rate")}}</small>
    </div>
    <div class="form-group">
        <label for="rateDescription">Comment:</label>
        <textarea class="form-control" id="rateDescription" rows="3" name="user_comment"></textarea>
        <small class="error">{{$errors->first("user_comment")}}</small>
    </div>
    <div class="form-group">
        <label for="rateStatus">Status:</label>
        <select class="custom-select" name="status" id="rateStatus">
            <option value="">Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_rates',['product_id'=>$product->id]) }}">
                    Back To Rates
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Create Rate"/>
            </div>
        </div>
    </div>
</form>
@endsection