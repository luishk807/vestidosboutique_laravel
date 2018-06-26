@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_address',['address_id'=>$address->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $address->name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_addresses') }}">
                    Back To Addresses
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="btn-block vesti_in_btn" value="Delete Address"/>
        </div>
    </div>
</div>
</form>
@endsection