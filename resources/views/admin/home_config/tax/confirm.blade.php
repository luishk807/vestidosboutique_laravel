@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_tax',['tax_id'=>$tax->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $tax->code }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_taxes') }}">
                    Back To Taxes
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Tax"/>
        </div>
    </div>
</div>
</form>
@endsection