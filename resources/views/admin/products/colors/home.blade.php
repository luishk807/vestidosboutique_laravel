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
    <div class="row container-title">
        <div class="col-md-2"></div>
        <div class="col-md-2">Name</div>
        <div class="col-md-2">Color</div>
        <div class="col-md-1">Sizes</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($main_items as $color)
    <div class="row container-data row-even">

        <div class="col-md-2"><input  class="form-control" type="checkbox" name="color_ids[]" value="{{ $color->id }}"></div>
        <div class="col-md-2">{{$color->name}}</div>
        <div class="col-md-2"><span class="color_cubes color_cubes_btn_b"  style="background-color:{{ $color->color_code }}">&nbsp;</span></div>
        <div class="col-md-1"><a href='{{ route("admin_sizes",["product_id"=>$color->product_id])}}'>{{ $color->sizes()->count() }}</a></div>
        <div class="col-md-2">{{ $color->getStatusName->name }}</div>
        <div class="col-md-3 container-button">
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