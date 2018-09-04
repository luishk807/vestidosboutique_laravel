@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_adminaddress',['address_id'=>$address->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $address->nick_name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_address',['user_id'=>$user_id]) }}">
                    Back To Addresses
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Address"/>
        </div>
    </div>
</div>
</form>
@endsection