@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_color',['color_id'=>$color->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $color->name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_colors',['product_id'=>$product_id]) }}">
                    Back To Colors
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="btn-block vesti_in_btn" value="Delete Color"/>
        </div>
    </div>
</div>
</form>
@endsection