@extends('admin/layouts.app')
@section('content')
<form action="{{ route('edit_rate',['rate_id'=>$rate_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="rateUser">User:</label>
        <select class="custom-select" name="user" id="rateUser">
            <option value="">Select User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}"
                @if($rate->user_id==$user->id)
                    selected="selected"
                @endif
                >{{$user->getFullName()}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("user")}}</small>
    </div>
    <div class="form-group">
        <label for="rateRate">Rates:</label>
        <select class="custom-select" name="user_rate" id="rateRate">
            <option value="">Select User Rate</option>
            @for($i = 0; $i <= $rate_nums ; $i++)
                <option value="{{ $i }}"
                @if($rate->user_rate==$i)
                    selected="selected"
                @endif
                >{{$i}} Stars</option>
            @endfor
        </select>
        <small class="error">{{$errors->first("user_rate")}}</small>
    </div>
    <div class="form-group">
        <label for="rateDescription">Comment:</label>
        <textarea class="form-control" id="rateDescription" rows="3" name="user_comment">{{ old('user_comment') ? old('user_comment') : $rate->user_comment }}</textarea>
        <small class="error">{{$errors->first("user_comment")}}</small>
    </div>
    <div class="form-group">
        <label for="rateStatus">Status:</label>
        <select class="custom-select" name="status" id="rateStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($rate->status==$status->id)
                    selected="selected"
                @endif
                >{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    


    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_rates',['product_id'=>$rate->product_id]) }}">
                    Back To Rates
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Save Rate"/>
            </div>
        </div>
    </div>

</form>
@endsection