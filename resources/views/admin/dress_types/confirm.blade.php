@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_dresstype',['dresstype_id'=>$dresstype->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $dresstype->name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_dresstypes') }}">
                    Back To Brands
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Dress Type"/>
        </div>
    </div>
</div>
</form>
@endsection