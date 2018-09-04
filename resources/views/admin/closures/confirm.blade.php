@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_closure',['closure_id'=>$closure->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $closure->name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_closures') }}">
                    Back To Closures
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Closure"/>
        </div>
    </div>
</div>
</form>
@endsection