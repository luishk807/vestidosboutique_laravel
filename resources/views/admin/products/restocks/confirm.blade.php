@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_restock',['restock_id'=>$restock->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete restock info date {{ $restock->date }}
        </div>
    </div>
    <div class="row form-btn-container">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_restocks',['restock_id'=>$restock->restock_id]) }}">
                    Back To Sizes
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Restock"/>
        </div>
    </div>
</div>
</form>
@endsection