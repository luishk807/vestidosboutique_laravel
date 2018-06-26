@extends('admin/layouts.app')
@section('content')
<style>
.color_cubes_btn_b{
    width: 49px;
    height: 20px;
    display: block;
}
</style>
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('admin') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('admin_products') }}" class="nav-link">Back to Products</a></li>
                <li class="nav-item"><a href="{{ route('new_color',['product_id'=>$product_id]) }}" class="nav-link">Add Color</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-3">Name</div>
        <div class="col-md-2">Color</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($colors as $color)
    <div class="row">

        <div class="col-md-2"></div>
        <div class="col-md-3">{{$color->name}}</div>
        <div class="col-md-2"><span class="color_cubes color_cubes_btn_b"  style="background-color:{{ $color->color_code }}">&nbsp;</span></div>
        <div class="col-md-2">{{ $color->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_color',['color_id'=>$color->id])}}">delete</a>
            <a href="{{ route('edit_color',['color_id'=>$color->id])}}">edit</a>
        </div>


        <div class="col-md-2"></div>
        <div class="col-md-4"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
            
        </div>
    </div>
    @endforeach
</div>
@endsection