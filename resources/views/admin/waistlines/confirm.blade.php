@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_waistline',['waistline_id'=>$waistline->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $waistline->name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_waistlines') }}">
                    Back To Waistlines
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="btn-block vesti_in_btn" value="Delete Waistline"/>
        </div>
    </div>
</div>
</form>
@endsection